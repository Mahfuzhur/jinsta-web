<?php

namespace App\Http\Controllers;

use App\History;
use App\Invoice;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Crypt;
use Session;
use App\Admin;
use App\User;
use DB;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendMailable;
use App\Setting;
use Illuminate\Support\Facades\Input;
use Auth;



class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function is_admin_login_check(){

        $admin_id = Session::get('current_admin_id');
        return $admin_id;
    }

    public function adminLogin()
    {
        $main_content = view('admin.login_form.admin_login');
        return view('admin.login_form.admin_master',compact('main_content'));
    }

    public function adminLogout(){

        Session::put('current_admin_id','');
        Session::put('current_admin_name','');
        return redirect('/');
    }

    public function adminLoginCheck(Request $request){

        $email = $request->email;
        $password = md5($request->password);

        $info = Admin::where([['email','=',$email],['password','=',$password]])->first();

        if(isset($info)){
            Session::put('current_admin_id',$info->id);
            Session::put('current_admin_name',$info->name);
            return redirect('/all-company-list');
        }else{
            return redirect('/admin-login')->with('login_err','Email or Password invalid');
        }

    }

    public function adminDashboard(){

        if($this->is_admin_login_check() != null){        
            // $title = 'Dashboard';
            $admin_name = Session::get('current_admin_name');
            $main_content = view('admin.dashboard.dashboard');
            return view('admin.dashboard.master',compact('main_content','admin_name'));
        }else{
            return redirect('/');
        }
        
    }

    public function allCompanyList(){

        if($this->is_admin_login_check() != null){
            $active_company_list = 'active';
            $all_company = User::whereIn('account_status',[2,3])->get();
            $main_content = view('admin.dashboard.all_company_info',compact('all_company'));
            return view('admin.dashboard.master',compact('main_content','active_company_list'));
        }else{
            return redirect('/');
        }
    }

    public function allEmailList(){

        if($this->is_admin_login_check() != null){
            $active_mail = 'active';
            $all_user_email = User::select('company_name','name', 'email')->where([['account_status','=',3]])->get();
            $total = count($all_user_email);
           // $users = User::select('company_name','name', 'email')->get();
            $main_content = view('admin.dashboard.all_email_list',compact('all_user_email','total'));
            return view('admin.dashboard.master',compact('main_content','active_mail'));
        }else{
            return redirect('/');
        }
    }

    public function editCompanyInfo($id){
        if($this->is_admin_login_check() != null){
            $active_company_list = 'active';
            $single_company_info = DB::table('users')->where([['id','=',Crypt::decrypt($id)]])->whereIn('account_status',[2,3])->first();
            $main_content = view('admin.dashboard.edit_company_info',compact('single_company_info'));
            return view('admin.dashboard.master',compact('active_company_list','main_content'));
        }else{
            return redirect('/');
        }
    }

    public function updateCompanyInfo(request $request,$id){

        if($this->is_admin_login_check() != null){
            $this->validate($request,[
                'company_name' => 'required',
                'name' => 'required',
                'email' => 'required|unique:users,email,'.$id,
                'mobile' => 'required'
            ]);

            $info = User::findOrFail($id);
            $info->company_name = $request->company_name;
            $info->name = $request->name;
            $info->email = $request->email;
            $info->mobile = $request->mobile;
            $info->save();
            return redirect('/all-company-list')->with('update_info_msg','Information successfully updated');
        }else{
            return redirect('/');
        }

    }

    public function deleteCompanyInfo($id){

        if ($this->is_admin_login_check() != null) {
            User::destroy($id);
            return redirect('/all-company-list')->with('delete_msg','Company information deleted successfully');
        }else{
            return redirect('/');
        }
    }

    public function suspendCompanyInfo(Request $request){
        if($this->is_admin_login_check() != null){
            $id = $request->id;
            // return response()->json(['data'=>$id]);
            $c_info = User::findOrFail($id);
            if($c_info->account_status == 2){
                User::where('id',$id)->update(array('account_status' => 3));
            }elseif ($c_info->account_status == 3) {
                User::where('id',$id)->update(array('account_status' => 2));
            }
            
            $all_company = User::whereIn('account_status',[2,3])->get();
            // return redirect('/all-company-list')->with('suspend_msg','Company suspend successfully.');
            return view('admin.dashboard.ajax_suspend_list',compact('all_company'));
        }else{
            return redirect('/');
        }
        
    }

    public function allTrialCompanyList(){
        if($this->is_admin_login_check() != null){
            $active_trial = 'active';
            $trial_period = Setting::select('trial_period')->first();
            $all_company_trial_list = User::where([['account_status','=',1]])->get();
            $main_content = view('admin.dashboard.all_company_trial_list',compact('all_company_trial_list','trial_period'));
            return view('admin.dashboard.master',compact('main_content','active_trial'));
        }else{
            return redirect('/');
        }
    }

    public function settings()
    {
        if($this->is_admin_login_check() != null){
            $active_setting = 'active';
            $single_setting_info = Setting::orderBy('id','desc')->first();
            $main_content = view('admin.dashboard.settings',compact('single_setting_info'));
            return view('admin.dashboard.master',compact('main_content','active_setting'));
        }else{
            return redirect('/');
        }
    }

    public function addSetting(Request $request){
        if($this->is_admin_login_check() != null){
            $info = new Setting();
            $info->trial_period = $request->trial_period;
            $info->invoice_grace_time = $request->invoice_grace_time;
            $info->message_rate = $request->message_rate;
            $info->demo1 = $request->demo1;
            $info->demo2 = $request->demo2;
            $info->save();
            return redirect('settings')->with('add_msg','Setting added successfully.');
        }else{
            return redirect('/');
        }
    }

    public function editSetting($id){
        if($this->is_admin_login_check() != null){
            $active_setting = 'active';
            $single_setting_info = Setting::where('id',Crypt::decrypt($id))->first();
            $main_content = view('admin.dashboard.edit_setting',compact('single_setting_info'));
            return view('admin.dashboard.master',compact('main_content','active_setting'));
        }else{
            return redirect('/');
        }
    }

    public function updateSetting(Request $request,$id){
        if($this->is_admin_login_check() != null){
            $info = Setting::findOrFail($id);
            $info->trial_period = $request->trial_period;
            $info->invoice_grace_time = $request->invoice_grace_time;
            $info->message_rate = $request->message_rate;
            $info->demo1 = $request->demo1;
            $info->demo2 = $request->demo2;
            $info->save();
            return redirect('settings')->with('update_msg','Setting updateed successfully.');
        }else{
            return redirect('/');
        }

    }

    public function invoice()
    {
        if($this->is_admin_login_check() != null){
            $active_invoice = 'active';
            $all_company = User::where([['account_status','=',3]])->get()->all();
            // $all_company = User::selectRaw('users.company_name,users.email, count(invoice.invoice_id) as invoice_no')
            //      ->leftJoin('invoice', 'users.id', '=', 'invoice.user_id')
            //      ->where([['users.account_status','=',3]])
            //      ->groupBy('users.id')
            //      ->get();
            $main_content = view('admin.dashboard.invoice',compact('all_company'));
            return view('admin.dashboard.master',compact('main_content','active_invoice'));
        }else{
            return redirect('/');
        }
    }

    public function invoiceDetails($id)
    {
        if($this->is_admin_login_check() != null){
            $active_invoice = 'active';
            $user_id = Crypt::decrypt($id);
            $user_info = User::where('id',Crypt::decrypt($id))->first();
            $invoice = DB::table('invoice')->where('user_id',Crypt::decrypt($id))->get()->all();
            $main_content = view('admin.dashboard.invoice_details',compact('invoice','user_info','user_id'));
            return view('admin.dashboard.master',compact('main_content','active_invoice'));
        }else{
            return redirect('/');
        }
    }

    public function composeMailTrialCompany(Request $request){

        if($this->is_admin_login_check() != null){

            $active_trial = 'active';
            $emails = $request->input('email');
            // echo "<pre>";
            // print_r($emails);
            // exit();
            $main_content = view('admin.dashboard.trial_company_mail',compact('emails'));
            return view('admin.dashboard.master',compact('main_content','active_trial'));

        }else{
            return redirect('/');
        }
    }

    public function sendMailTrialCompany(Request $request){

        if($this->is_admin_login_check() != null){

            $email = $request->input('email');
            $subject = $request->input('subject');
            $body = $request->input('body');
            if (Input::hasFile('file')) {
                $file = Input::file('file');
                $filepath = rand(1,10).$file->getClientOriginalName();
                $file->move('uploads/',$filepath);
            }

            Mail::to($email)->send(new SendMailable($subject,$body,$filepath));

        }else{
            return redirect('/');
        }
    }

    public function paymentReceive($id)
    {
        if($this->is_admin_login_check() != null){
            $active_invoice = 'active';

            $invoice = DB::table('invoice')->where('invoice_id',Crypt::decrypt($id))->update(['billing_status' => 1]);
            return back()->with('payment_msg','Payment successfull');
        }else{
            return redirect('/');
        }
    }

    public function CreateBill(Request $request){

        $year =Carbon::now()->year;
        $month = $request->month;
        $user_id = $request->user_id;
//        echo $year;
//
//        exit();

        $result = History::whereYear('created_at', '=', $year)
            ->whereMonth('created_at', '=', $month)
            ->where('user_id' , '=',$user_id )
            ->where('billing_status' , '!=','1' )
            ->count();
        $setting = Setting::select('invoice_grace_time')->get();
        $day = $setting[0]->invoice_grace_time;
//        echo  $setting[0]->invoice_grace_time;
//        exit();
        $invoice = new Invoice();
        $invoice-> user_id = $user_id;
        $invoice-> issue_date = Carbon::now();
        $invoice-> due_date = Carbon::now()->addDays($day);
        $invoice-> billing_status = 0;
        $invoice-> dm_total_number = $result;
        $return_result = $invoice->save();

        if ($return_result == 1){
            $result = History::whereYear('created_at', '=', $year)
                ->whereMonth('created_at', '=', $month)
                ->where('user_id' , '=',$user_id )
                ->update(['billing_status'=>'1']);
        }


        return back()->with('invoice','invoice Created');
    }

    public function monthlyBill(){
        $last_month = Carbon::now()->month -1;
        $year = Carbon::now()->year;
        $setting = Setting::select('invoice_grace_time')->get();
        $day = $setting[0]->invoice_grace_time;
        \Log::info('From controller');
//        $result = History::whereYear('created_at', '=', $year)
//            ->whereMonth('created_at', '=', $last_month)
//            ->where('billing_status' , '!=','1' )
//            ->groupBy()
//            ->count();
        $results = History::where('billing_status','!=', '1')
            ->whereYear('created_at', '=', $year)
            ->whereMonth('created_at', '=', $last_month)
            ->select('user_id',DB::raw('count(id) as `data`'), DB::raw("DATE_FORMAT(created_at, '%m-%Y') new_date"),  DB::raw('YEAR(created_at) year, MONTH(created_at) month'))
            ->groupby('year','month','user_id')
            ->get();

        if ($results != null){
            foreach ($results as $result){
                $invoice = new Invoice();
                $invoice-> user_id = $result->user_id;
                $invoice-> issue_date = Carbon::now()->addHour(9);
                $invoice-> due_date = Carbon::now()->addDays($day);
                $invoice-> billing_status = 0;
                $invoice-> dm_total_number = $result->data;
                $return_result = $invoice->save();


                if ($return_result == 1){
                    $result = History::whereYear('created_at', '=', $year)
                        ->whereMonth('created_at', '=', $last_month)
                        ->where('user_id' , '=',$result->user_id )
                        ->update(['billing_status'=>'1']);
                }
            }
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
    public function emailList(){
        $users = User::select('company_name','name', 'email')->get();

        return view('admin.email',compact('users'));
    }

    public function emailCompose(Request $request){
        $emails = $request->input('email');
        if(empty($emails)){
            return back()->with('mail_err_msg','You have to select atleast 1 email');
        }
        $main_content = view('admin.dashboard.compose',compact('emails'));
        return view('admin.dashboard.master',compact('main_content'));
       // return view('email.compose',compact('emails'));

    }

    public function mail()
    {
        $name = 'Krunal';
        Mail::to('mahfuzhur@gmail.com')->send(new SendMailable());

        return 'Email was sent';
    }

    public function emailSent(Request $request){
        $emails = $request->input('email');
        $subject = $request->input('subject');
        $body = $request->input('body');

        if (Input::hasFile('file')) {
            $file = Input::file('file');
            $file_path_name = rand(1, 10000000) . $file->getClientOriginalName();
           // $image = str_replace(' ', '+', $file_path_name);
           // $imageName = str_random(10).'.'.'png';
            // return $imageName;
            // exit();
            $file->move('uploads/', $file_path_name);
        }

       //  $data = array(
       //      'subject' => $subject,
       //      'body' => $body
       // );
        
       //  Mail::send('email.name', $data, function($message) use ($data,$file_path_name,$emails)
       //  {
       //      $message->to($emails);
       //      $message->subject($data['subject']);
       //      $message->from('info@backslashkey.com');
       //      $message->attach(asset('uploads/'.$file_path_name));
       //  });
        
       //  return redirect('all-email')->with('mail_success','Mail sent successfully');

        $result = Mail::to($emails)->send(new SendMailable($subject,$body,$file_path_name));
        echo $result;
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
