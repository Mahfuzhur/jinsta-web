<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Encryption\EncryptException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Carbon\Carbon;
use Auth;
use File;
use Excel;
use DB;
use Session;
use InstagramAPI;
use App\Template;
use App\Hashtag;
use App\Client;
use App\Schedule;
use App\HashtagSchedule;
use App\TemplateSchedule;
use App\UserSchedule;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public $ig;
    public function __construct()
    {
        $this->ig = new \InstagramAPI\Instagram();
    }

    public function userLogin(){
        if(Auth::user()){
            return redirect ('dashboard');            
        }else{
            $content = view('login_registration.form.user_login_form');
            return view('login_registration.master',compact('content'));
        }
        
    }
    public function userRegistration(){
        if(Auth::user()){
            return redirect ('dashboard');            
        }else{
            $content = view('login_registration.form.user_registration_form');
            return view('login_registration.master',compact('content'));
        }
    }

    public function registrationSuccess(){
        if(Auth::user()){
        $success_page = 'success_page';
        $content = view('login_registration.form.registration_success_form');
        return view('login_registration.master',compact('content','success_page'));
        }else{
            return redirect ('user-login');
        }
    }

    public function dashboard(){
        // $user_name = Session::get('current_user_name');
        // $user_profile_image = Session::get('current_user_image');
        if(Auth::user()){

            $user_id = Auth::user()->id;
            $title = 'Index page';
            $user_info = DB::table('users')->where('id',$user_id)->first();
            $result = $this->ig->login($user_info->instagram_username,$user_info->instagram_password);
            $selfInfo = $this->ig->people->getSelfInfo();
            $json_selfinfo = json_decode($selfInfo,true);

            // $data = DB::table('client')
        // ->join('hashtag', 'client.hashtag_id', '=', 'hashtag.id')
        // ->join('hashtag_schedule', 'hashtag.id', '=', 'hashtag_schedule.hashtag_id')
        // ->join('template_schedule', 'hashtag_schedule.schedule_id', '=', 'template_schedule.schedule_id')
        // ->join('template', 'template_schedule.template_id', '=', 'template.id')
        // ->select('hashtag.hashtag','client.hashtag_id','hashtag_schedule.schedule_id','template_schedule.template_id','template.title')->where('client.dm_sent',1)->where('client.user_id',$user_id)->groupBy('client.hashtag_id')->get();

        $data_info = DB::select("SELECT hashtag.hashtag, client.hashtag_id,hashtag_schedule.schedule_id,template_schedule.template_id,template.title, COUNT(client.dm_sent) AS total_sent
                    FROM client client
                    JOIN hashtag hashtag ON client.hashtag_id = hashtag.id
                    JOIN hashtag_schedule hashtag_schedule ON hashtag.id = hashtag_schedule.hashtag_id
                    JOIN template_schedule template_schedule ON hashtag_schedule.schedule_id = template_schedule.schedule_id
                    JOIN template template ON template_schedule.template_id = template.id
                    WHERE client.user_id = $user_id AND client.dm_sent = 1                     
                    GROUP BY client.hashtag_id ORDER BY client.id DESC LIMIT 3");

        // echo "<pre>";
        // print_r($json_selfinfo['user']['username']);
        // exit();

            // $user_main_content = view('user.dashboard',compact('json_selfinfo'));

            $numberOfLists = Schedule::count();
            $numberSent = Client::where([['dm_sent', '=', '1']])->count();
            $title = 'Index page';
            $user_main_content = view('user.dashboard',compact('numberOfLists','numberSent','json_selfinfo','data_info'));

            return view('master',compact('user_main_content','title'));
        }else{
            return redirect ('user-login');
        }
    }

    public function manuscriptRegistration(){
        if(Auth::user()){
            $user_id = Auth::user()->id;
            $all_template = Template::where('user_id',$user_id)->paginate(3);
            $title = '新規作成';
            $active_manuscript = 'active';
            $user_main_content = view('user.manuscript_registration',compact('all_template'));
            return view('master',compact('user_main_content','active_manuscript','title'));
        }else{
            return redirect ('user-login');
        }
    }

    public function createManuscript(){
        if(Auth::user()){
            $title = 'テンプレート名：テストテストテスト';
            $active_manuscript = 'active';
            $user_main_content = view('user.create_manuscript');
            return view('master',compact('user_main_content','active_manuscript','title'));
        }else{
            return redirect ('user-login');
        }
    }

    public function saveMenuscriptInfo(Request $request){

        if(Auth::user()){

        $this->validate($request, [

            'title' => 'required|max:500',
            'description' => 'required',
            'image' => 'required|image|mimes:jpg,jpeg,png,svg'
        ]);

        $file_path_name = "";
        if (Input::hasFile('image')) {
            $file = Input::file('image');
            $file_path_name = rand(1, 10000000) . $file->getClientOriginalName();
            $image = str_replace(' ', '+', $file_path_name);
            $imageName = str_random(10).'.'.'png';
            // return $imageName;
            // exit();
            $file->move('uploads/', $imageName);
        }
        // $info = Album::create($request->all());

        $user_id = Auth::user()->id;

        $current_time = Carbon::now()->addHour(6);
        $update_time = Carbon::now()->addHour(6);

        $data = array(
            array('user_id' => $user_id, 'title' => $request->title, 'description' => $request->description, 'image' => $imageName, 'created_at' => $current_time, 'updated_at' => $update_time)
        );

        $flag = Template::insert($data);
        return redirect('create-manuscript')->with('add_success','Template added successfully !');
        }else{
            return redirect ('user-login');
        }
    }

    public function editTemplate($id)
    {
        if(Auth::user()){
        $single_template = Template::findOrfail($id);
        $manage_template = view('user.edit_template',compact('single_template'));
        return view('master',compact('manage_template'));
        }else{
            return redirect ('user-login');
        }
    }

    public function updateTemplate(Request $request, $id)
    {
        if(Auth::user()){
        $this->validate($request, [

            'title' => 'required|max:500',
            'description' => 'required',
            'image' => 'image|mimes:jpg,jpeg,png,svg'
        ]);

        $imageName = $request->exits_image;
        if (Input::hasFile('image')) {
            $file = Input::file('image');
            $file_path_name = rand(1, 10000000) . $file->getClientOriginalName();
            $image = str_replace(' ', '+', $file_path_name);
            $imageName = str_random(10).'.'.'png';
            $file->move('uploads/', $imageName);
        }

        $flag = Template::findOrfail($id);
        $flag->user_id = Auth::user()->id;
        $flag->title = $request->title;
        $flag->description = $request->description;
        $flag->image = $imageName;
        $flag->updated_at = Carbon::now()->addHour(6);

        $flag->save();
        return redirect('/manuscript-registration')->with('edit_success','Template updated successfully !');
        }else{
            return redirect ('user-login');
        }
    }

    public function destinationRegistration(){
        if(Auth::user()){
        $user_id = Auth::user()->id;
        $title = '宛先登録';
        $active_destination = 'active';
        // $all_hashtag = DB::table('hashtag')->where('user_id',$user_id)
                 // ->join('client', 'hashtag.id', '=', 'client.hashtag_id')
                 // ->select('hashtag.hashtag as title','client.client_id as id')
        //         ->get();

        $all_hashtag = DB::select("SELECT a.id, a.hashtag, COUNT(c.client_id) AS total_user
                    FROM hashtag a
                    JOIN client c ON c.hashtag_id = a.id
                    WHERE a.user_id = $user_id
                    GROUP BY a.id");

        // foreach($all_hashtag as $hashtag){
        //     $client_id[] = DB::table('client')->select(DB::raw('count(*) as user_count'))->where('user_id',$user_id)->where('hashtag_id',$hashtag->id)->get();
        // }
        // echo "<pre>";
        // print_r($data);
        // exit();
        $user_main_content = view('user.destination_registration',compact('all_hashtag'));
        return view('master',compact('user_main_content','active_destination','title'));
        }else{
            return redirect ('user-login');
        }
    }

    public function editDestinationRegistration($id)
    {
        if(Auth::user()){
        $single_hashtag = Hashtag::findOrfail($id);
        $manage_hashtag = view('user.edit_destination_registartion',compact('single_hashtag'));
        return view('master',compact('manage_hashtag'));
        }else{
            return redirect ('user-login');
        }
    }

    public function saveDestinationRegistration(request $request,$id)
    {
        if(Auth::user()){
            $user_id = Auth::user()->id;
            $manual_id = $request->id;
            $data = explode(",", $manual_id);
            $manual_row = count($data);
            $current_time = Carbon::now()->addHour(6);
            $update_time = Carbon::now()->addHour(6);
            for ($i=0; $i < $manual_row; $i++) {
                if($data[$i] != null ){                             
                    $manual_data_id[] = ['user_id' => $user_id,'hashtag_id' => $id,'client_id' => $data[$i],'created_at' => $current_time, 'updated_at' => $update_time];
                }
                
            }

            // echo "<pre>";
            // print_r($manual_data_id);
            // exit();

            $manualData = DB::table('client')->insert($manual_data_id);

            return redirect('destination-registration')->with('success','ID added successfully');
        }else{
            return redirect ('user-login');
        }
    }

    public function createDestination(){
        if(Auth::user()){
        $title = '宛先登録';
        $active_destination = 'active';
        $user_main_content = view('user.create_destination');
        return view('master',compact('user_main_content','active_destination','title'));
        }else{
            return redirect ('user-login');
        }
    }
    public function saveHashtagInfo(Request $request){
        if(Auth::user()){

        $this->validate($request, [

            'hashtag' => 'required|unique:hashtag|max:500',
            'id' => 'required'
        ]);

        $user_id = Auth::user()->id;
        $current_time = Carbon::now()->addHour(6);
        $update_time = Carbon::now()->addHour(6);
        $hashtag_insert_id = Hashtag::create(['user_id'=>$user_id,'hashtag'=>$request->hashtag,'created_at' => $current_time, 'updated_at' => $update_time]);

        if($request->hasFile('file')){
            $extension = File::extension($request->file->getClientOriginalName());
            if ($extension == "csv") {

                
 
                $path = $request->file->getRealPath();
                // if($extension == "csv"){
                    // $data = Excel::load($path, function($reader) {
                    // })->get();
                    $data = array_map('str_getcsv', file($path));
                   
                // }else{
                //     $data = Excel::load($path, function($reader) {
                //     })->get()->first();
                // }
                
                if(!empty($data)){

                    $data_count = count($data);


                    for ($i=0; $i < $data_count ; $i++) { 
                        foreach ($data[$i] as $key => $value) {                              
                                $insert[] = [
                                'client_id' => $value,
                                ];                            
                        }
                    }

                    $row = count($insert);

                    for ($i=1; $i < $row; $i++) { 
                        if($insert[$i]['client_id'] != null && $insert[$i]['client_id'] != 'NULL'){
                            $insert_data[] = ['user_id' => $user_id,'hashtag_id' => $hashtag_insert_id->id,'client_id' => $insert[$i]['client_id'],'created_at' => $current_time, 'updated_at' => $update_time];
                        }
                    }

                    if(!empty($insert_data)){
 
                        $insertData = DB::table('client')->insert($insert_data);

                        $manual_id = $request->id;
                        $data = explode(",", $manual_id);
                        $manual_row = count($data);
                        for ($i=0; $i < $manual_row; $i++) {                             
                            $manual_data_id[] = ['user_id' => $user_id,'hashtag_id' => $hashtag_insert_id->id,'client_id' => $data[$i],'created_at' => $current_time, 'updated_at' => $update_time];
                            
                        }

                        $manualData = DB::table('client')->insert($manual_data_id);

                        if ($insertData) {
                            Session::flash('success', 'Your client id successfully added');
                        }else {                        
                            Session::flash('error', 'Error inserting the data..');
                            return back();
                        }
                    }
                }
 
                return back();
 
            }else {
                Session::flash('error', 'File is a '.$extension.' file.!! Please upload a valid csv file..!!');
                return back();
            }
        }else{
            $manual_id = $request->id;
            $data = explode(",", $manual_id);
            $manual_row = count($data);
            for ($i=0; $i < $manual_row; $i++) {                             
                $manual_data_id[] = ['user_id' => $user_id,'hashtag_id' => $hashtag_insert_id->id,'client_id' => $data[$i],'created_at' => $current_time, 'updated_at' => $update_time];
                
            }

            $manualData = DB::table('client')->insert($manual_data_id);
            if ($manualData) {
                Session::flash('success', 'Your client id successfully added');
            }else {                        
                Session::flash('error', 'Error inserting the data..');
                
            }
            return back();
        }
        }else{
            return redirect ('user-login');
        }
        
    }

    public function SetSchedule(Request $request){

        if(Auth::user()){
            $user_id = Auth::user()->id;

            $result = Schedule::create($request->all());
            
            $current_time = Carbon::now()->addHour(6);
            $update_time = Carbon::now()->addHour(6);

            $template_data = array(array('template_id' => $request->destination, 'schedule_id' => $result->id,'created_at' =>$current_time,'updated_at' => $update_time));
            $template_schedule = TemplateSchedule::insert($template_data);

            $hashtag_data = array(array('hashtag_id' => $request->draft, 'schedule_id' => $result->id,'created_at' =>$current_time,'updated_at' => $update_time));
            $hashtag_schedule = HashtagSchedule::insert($hashtag_data);

            $user_data = array(array('user_id' => $user_id, 'schedule_id' => $result->id,'created_at' =>$current_time,'updated_at' => $update_time));
            $user_flag = UserSchedule::insert($user_data);

            return redirect('delivery-setting')->with('schedule_success','Schedule set successfully');
        }
    }


    public function deliverySetting(){
        if(Auth::user()){
        $id = Auth::user()->id;
        $templates = Template::select('title','id')->where([['user_id','=',$id]])->get();
        $hashtags = Hashtag::select('hashtag','id')->where([['user_id','=',$id]])->get();
//        print_r($templates) ;
//        exit();

        
        $title = '配信設定';
        $delivery_setting = 'active';
        $user_main_content = view('user.delivery_setting',compact('templates','hashtags'));
        return view('master',compact('user_main_content','delivery_setting','title'));
        }else{
            return redirect ('user-login');
        }
    }

    public function template(){
        if(Auth::user()){
        $user_main_content = view('user.template');
        return view('master',compact('user_main_content'));
        }else{
            return redirect ('user-login');
        }
    }

    public function analytics(){
        if(Auth::user()){
            $numberOfLists = Schedule::count();
            $numberSent = Client::where([['dm_sent', '=', '1']])->count();
        $title = 'アナリティクス';
        $analytics = 'active';
        $user_main_content = view('user.analytics',compact('numberOfLists','numberSent'));
        return view('master',compact('user_main_content','analytics','title'));
        }else{
            return redirect ('user-login');
        }
    }

    public function request(){
        if(Auth::user()){
        $title = 'ご請求';
        $request = 'active';
        $user_main_content = view('user.request');
        return view('master',compact('user_main_content','request','title'));
        }else{
            return redirect ('user-login');
        }
    }


    public function downloadCSV($hashtagName){
        if(Auth::user()){

        $this->ig->login('webvision100','instagram123456');
//             session()->put('userName','webvision100');
//             session()->put('password','instagram123456');
        //$hastag = $this->ig->hashtag->search('worldseriescricket');
        $rank_token= \InstagramAPI\Signatures::generateUUID();
        $result = $this->ig->hashtag->getFeed($hashtagName,$rank_token);
        //$result = $this->ig->media->getComments('1965957446195605717_7312650484');
        $obj = json_decode($result);
        //$userid = array();
        $counter = 0;

        $headers = array(
        "Content-type" => "text/csv",
        "Content-Disposition" => "attachment; filename=file.csv",
        "Pragma" => "no-cache",
        "Cache-Control" => "must-revalidate, post-check=0, pre-check=0",
        "Expires" => "0"
        );

        $columns = array('Hashtag ID');

        $callback = function() use ($obj, $columns)
        {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);

            foreach($obj->items as $media) {
                fputcsv($file, array($media->user->pk));
            }
            fclose($file);
        };
        return response()->stream($callback, 200, $headers);
        }else{
            return redirect ('user-login');
        }

        //old download csv file start//

        // $headers = array(
        // "Content-type" => "text/csv",
        // "Content-Disposition" => "attachment; filename=file.csv",
        // "Pragma" => "no-cache",
        // "Cache-Control" => "must-revalidate, post-check=0, pre-check=0",
        // "Expires" => "0"
        // );

        // $client_ids = Client::get()->all();

        // echo "<pre>";
        // print_r($reviews);
        // exit();

        // $manual_id = $request->id;
        // $data = explode(",", $manual_id);
        // $manual_row = count($data);
        // for ($i=0; $i < $manual_row; $i++) {                             
        //     $manual_data_id[] = ['client_id' => $data[$i]];
            
        // }

        // $columns = array('Client ID');

        // $callback = function() use ($client_ids, $columns)
        // {
        //     $file = fopen('php://output', 'w');
        //     fputcsv($file, $columns);

        //     foreach($client_ids as $client_id) {
        //         fputcsv($file, array($client_id->client_id));
        //     }
        //     fclose($file);
        // };
        // return response()->stream($callback, 200, $headers);

        //old download csv file end//
    }



    public function hashtagSelected($hashtagName){
        if(Auth::user()){
        $this->ig->login('webvision100','instagram123456');
//             session()->put('userName','webvision100');
//             session()->put('password','instagram123456');
        //$hastag = $this->ig->hashtag->search('worldseriescricket');
        $rank_token= \InstagramAPI\Signatures::generateUUID();
        $result = $this->ig->hashtag->getFeed($hashtagName,$rank_token);
        //$result = $this->ig->media->getComments('1965957446195605717_7312650484');
        $obj = json_decode($result);
        //$userid = array();
        $counter = 0;
//        foreach ($obj->items as $media){
//
//                //echo $counter;
//                $userc = $this->ig->media->getComments($media->id);
//                $comment = json_decode($userc);
//                if ($comment->comments != null){
//                    foreach ($comment->comments as $comment){
//                        echo $comment->user_id;
//                        echo "**";
//                        // echo $counter;
//                    }
//                }
//
//
//            if (floor(sizeof($obj->items)/2) <= $counter){
//                break;
//            }
//
//                $counter++;
//        }
        foreach ($obj->items as $media){

          // print_r($obj->ranked_items[0]->user->pk) ;
            echo $media->user->pk;
           echo ",";

        }
        foreach ($obj->ranked_items as $media) {

            echo $obj->ranked_items[0]->user->pk  ;
            echo ",";
            foreach ($media->preview_comments as $preview_comment){
               echo $preview_comment->user_id;
                echo ",";
            }

        }
        }else{
            return redirect ('user-login');
        }
        //return $result;
    }

    public function hashtagSearch(Request $request){
        if(Auth::user()){
        $hashtag = $request->hashtag;
        $this->ig->login('webvision100','instagram123456');
//             session()->put('userName','webvision100');
//             session()->put('password','instagram123456');
        //$hastag = $this->ig->hashtag->search('worldseriescricket');
        $rank_token= \InstagramAPI\Signatures::generateUUID();
        $result = $this->ig->hashtag->search($hashtag);
        //$hastag = $this->ig->media->getLikers('1962298581207415662_2677011');
        $obj = json_decode($result);
        $hashtagName = array();
        $postCounter = array();

//        for ($i=0; $i< sizeof($obj->results);$i++){
//            array_push($hashtagName,$obj->results[$i]->name);
//            array_push($postCounter,$obj->results[$i]->search_result_subtitle);
//        }
//        foreach ($obj->results as $result){
//            print_r($result->id);
//            echo '*';
//            print_r($result->name);
//            echo '*';
//            print_r($result->search_result_subtitle);
//            echo "\n";
//        }
        $results = $obj->results;
//        array_push($hashtagName,$obj->results[0]->name);
        $title = '宛先登録';
        $active_destination = 'active';
        $user_main_content = view('user.create_destination',compact('results'));
        return view('master',compact('user_main_content','active_destination','title'));
        }else{
            return redirect ('user-login');
        }
    }

    public function hashtagList(){
        if(Auth::user()){
        $title = '宛先登録';
        $active_destination = 'active';
        $user_main_content = view('user.hashtag_list');
        return view('master',compact('user_main_content','active_destination','title'));
        }else{
            return redirect ('user-login');
        }
    }

    public function hashtagListSearch(Request $request){
        if(Auth::user()){
            $user_id = Auth::user()->id;
            $hashtag = $request->hashtag;
            $user_info = DB::table('users')->select('instagram_username','instagram_password')->where('id',$user_id)->first();
            $this->ig->login($user_info->instagram_username,$user_info->instagram_password);
            $rank_token= \InstagramAPI\Signatures::generateUUID();
            $result = $this->ig->hashtag->search($hashtag);
          
            $obj = json_decode($result);
            $hashtagName = array();
            $postCounter = array();

            $results = $obj->results;

            $title = '宛先登録';
            $active_destination = 'active';
            $user_main_content = view('user.hashtag_list',compact('results'));
            return view('master',compact('user_main_content','active_destination','title'));
        }else{
            return redirect ('user-login');
        }
    }

    public function hashtagListSearchCSV(Request $request){
        if(Auth::user()){

        

        $user_id = Auth::user()->id;
        $hashtagName = $request->hashtag_list;
        $exit_info = DB::table('hashtag')->where('hashtag',$hashtagName)->first();
        if($exit_info){
            return redirect('create-destination')->with('errot_message','Hashtag already exits');
        }
        $user_info = DB::table('users')->select('instagram_username','instagram_password')->where('id',$user_id)->first();
        // echo "<pre>";
        // print_r($user_info);
        // exit();
        $this->ig->login($user_info->instagram_username,$user_info->instagram_password);
//             session()->put('userName','webvision100');
//             session()->put('password','instagram123456');
        //$hastag = $this->ig->hashtag->search('worldseriescricket');
        $rank_token= \InstagramAPI\Signatures::generateUUID();
        $result = $this->ig->hashtag->getFeed($hashtagName,$rank_token);
        //$result = $this->ig->media->getComments('1965957446195605717_7312650484');
        $obj = json_decode($result);
        //$userid = array();
        $counter = 0;

        $row = count($obj->items);
        $current_time = Carbon::now()->addHour(6);
        $update_time = Carbon::now()->addHour(6);
        $user = new Hashtag();
        $user->user_id= $user_id;  
        $user->hashtag= $hashtagName; 
        $user->created_at= $current_time; 
        $user->updated_at= $update_time; 
        $user->save();
        $lastInsertId = $user->id;

        // $flag = DB::table('hashtag')->insert($hashtag_data)->lastInsertId();
        // echo "<pre>";
        // print_r($lastInsertId);
        // exit();
        
        foreach($obj->items as $media) {
            $insert[] = $media->user->pk;
        }

        foreach ($obj->ranked_items as $media) {

            // echo $obj->ranked_items[0]->user->pk  ;
            // echo ",";
            foreach ($media->preview_comments as $preview_comment){
               // echo $preview_comment->user_id;
                // echo ",";
                array_push($insert,$preview_comment->user_id);
            }

        }

        $row = count($insert);

        // echo "<pre>";
        // print_r($insert);
        // exit();

        for ($i=0; $i < $row; $i++) { 
            if($obj->items){
                $insert_data[] = ['user_id' => $user_id,'hashtag_id' => $lastInsertId,'client_id' => $insert[$i],'created_at' => $current_time, 'updated_at' => $update_time];
            }
        }

        $flag = Client::insert($insert_data);

        return redirect('create-destination')->with('message','Hastag and its ID added successfully');

        // $headers = array(
        // "Content-type" => "text/csv",
        // "Content-Disposition" => "attachment; filename=file.csv",
        // "Pragma" => "no-cache",
        // "Cache-Control" => "must-revalidate, post-check=0, pre-check=0",
        // "Expires" => "0"
        // );

        // $columns = array('Hashtag ID');

        // $callback = function() use ($obj, $columns)
        // {
        //     $file = fopen('php://output', 'w');
        //     fputcsv($file, $columns);

        //     foreach($obj->items as $media) {
        //         fputcsv($file, array($media->user->pk));
        //     }
        //     fclose($file);
        // };
        // return response()->stream($callback, 200, $headers);
        }else{
            return redirect ('user-login');
        }
        //return $result;
    }

    public function deleteDestinationRegistration($id)
    {
        if(Auth::user()){
            // Hashtag::destroy($id);
            $flag = HashtagSchedule::where('hashtag_id',$id)->delete();
            $flag = Client::where('hashtag_id',$id)->delete();        
            $flag = Hashtag::destroy($id);
           
      //   DB::table('hashtag')
      // ->join('client', 'hashtag.id', 'client.hashtag_id')
      // ->join('hashtag_schedule', 'hashtag.id', 'hashtag_schedule.hashtag_id')
      // ->where('hashtag.id', $id)
      // ->delete();
      return redirect('destination-registration')->with('delete_success','Hashtag deleted successfully');
        }else{
            return redirect ('user-login');
        }
    }

    public function deleteTemplate($id)
    {
        if(Auth::user()){
            $flag = Template::destroy($id);
           
            return redirect('manuscript-registration')->with('delete_success','Template deleted successfully');
        }else{
            return redirect ('user-login');
        }
    }

    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
