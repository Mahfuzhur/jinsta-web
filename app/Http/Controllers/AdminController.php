<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Session;
use App\Admin;
use App\User;
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
        return redirect('admin-login');
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
            return redirect('/admin-login');
        }
        
    }

    public function allCompanyList(){

        if($this->is_admin_login_check() != null){
            $active_company_list = 'active';
            $all_company = User::where([['account_status','=',3]])->paginate(10);
            $main_content = view('admin.dashboard.all_company_info',compact('all_company'));
            return view('admin.dashboard.master',compact('main_content','active_company_list'));
        }else{
            return redirect('/admin-login');
        }
    }

    public function allEmailList(){

        if($this->is_admin_login_check() != null){
            $active_mail = 'active';
            $all_user_email = User::where([['account_status','=',3]])->paginate(10);
            $main_content = view('admin.dashboard.all_email_list',compact('all_user_email'));
            return view('admin.dashboard.master',compact('main_content','active_mail'));
        }else{
            return redirect('/admin-login');
        }
    }

    public function editCompanyInfo($id){
        $active_company_list = 'active';
        $single_company_info = User::where([['id','=',$id],['account_status','=',3]])->first();
        $main_content = view('admin.dashboard.edit_company_info',compact('single_company_info'));
        return view('admin.dashboard.master',compact('active_company_list','main_content'));
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
