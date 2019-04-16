<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Session;
use App\Admin;
use App\User;
use DB;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendMailable;
use App\Setting;


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
            return redirect('/admin-dashboard');
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
            $all_company = DB::table('users')->whereIn('account_status',[2,3])->get();
            $main_content = view('admin.dashboard.all_company_info',compact('all_company'));
            return view('admin.dashboard.master',compact('main_content','active_company_list'));
        }else{
            return redirect('/');
        }
    }

    public function allEmailList(){

        if($this->is_admin_login_check() != null){
            $active_mail = 'active';
            $all_user_email = User::where([['account_status','=',3]])->paginate(10);
            $main_content = view('admin.dashboard.all_email_list',compact('all_user_email'));
            return view('admin.dashboard.master',compact('main_content','active_mail'));
        }else{
            return redirect('/');
        }
    }

    public function editCompanyInfo($id){
        if($this->is_admin_login_check() != null){
            $active_company_list = 'active';
            $single_company_info = DB::table('users')->where([['id','=',$id]])->whereIn('account_status',[2,3])->first();
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
            
            $all_company = DB::table('users')->whereIn('account_status',[2,3])->get();
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
            $single_setting_info = Setting::where('id',$id)->first();
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
            $main_content = view('admin.dashboard.invoice');
            return view('admin.dashboard.master',compact('main_content','active_invoice'));
        }else{
            return redirect('/');
        }
    }

    public function invoiceDetails()
    {
        if($this->is_admin_login_check() != null){
            $active_invoice = 'active';
            $invoice = DB::table('invoice')->get()->all();
            $main_content = view('admin.dashboard.invoice_details',compact('invoice'));
            return view('admin.dashboard.master',compact('main_content','active_invoice'));
        }else{
            return redirect('/');
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

    public function emailListRequest(Request $request){
        $email = $request->input('email');
      print_r($email);

    }

    public function mail()
    {
        $name = 'Krunal';
        Mail::to('mahfuzhur@gmail.com')->send(new SendMailable());

        return 'Email was sent';
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
