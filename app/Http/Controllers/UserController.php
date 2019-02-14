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
            $title = 'Index page';
            $user_main_content = view('user.dashboard');
            return view('master',compact('user_main_content','title'));
        }else{
            return redirect ('user-login');
        }
    }

    public function manuscriptRegistration(){
        if(Auth::user()){
            $all_template = Template::paginate(3);
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
            $file->move('uploads/template/', $file_path_name);
        }
        // $info = Album::create($request->all());

        $user_id = Auth::user()->id;

        $current_time = Carbon::now()->addHour(6);
        $update_time = Carbon::now()->addHour(6);

        $data = array(
            array('user_id' => $user_id, 'title' => $request->title, 'description' => $request->description, 'image' => $file_path_name, 'created_at' => $current_time, 'updated_at' => $update_time)
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

        $file_path_name = $request->exits_image;
        if (Input::hasFile('image')) {
            $file = Input::file('image');
            $file_path_name = rand(1, 10000000) . $file->getClientOriginalName();
            $file->move('uploads/template/', $file_path_name);
        }

        $flag = Template::findOrfail($id);
        $flag->user_id = Auth::user()->id;
        $flag->title = $request->title;
        $flag->description = $request->description;
        $flag->image = $file_path_name;
        $flag->updated_at = Carbon::now()->addHour(6);

        $flag->save();
        return redirect('/manuscript-registration')->with('edit_success','Template updated successfully !');
        }else{
            return redirect ('user-login');
        }
    }

    public function destinationRegistration(){
        if(Auth::user()){
        $title = '宛先登録';
        $active_destination = 'active';
        $user_main_content = view('user.destination_registration');
        return view('master',compact('user_main_content','active_destination','title'));
        }else{
            return redirect ('user-login');
        }
    }

    public function createDestination(){
        if(Auth::user()){
        $title = '宛先登録';
        $active_destination = 'active';
        $user_main_content = view('user.test');
        return view('master',compact('user_main_content','active_destination','title'));
        }else{
            return redirect ('user-login');
        }
    }
    public function saveHashtagInfo(Request $request){
        if(Auth::user()){

        $this->validate($request, [

            'hashtag' => 'required|unique:hashtag|max:500',
            'file' => 'required',
            'id' => 'required'
        ]);

        $user_id = Auth::user()->id;
        $current_time = Carbon::now()->addHour(6);
        $update_time = Carbon::now()->addHour(6);

        if($request->hasFile('file')){
            $extension = File::extension($request->file->getClientOriginalName());
            if ($extension == "csv") {

                $hashtag_insert_id = Hashtag::create(['user_id'=>$user_id,'hashtag'=>$request->hashtag,'created_at' => $current_time, 'updated_at' => $update_time]);
 
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

                    for ($i=0; $i < $row; $i++) { 
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
        }
        }else{
            return redirect ('user-login');
        }
        
    }

    public function SetSchedule(Request $request){

        $result = Schedule::create($request->all());
        return redirect('delivery-setting');
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
        $title = 'アナリティクス';
        $analytics = 'active';
        $user_main_content = view('user.analytics');
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