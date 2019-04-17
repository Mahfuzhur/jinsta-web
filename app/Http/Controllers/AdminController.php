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
            $all_user_email = User::select('company_name','name', 'email')->where([['account_status','=',3]])->get();
           // $users = User::select('company_name','name', 'email')->get();
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
        $active_trial = 'active';
        $all_company_trial_list = User::where([['account_status','=',1]])->get();
        $main_content = view('admin.dashboard.all_company_trial_list',compact('all_company_trial_list'));
        return view('admin.dashboard.master',compact('main_content','active_trial'));
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
        $main_content = view('email.compose',compact('emails'));
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

        //Mail::to($emails)->send(new SendMailable());
      //  $data = array('name'=>"Virat Gandhi");
//        Mail::send('mail', $data, function($message) {
//            $message->to('abc@gmail.com', 'Tutorials Point')->subject
//            ('Laravel Testing Mail with Attachment');
//            $message->attach('C:\laravel-master\laravel\public\uploads\image.png');
//            $message->attach('C:\laravel-master\laravel\public\uploads\test.txt');
//            $message->from('xyz@gmail.com','Virat Gandhi');
//        });
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
