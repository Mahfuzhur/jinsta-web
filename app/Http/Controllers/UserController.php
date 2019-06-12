<?php

namespace App\Http\Controllers;

use App\History;
use App\Invoice;
use Illuminate\Contracts\Encryption\EncryptException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Carbon\Carbon;
use Crypt;
use Auth;
use File;
use Excel;
use DB;
use PDF;
use Illuminate\View\View;
use Session;
use Alert;
use InstagramAPI;
use App\Template;
use App\Hashtag;
use App\Client;
use App\User;
use App\Schedule;
use App\HashtagSchedule;
use App\TemplateSchedule;
use App\UserSchedule;
use App\Setting;
use App\UserExtraInformation;



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
        Auth::logout();
        Session::flush();

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
//            $all_hashtags = DB::select("SELECT a.id, a.hashtag, COUNT(c.client_id) AS total_user
//                    FROM hashtag a
//                    JOIN client c ON c.hashtag_id = a.id
//                    WHERE a.user_id = $user_id
//                    GROUP BY a.id");
            $check_suspend_user = User::findOrfail($user_id);
            if($check_suspend_user->account_status == 2){
                Auth::logout();
                Session::flush();
                return back()->with('suspend_msg','Your account has been suspended. Plese contact with us for further queries.');
            } 
            $month = \Carbon\Carbon::today()->subDays(30);
            $week = \Carbon\Carbon::today()->subDays(7);
            $day = \Carbon\Carbon::today()->subDays(1);

            $last_month = History::where([['updated_at', '>=', $month],['dm_sent','=', '1'],['user_id', '=', $user_id]])->count();
            $last_week = History::where([['updated_at', '>=', $week],['dm_sent','=', '1'],['user_id', '=', $user_id]])->count();
            $last_day = History::where([['updated_at', '>=', $day],['dm_sent','=', '1'],['user_id', '=', $user_id]])->count();
            $title = 'Index page';
            $user_info = DB::table('users')->where('id',$user_id)->first();
            try{
                if($user_info->instagram_username != NULL && $user_info->instagram_password != NULL){
                    $result = $this->ig->login($user_info->instagram_username,$user_info->instagram_password);
                    $selfInfo = $this->ig->people->getSelfInfo();
                    $json_selfinfo = json_decode($selfInfo,true);
                }else{
                        $json_selfinfo['message'] = '';
                    }
            }catch (\Exception $ex){
                $json_selfinfo['message'] = '';
                // return $ex;
            }
            

            $data_info['dm_sent'] = History::selectRaw('hashtag.hashtag, history.hashtag_name,hashtag_schedule.schedule_id,template_schedule.template_id,template.title, COUNT(history.dm_sent) AS total_sent')
            ->join('hashtag', 'history.hashtag_name', '=', 'hashtag.id')
            ->join('hashtag_schedule', 'hashtag.id', '=', 'hashtag_schedule.hashtag_id')
            ->join('schedule', 'hashtag_schedule.schedule_id', '=', 'schedule.id')
            ->join('template_schedule', 'hashtag_schedule.schedule_id', '=', 'template_schedule.schedule_id')
            ->join('template', 'template_schedule.template_id', '=', 'template.id')
            ->whereNull('schedule.deleted_at')->where('history.dm_sent',1)->where('history.user_id',$user_id)->groupBy('history.hashtag_name')->orderBy('schedule.id','desc')->paginate(3);

            $data_info['without_dm_sent'] = Client::selectRaw('hashtag.hashtag, client.hashtag_id,hashtag_schedule.schedule_id,template_schedule.template_id,template.title, COUNT(client.dm_sent) AS total_row')
            ->join('hashtag', 'client.hashtag_id', '=', 'hashtag.id')
            ->join('hashtag_schedule', 'hashtag.id', '=', 'hashtag_schedule.hashtag_id')
            ->join('schedule', 'hashtag_schedule.schedule_id', '=', 'schedule.id')
            ->join('template_schedule', 'hashtag_schedule.schedule_id', '=', 'template_schedule.schedule_id')
            ->join('template', 'template_schedule.template_id', '=', 'template.id')
            ->whereNull('schedule.deleted_at')->where('client.user_id',$user_id)->groupBy('client.hashtag_id')->orderBy('schedule.id','desc')->paginate(3);

        // $data_info['dm_sent'] = DB::select("SELECT hashtag.hashtag, client.hashtag_id,hashtag_schedule.schedule_id,template_schedule.template_id,template.title, COUNT(client.dm_sent) AS total_sent
        //             FROM client client
        //             JOIN hashtag hashtag ON client.hashtag_id = hashtag.id
        //             JOIN hashtag_schedule hashtag_schedule ON hashtag.id = hashtag_schedule.hashtag_id
        //             JOIN template_schedule template_schedule ON hashtag_schedule.schedule_id = template_schedule.schedule_id
        //             JOIN template template ON template_schedule.template_id = template.id
        //             WHERE client.user_id = $user_id AND client.dm_sent = 1                     
        //             GROUP BY client.hashtag_id ORDER BY client.id DESC LIMIT 3");

        // $data_info['without_dm_sent'] = DB::select("SELECT hashtag.hashtag, client.hashtag_id,hashtag_schedule.schedule_id,template_schedule.template_id,template.title, COUNT(client.dm_sent) AS total_row
        //             FROM client client
        //             JOIN hashtag hashtag ON client.hashtag_id = hashtag.id
        //             JOIN hashtag_schedule hashtag_schedule ON hashtag.id = hashtag_schedule.hashtag_id
        //             JOIN template_schedule template_schedule ON hashtag_schedule.schedule_id = template_schedule.schedule_id
        //             JOIN template template ON template_schedule.template_id = template.id
        //             WHERE client.user_id = $user_id                     
        //             GROUP BY client.hashtag_id ORDER BY client.id DESC LIMIT 3");

        // echo "<pre>";
        // print_r($json_selfinfo['user']['username']);
        // exit();

            // $user_main_content = view('user.dashboard',compact('json_selfinfo'));

            $numberOfLists = Schedule::count();
            $numberSent = Client::where([['dm_sent', '=', '1']])->count();

            $trial_period = Setting::select('trial_period')->first();
            $company_info = User::where([['id','=',$user_id]])->first();
            $added_date = \Carbon\Carbon::parse($company_info->updated_at)->addDays($trial_period->trial_period);
            $today = \Carbon\Carbon::today()->addDays(0);

            $title = 'Index page';
            $user_main_content = view('user.dashboard',compact('numberOfLists','numberSent','json_selfinfo','data_info','last_day','last_month','last_week'));

            return view('master',compact('user_main_content','title','added_date','today','company_info'));
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

            'image' => 'image|mimes:jpg,jpeg,png,svg'
        ]);

        if($request->title == NULL && $request->description == NULL && $request->image == NULL){
            return redirect('create-manuscript')->with('empty_msg','少なくとも1つの欄に記入してください');
        }

        $imageName = NULL;
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
        $single_template = Template::findOrfail(Crypt::decrypt($id));
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

            'image' => 'image|mimes:jpg,jpeg,png,svg'
        ]);

        if($request->title == NULL && $request->description == NULL && $request->image == NULL){
            return back()->with('empty_msg','少なくとも1つの欄に記入してください');
        }

        // $imageName = $request->exits_image;
        $imageName = NULL;
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
       $all_hashtag = hashtag::selectRaw('hashtag.id,hashtag.hashtag, count(client.client_id) as total_user')
                 ->join('client', 'hashtag.id', '=', 'client.hashtag_id')
                 ->where('hashtag.user_id',$user_id)
                 ->groupBy('hashtag.id')
                 ->get();


        // $all_hashtag = DB::select("SELECT a.id, a.hashtag, COUNT(c.client_id) AS total_user
        //             FROM hashtag a
        //             JOIN client c ON c.hashtag_id = a.id
        //             WHERE a.user_id = $user_id
        //             GROUP BY a.id");

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

            'hashtag' => 'required|max:500',
            
        ]);

        $user_id = Auth::user()->id;
        $current_time = Carbon::now()->addHour(6);
        $update_time = Carbon::now()->addHour(6);
        $hashtag_insert_id = Hashtag::create(['user_id'=>$user_id,'hashtag'=>$request->hashtag,'created_at' => $current_time, 'updated_at' => $update_time]);

        if($request->hasFile('file') && $request->id != NULL){
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
                Session::flash('error', 'ファイルは '.$extension.' ファイル。！！有効なcsvファイルをアップロードしてください。');
                return back();
            }
        }elseif($request->hasFile('file') && $request->id == NULL){
            $extension = File::extension($request->file->getClientOriginalName());
            if ($extension == "csv") {
                $path = $request->file->getRealPath();               
                $data = array_map('str_getcsv', file($path));                              
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

                    // echo "<pre>";
                    // print_r($row);
                    // exit();

                    if(!empty($insert_data)){
                        $insertData = DB::table('client')->insert($insert_data);
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
                Session::flash('error', 'ファイルは '.$extension.' ファイル。！！有効なcsvファイルをアップロードしてください。');
                return back();
            }
        }

        elseif($request->hasFile('file') == NULL && $request->id != NULL){
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
        }else{
            return redirect('hashtag-manually-add')->with('error_msg','あなたはcsvファイルか手動ユーザーIDを与えなければなりません');
        }


        }else{
            return redirect ('user-login');
        }
        
    }

    public function SetSchedule(Request $request){

        if(Auth::user()){

            $this->validate($request, [

                'draft' => 'required',
                'destination' => 'required',
                'delivery_period_start' => 'required',
                'delivery_period_end' => 'required',
                'specify_time_start' => 'required',
                'specify_time_end' => 'required'
                
            ]);

            $user_id = Auth::user()->id;
            $user_info = DB::table('users')->where('id',$user_id)->first();
            if($user_info->instagram_username == NULL || $user_info->instagram_username == NULL){
                return redirect('dashboard');
            }

            $delivery_period_start = $request->delivery_period_start;
            $delivery_period_end = $request->delivery_period_end;
            $date_exclusion_setting_start = $request->date_exclusion_setting_start;
            $date_exclusion_setting_end = $request->date_exclusion_setting_end;

            if(strtotime($delivery_period_end) < strtotime($delivery_period_start)){
                return back()->with('date_erroe_msg','End date must be greater than start date');
            }


            $specify_time_start = $request->specify_time_start;
            $specify_time_end = $request->specify_time_end;
            $time_exclusion_setting_start = $request->time_exclusion_setting_start;
            $time_exclusion_setting_end = $request->time_exclusion_setting_end;

            $specify_time_start = Carbon::parse($specify_time_start);
            $specify_time_end = Carbon::parse($specify_time_end);
            $specify_time_start = $specify_time_start->subHour(9)->format('H:i');
            $specify_time_end = $specify_time_end->subHour(9)->format('H:i');

            if($specify_time_start == $specify_time_end){
                return back()->with('time_erroe_msg','Start and End time can not be same');
            }

            if($time_exclusion_setting_start != NULL && $time_exclusion_setting_end != NULL){
                $time_exclusion_setting_start = Carbon::parse($time_exclusion_setting_start);
                $time_exclusion_setting_end = Carbon::parse($time_exclusion_setting_end);
                
                $time_exclusion_setting_start = $time_exclusion_setting_start->subHour(9)->format('H:i');
                $time_exclusion_setting_end = $time_exclusion_setting_end->subHour(9)->format('H:i');
            }

            




//            if($delivery_period_start > $delivery_period_end){
//                return redirect('delivery-setting')->with('schedule_err_msg','End date should be greater than start date');
//            }
//            if($date_exclusion_setting_start != NULL || $date_exclusion_setting_end){
//                if($date_exclusion_setting_start > $date_exclusion_setting_end){
//                    return redirect('delivery-setting')->with('schedule_err_msg','Exclusion End date should be greater than exclusion start date');
//                }
//            }
//            if($specify_time_start > $specify_time_end){
//                return redirect('delivery-setting')->with('schedule_err_msg','End time should be greater than start time');
//            }
//            if($time_exclusion_setting_start != NULL || $time_exclusion_setting_end){
//                if($time_exclusion_setting_start > $time_exclusion_setting_end){
//                    return redirect('delivery-setting')->with('schedule_err_msg','Exclusion End date should be greater than exclusion start date');
//                }
//            }

            $user_id = Auth::user()->id;

            // $result = Schedule::create($request->all());
            
            $current_time = Carbon::now()->addHour(6);
            $update_time = Carbon::now()->addHour(6);

            $result = new Schedule();
            $result->destination = $request->destination;
            $result->draft = $request->draft;
            $result->delivery_period_start = $delivery_period_start;
            $result->delivery_period_end = $delivery_period_end;
            $result->date_exclusion_setting_start = $date_exclusion_setting_start;
            $result->date_exclusion_setting_end = $date_exclusion_setting_end;
            $result->specify_time_start = $specify_time_start;
            $result->specify_time_end = $specify_time_end;
            $result->time_exclusion_setting_start = $time_exclusion_setting_start;
            $result->time_exclusion_setting_end = $time_exclusion_setting_end;
            $result->created_at = $current_time;
            $result->updated_at = $update_time;
            $result->save();

            // $schedule_data = array(array('destination' => $request->destination, 'draft' => $request->draft,'delivery_period_start' => $delivery_period_start, 'delivery_period_end' => $delivery_period_end,'date_exclusion_setting_start' => $date_exclusion_setting_start, 'date_exclusion_setting_end' => $date_exclusion_setting_end,'specify_time_start' => $specify_time_start, 'specify_time_end' => $specify_time_end,'time_exclusion_setting_start' => $time_exclusion_setting_start, 'time_exclusion_setting_end' => $time_exclusion_setting_end,'created_at' =>$current_time,'updated_at' => $update_time));
            // $schedule = Schedule::insert($schedule_data);

            $template_data = array(array('template_id' => $request->destination, 'schedule_id' => $result->id,'created_at' =>$current_time,'updated_at' => $update_time));
            $template_schedule = TemplateSchedule::insert($template_data);

            $hashtag_data = array(array('hashtag_id' => $request->draft, 'schedule_id' => $result->id,'created_at' =>$current_time,'updated_at' => $update_time));
            $hashtag_schedule = HashtagSchedule::insert($hashtag_data);

            $user_data = array(array('user_id' => $user_id, 'schedule_id' => $result->id,'created_at' =>$current_time,'updated_at' => $update_time));
            $user_flag = UserSchedule::insert($user_data);

            return redirect('delivery-setting')->with('schedule_success','Schedule set successfully');
        }
    }

    public function time_subtract($time){
        $to = \Carbon\Carbon::createFromFormat('H:s', $time);
        $from = \Carbon\Carbon::createFromFormat('H:s', '6:00');
        $diffInSeconds = $to->diffInSeconds($from);
        return gmdate('H:s', $diffInSeconds);
    }


    public function deliverySetting(){
        if(Auth::user()){
        $id = Auth::user()->id;
        $schedule_id = DB::table('schedule')
                        ->join('user_schedule','schedule.id','=','user_schedule.schedule_id')
                        ->select('schedule.draft as draft')
                        ->where('user_schedule.user_id',$id)->get();
       if(isset($schedule_id)){
            foreach ($schedule_id as $schedule) {
                $ex_draft[] = $schedule->draft;
            }
        }
        $templates = Template::select('title','id')->where([['user_id','=',$id]])->get();
//        if(isset($ex_draft)){
//        $hashtags = Hashtag::select('hashtag','id')->where([['user_id','=',$id]])->whereNotIn('id', $ex_draft)->get();
//        }else{
//            $hashtags = Hashtag::select('hashtag','id')->where([['user_id','=',$id]])->get();
//        }
            $hashtags = Hashtag::select('hashtag','id')->where([['user_id','=',$id]])->get();
       // print_r($ex_draft) ;
       // exit();

        
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
            $user_id = Auth::user()->id;
            $numberOfLists = Hashtag::where('user_id',$user_id)->count();
            $numberOfSchedule = UserSchedule::where('user_id',$user_id)->count();
            $numberSent = History::where([['dm_sent', '=', '1'],['user_id','=',$user_id]])->count();
        $title = 'アナリティクス';
        $analytics = 'active';

        // $data_info['dm_sent'] = DB::select("SELECT hashtag.hashtag, client.hashtag_id,hashtag_schedule.schedule_id,template_schedule.template_id,template.title, COUNT(client.dm_sent) AS total_sent
        //             FROM client client
        //             JOIN hashtag hashtag ON client.hashtag_id = hashtag.id
        //             JOIN hashtag_schedule hashtag_schedule ON hashtag.id = hashtag_schedule.hashtag_id
        //             JOIN template_schedule template_schedule ON hashtag_schedule.schedule_id = template_schedule.schedule_id
        //             JOIN template template ON template_schedule.template_id = template.id
        //             WHERE client.user_id = $user_id AND client.dm_sent = 1
        //             GROUP BY client.hashtag_id ORDER BY client.id DESC LIMIT 3");

        // $data_info['without_dm_sent'] = DB::select("SELECT hashtag.hashtag, client.hashtag_id,hashtag_schedule.schedule_id,template_schedule.template_id,template.title, COUNT(client.dm_sent) AS total_row
        //             FROM client client
        //             JOIN hashtag hashtag ON client.hashtag_id = hashtag.id
        //             JOIN hashtag_schedule hashtag_schedule ON hashtag.id = hashtag_schedule.hashtag_id
        //             JOIN template_schedule template_schedule ON hashtag_schedule.schedule_id = template_schedule.schedule_id
        //             JOIN template template ON template_schedule.template_id = template.id
        //             WHERE client.user_id = $user_id
        //             GROUP BY client.hashtag_id ORDER BY client.id DESC LIMIT 3");

            $month = \Carbon\Carbon::today()->subDays(30);
            $week = \Carbon\Carbon::today()->subDays(7);
            $day = \Carbon\Carbon::today()->subDays(1);

            $last_month = History::where([['updated_at', '>=', $month],['dm_sent','=', '1'],['user_id', '=', $user_id]])->count();
            $last_week = History::where([['updated_at', '>=', $week],['dm_sent','=', '1'],['user_id', '=', $user_id]])->count();
            $last_day = History::where([['updated_at', '>=', $day],['dm_sent','=', '1'],['user_id', '=', $user_id]])->count();

        $data_info['dm_sent'] = History::selectRaw('hashtag.hashtag, history.hashtag_name,hashtag_schedule.schedule_id,template_schedule.template_id,template.title, COUNT(history.dm_sent) AS total_sent')
            ->join('hashtag', 'history.hashtag_name', '=', 'hashtag.id')
            ->join('hashtag_schedule', 'hashtag.id', '=', 'hashtag_schedule.hashtag_id')
            ->join('schedule', 'hashtag_schedule.schedule_id', '=', 'schedule.id')
            ->join('template_schedule', 'hashtag_schedule.schedule_id', '=', 'template_schedule.schedule_id')
            ->join('template', 'template_schedule.template_id', '=', 'template.id')
            ->whereNull('schedule.deleted_at')->where('history.dm_sent',1)->where('history.user_id',$user_id)->groupBy('history.hashtag_name')->orderBy('schedule.id','desc')->paginate(3);

            $data_info['without_dm_sent'] = Client::selectRaw('hashtag.hashtag, client.hashtag_id,hashtag_schedule.schedule_id,template_schedule.template_id,template.title, COUNT(client.dm_sent) AS total_row')
            ->join('hashtag', 'client.hashtag_id', '=', 'hashtag.id')
            ->join('hashtag_schedule', 'hashtag.id', '=', 'hashtag_schedule.hashtag_id')
            ->join('schedule', 'hashtag_schedule.schedule_id', '=', 'schedule.id')
            ->join('template_schedule', 'hashtag_schedule.schedule_id', '=', 'template_schedule.schedule_id')
            ->join('template', 'template_schedule.template_id', '=', 'template.id')
            ->whereNull('schedule.deleted_at')->where('client.user_id',$user_id)->groupBy('client.hashtag_id')->orderBy('schedule.id','desc')->paginate(3);

        $user_main_content = view('user.analytics',compact('numberOfLists','numberSent','data_info','numberOfSchedule'));
        return view('master',compact('user_main_content','analytics','title'));
        }else{
            return redirect ('user-login');
        }
    }

    public function request(){
        if(Auth::user()){
        $user_id = Auth::user()->id;
        $title = 'ご請求';
        $request = 'active';
        $message_rate = Setting::select('message_rate')->first();
        $numberSent = History::where([['user_id', '=', $user_id]])->where([['dm_sent', '=', '1']])->count();
        $user_main_content = view('user.request',compact('numberSent','message_rate'));
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
            // $hashtag = $request->search;
            $user_info = DB::table('users')->select('instagram_username','instagram_password')->where('id',$user_id)->first();
            if($user_info->instagram_username == NULL || $user_info->instagram_password == NULL){
                // return back()->with('instagram_error_msg',"You must provide instagram username and password from dashboard");
                // return redirect('dashboard');
                return response()->json(['insta_credential_err'=>'Update Instagram username and password from dashboard','data'=>'1']);
            }
            $this->ig->login($user_info->instagram_username,$user_info->instagram_password);
            $rank_token= \InstagramAPI\Signatures::generateUUID();
            $result = $this->ig->hashtag->search($hashtag);
          
            $obj = json_decode($result);
            if($obj->results == null){
                // return redirect('create-destination')->with('hashtag_found_msg','この＃キーワード検索でポストがありません。')->withInput();
                return response()->json(['no_hashtag_err'=>'この＃キーワード検索でポストがありません。','data'=>'2']);
                
            }
            $hashtagName = array();
            $postCounter = array();

            $results = $obj->results;

            $title = '宛先登録';
            $active_destination = 'active';
            // return view('user.ajax_search',compact('results','hashtag'));
            if ($request->flag !=null){
                $compareHashtag = $request->compareHashtag;
                $compareHashtag = json_decode($compareHashtag);
                $compareHashtag = hashtag::selectRaw('hashtag.id,hashtag.hashtag, count(client.client_id) as total_user')
                    ->join('client', 'hashtag.id', '=', 'client.hashtag_id')
                    ->where('hashtag.user_id',$user_id)
                    ->where('hashtag.id',$compareHashtag->id)
                    ->first();
                session(['compareHashtag' => $compareHashtag]);

                return view('user.ajax_compare_hashtag',compact('results','hashtag','compareHashtag'));

                // $user_main_content = view('user.compare_hashtag',compact('results','hashtag','compareHashtag'));
                // return view('master',compact('user_main_content','active_destination','title'));
            }
            else{
                return view('user.ajax_hashtag_list',compact('results','hashtag'));
                // $user_main_content = view('user.hashtag_list',compact('results','hashtag'));
                // return view('master',compact('user_main_content','active_destination','title'));
            }

        }else{
            return redirect ('user-login');
        }
    }

    public function hashtagListSearchCSV(Request $request){
        if(Auth::user()){

        $user_id = Auth::user()->id;
        $hashtagName = $request->hashtag_list;
        
        // $exit_info = DB::table('hashtag')->where('hashtag',$hashtagName)->first();
        // if($exit_info){
        //     return redirect('create-destination')->with('errot_message','Hashtag already exits');
        // }
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
        if ($request->flag == null){
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
        }


        // $flag = DB::table('hashtag')->insert($hashtag_data)->lastInsertId();
        // echo "<pre>";
        // print_r($lastInsertId);
        // exit();
        
//        foreach($obj->items as $media) {
//            $insert[] = $media->user->pk;
//        }
//
//        if(isset($obj->ranked_items)){
//
//            foreach ($obj->ranked_items as $media) {
//
//                // echo $obj->ranked_items[0]->user->pk  ;
//                // echo ",";
//                foreach ($media->preview_comments as $preview_comment){
//                   // echo $preview_comment->user_id;
//                    // echo ",";
//                    array_push($insert,$preview_comment->user_id);
//                }
//
//            }
//        }
            try{
               // $obj = json_decode($result);

                foreach($obj->items as $media) {
                    //$insert[] = $media->user->pk;
                    $result = $media->id;
                    $likers = $this->ig->media->getLikers($result);
//            foreach ($likers->users as $like){
//                $insert[] = $like->pk;
//            }
                    // $likers = $likers->users;
                    $likers = json_decode($likers);
                    foreach ($likers->users as $like){
//                        $insert[] = $like->pk;

                        //$count++;
                        if($request->flag != null){
                            $second = array();
                            array_push($second,$like->pk);
                        }else{
                            $insert_data[] = ['user_id' => $user_id,'hashtag_id' => $lastInsertId,'client_id' => $like->pk,'created_at' => $current_time, 'updated_at' => $update_time];
                        }



                    }

                }
            }
            catch (\Exception $ex){
                echo $ex;

            }
            finally{
//            $row = count($insert);
//
//                // echo "<pre>";
//                // print_r($insert);
//                // exit();
//
//            for ($i=0; $i < $row; $i++) {
//            if($obj->items){
//            $insert_data[] = ['user_id' => $user_id,'hashtag_id' => $lastInsertId,'client_id' => $insert[$i],'created_at' => $current_time, 'updated_at' => $update_time];
//            }
                if($request->flag == null){
                    $flag = Client::insert($insert_data);
                }

        }
        if($request->flag != null){

            $compareHashtag = json_decode($request->compareHashtag);
            $mainHashtag = Client::select('client_id')->where('hashtag_id' , '=', $compareHashtag->id)->get();

            $first = array();


            foreach ($mainHashtag as $mainHashtag){
                array_push($first,$mainHashtag->client_id);
            }


            $new_hashtag = array_diff($first,$second);
//            print_r($new);
//            exit();
            $active_destination = 'active';
            $compareHashtag = session('compareHashtag');

            return view('user.ajax_compare_checkbox_select',compact('compareHashtag','new_hashtag'));
            // $user_main_content = view('user.compare_hashtag',compact('compareHashtag','lastInsertId','new_hashtag'));
            // return view('master',compact('user_main_content','active_destination'));

            // $user_main_content = view('user.compare_hashtag',compact('compareHashtag','new_hashtag'));
            // return view('master',compact('user_main_content','active_destination'));

        }
            //$flag = Client::insert($insert_data);



        else{
            // return redirect('create-destination')->with('message','Hastag and its ID added successfully');
            return response()->json(
                ['data'=> 'Hastag and its ID added successfully','flag' => '1']
            );
        }


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
            // $flag = HashtagSchedule::where('hashtag_id',$id)->delete();
            // $flag = Client::where('hashtag_id',$id)->delete();        
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

    public function updateInstagramInfo(){
        if(Auth::user()){
            $title = 'instagram情報のアップデート';
            $user_main_content = view('user.update_instagram_info');
            return view('master',compact('user_main_content','title'));
        }else{
            return redirect ('user-login');
        }
    }

    public function checkUpdateInstagramInfo(Request $request){
        $user_id =Auth::user()->id;
        $userName = $request->email;
        $password = $request->password;
        try{
           $result1 = $this->ig->login($userName,$password);

             $result = DB::table('users')
                ->where('id', $user_id)
                ->update(['instagram_username' => $userName,'instagram_password' => $password]);
            return redirect('update-instagram-info')->with('success_msg','Instagram information successfully updated');
        }
        catch (\Exception $ex){
            return redirect('update-instagram-info')->with('check','invalid instagram username or password or security check');
            // return $ex;
        }

        //$selfInfo = $this->ig->people->getSelfInfo();


    }

    public function scheduleList(){
        if(Auth::user()){
            $user_id = Auth::user()->id;
            $title = 'スケジュール一覧';
            $schedule_list = 'active';
            $all_schedule = DB::table('users')
            ->join('user_schedule', 'users.id', '=','user_schedule.user_id' )
            ->join('schedule', 'schedule.id', '=', 'user_schedule.schedule_id')
            ->join('hashtag_schedule', 'hashtag_schedule.schedule_id', '=', 'schedule.id')
            ->join('template_schedule', 'template_schedule.schedule_id', '=', 'schedule.id')
            ->join('template', 'template.id', '=', 'template_schedule.template_id')
            ->join('hashtag', 'hashtag.id', '=', 'hashtag_schedule.hashtag_id')
            ->join('client', 'client.hashtag_id', '=', 'hashtag.id')
            ->select('schedule.id as s_id','users.name','users.instagram_username','users.instagram_password','schedule.delivery_period_start','schedule.delivery_period_end'
                ,'schedule.date_exclusion_setting_start','schedule.date_exclusion_setting_end'
                ,'schedule.specify_time_start','schedule.specify_time_end', 'schedule.time_exclusion_setting_start'
                , 'schedule.time_exclusion_setting_end','hashtag.hashtag','client.user_id','client.client_id',
                'client.hashtag_id','client.id','template.title','template.description','template.image','schedule.status')
            ->where([['user_schedule.user_id','=',$user_id]])
            ->whereNull('schedule.deleted_at')
            ->orderBy('schedule.id','desc')
            ->groupBy('schedule.id')
            ->paginate(10);

            $user_main_content = view('user.schedule_list',compact('all_schedule'));
            return view('master',compact('user_main_content','title','schedule_list'));
        }else{
            return redirect ('user-login');
        }
    }

    public function scheduleAction(Request $request){
        if(Auth::user()){
            $id = $request->id;
            $user_id = Auth::user()->id;
            // $status = $request->input('schedule_status');

            $schedule = Schedule::findOrfail($id);
            // echo "<pre>";
            // print_r($schedule);
            // exit();
            if($schedule->status == 1){
                $schedule->status = 0;
                $schedule->save();
                // return redirect('schedule-list');
                // return response()->json(['data'=>'stop','id' => $id]);
            }elseif($schedule->status == 0){
                $schedule->status = 1;
                $schedule->save();
                // return redirect('schedule-list');
                // return response()->json(['data'=>'start','id' => $id]);
            }

            $all_schedule = DB::table('users')
                ->join('user_schedule', 'users.id', '=','user_schedule.user_id' )
                ->join('schedule', 'schedule.id', '=', 'user_schedule.schedule_id')
                ->join('hashtag_schedule', 'hashtag_schedule.schedule_id', '=', 'schedule.id')
                ->join('template_schedule', 'template_schedule.schedule_id', '=', 'schedule.id')
                ->join('template', 'template.id', '=', 'template_schedule.template_id')
                ->join('hashtag', 'hashtag.id', '=', 'hashtag_schedule.hashtag_id')
                ->join('client', 'client.hashtag_id', '=', 'hashtag.id')
                ->select('schedule.id as s_id','users.name','users.instagram_username','users.instagram_password','schedule.delivery_period_start','schedule.delivery_period_end'
                    ,'schedule.date_exclusion_setting_start','schedule.date_exclusion_setting_end'
                    ,'schedule.specify_time_start','schedule.specify_time_end', 'schedule.time_exclusion_setting_start'
                    , 'schedule.time_exclusion_setting_end','hashtag.hashtag','client.user_id','client.client_id',
                    'client.hashtag_id','client.id','template.title','template.description','template.image','schedule.status')
                ->where([['user_schedule.user_id','=',$user_id]])
                ->whereNull('schedule.deleted_at')
                ->orderBy('schedule.id','desc')
                ->groupBy('schedule.id')
                ->paginate(10);
                return view('user.ajax_schedule_ist',compact('all_schedule'));

        }else{
            return Redirect::to('/admin-login');
        }

    }

    public function scheduleDelete($id)
    {
        if(Auth::user()){
            $flag = Schedule::where('id',$id)->delete();          
        return redirect('schedule-list')->with('delete_success','Schedule deleted successfully');
        }else{
            return redirect ('user-login');
        }
    }
    public function verifyEmail($token){
        $this->user = User::where('verify_email',$token)->first();
        Auth::logout();
        Session::flush();

        if ($this->user != null){
            //print_r($user);
            $this->user->verify_email = 1;
            $this->user->account_status = 1;
            $this->user->save();
            return redirect('user-login');
        }
        else{
           return redirect('user-login');
        }
       
    }

    public function compareHashtag(Request $request){
         $hashtag_id= $request->hashtag;
         $user_id = Auth::user()->id;
        $compareHashtag = hashtag::selectRaw('hashtag.id,hashtag.hashtag, count(client.client_id) as total_user')
            ->join('client', 'hashtag.id', '=', 'client.hashtag_id')
            ->where('hashtag.user_id',$user_id)
            ->where('hashtag.id',$hashtag_id)
            ->first();
        if(Auth::user()){

            $active_hashtag_compare = 'active';
            $main_content = view('user.compare_hashtag',compact('compareHashtag'));
            return view('master',compact('main_content','active_hashtag_compare'));

        }else{
            return redirect ('user-login');
        }
    }
    public function saveNewHashtag(Request $request){



        $firstHashtagId = $request->firstHashtagId;
        $newHashtag = $request->newHashtag;
        // echo "<pre>";
        // print_r($newHashtag);
        // exit();
        if($request->updatedHashtag == null){
            $newHashtagName = $request->existingHashtag;
            try{

                $clientDeleted = DB::table('client')->where('hashtag_id',$firstHashtagId)->delete();




            }catch (\Exception $ex){
                echo $ex;
            }
            Hashtag::where('id',$firstHashtagId)->update(['hashtag' => $newHashtagName]);
//        $hashtag = new Hashtag();
//        $hashtag->user_id = Auth::user()->id;
//        $hashtag->hashtag = $newHashtagName;
//        $hashtag->created_at = Carbon::now()->addHour(9);
//        $hashtag->save();
//        $lastInsertedId = $hashtag->id;

            foreach($newHashtag as $newHashtag){

                $client = new Client();
                $client->user_id = Auth::user()->id;
                $client->hashtag_id = $firstHashtagId;
                $client->client_id = $newHashtag;
                $client->created_at = Carbon::now()->addHour(9);
                $client->save();
            }
        }else{
            $newHashtagName = $request->updatedHashtag;
            $current_time = Carbon::now()->addHour(6);
            $update_time = Carbon::now()->addHour(6);
            $user = new Hashtag();
            $user->user_id= Auth::user()->id;
            $user->hashtag= $newHashtagName;
            $user->created_at= $current_time;
            $user->updated_at= $update_time;
            $user->save();
            $lastInsertId = $user->id;

            foreach($newHashtag as $newHashtag){

                $client = new Client();
                $client->user_id = Auth::user()->id;
                $client->hashtag_id = $lastInsertId;
                $client->client_id = $newHashtag;
                $client->created_at = Carbon::now()->addHour(9);
                $client->save();
            }
        }

         // return redirect('destination-registration')->with('message','Hastag and its ID updated successfully');
       return response()->json(
               ['data'=> 'Hastag and its ID updated successfully']
           );
    }


    public function saveUserExtraInformation(Request $request){

        if(Auth::user()){

        $this->validate($request, [

            'name' => 'required|string|max:255',
            'company_name' => 'required|string|max:255',
            'contact_number' => 'required|numeric',
            'street' => 'required|max:500',
            'postal_code' => 'required|max:255'
        ]);

        // $info = Album::create($request->all());

        $user_id = Auth::user()->id;

        $current_time = Carbon::now()->addHour(9);
        $update_time = Carbon::now()->addHour(9);

        $data = array(
            array('user_id' => $user_id, 'name' => $request->name, 'company_name' => $request->company_name, 'contact_number' => $request->contact_number,'street' => $request->street,'postal_code' => $request->postal_code, 'created_at' => $current_time, 'updated_at' => $update_time)
        );

        $flag = UserExtraInformation::insert($data);
        $update_flag = User::where('id',$user_id)->update(['account_status' => 3]);
        return redirect('dashboard')->with('user_extra_info','Extra user information added successfully !');
        }else{
            return redirect ('user-login');
        }
    }


    public function showBill(Request $request){
       $month = $request->month;
       $year = $request->year;
       $user_id = Auth::user()->id;

        $invoice = Invoice::where('user_id' , '=',$user_id )
            ->where('month' ,'=',$month)
            ->where('year','=',$year)
            ->first();


        if ($invoice != null){

            $message_rate = Setting::select('message_rate')->first();
            // $numberSent = History::where([['user_id', '=', $user_id]])->where([['dm_sent', '=', '1']])->count();

            $numberSent = $invoice->dm_total_number;

            $title = 'ご請求';
            $request = 'active';
            $user_main_content = view('user.request',compact('invoice','numberSent','message_rate'));
            return view('master',compact('user_main_content','request','title'));
        }
        else {

            $message_rate = Setting::select('message_rate')->first();
            $numberSent = History::where([['user_id', '=', $user_id]])->where([['dm_sent', '=', '1']])->count();
            $message = 'No bill is found of this month.';
            $title = 'ご請求';
            $request = 'active';
            $user_main_content = view('user.request',compact('numberSent','message_rate','message'));
            return view('master',compact('user_main_content','request','title'));
        }


    }

    public function usercreateInvoice($user_id,$invoice_id){

        if(Auth::user()){

            $customer_info = UserExtraInformation::where('user_id',Crypt::decrypt($user_id))->first();
            $setting_info = Setting::get()->first();
            $invoice_info = Invoice::where('invoice_id',Crypt::decrypt($invoice_id))->first();
            // echo "<pre>";
            // print_r($invoice_info);
            // exit();
            $pdf = PDF::loadView('user.invoice', compact('customer_info','setting_info','invoice_info'));
            return $pdf->stream(date($invoice_info->month).'-'.$invoice_info->year.'.pdf');
        }else{
            return redirect('user-login');
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
