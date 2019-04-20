<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Session;
use App\Admin;
use App\User;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendMailable;
use Illuminate\Support\Facades\Input;


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
            $all_company = User::where([['account_status','=',3]])->paginate(10);
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
            $single_company_info = User::where([['id','=',$id],['account_status','=',3]])->first();
            $main_content = view('admin.dashboard.edit_company_info',compact('single_company_info'));
            return view('admin.dashboard.master',compact('active_company_list','main_content'));
        }else{
            return redirect('/');
        }
    }

    public function updateCompanyInfo(request $request,$id){

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
        $main_content = view('admin.dashboard.compose',compact('emails'));
        return view('admin.dashboard.master',compact('main_content'));
       // return view('email.compose',compact('emails'));

    }

    public function mail()
    {
        $name = 'Krunal';
        Mail::to('mahfuzhur@gmail.com')->send(new SendMailable('2','2'));

        return 'Email was sent';
    }

    public function emailSent(Request $request){
        $emails = $request->input('email');
        $subject = $request->input('subject');
        $body = $request->input('body');
        $body = $request->input('file');
        if (Input::hasFile('file')) {
            $file = Input::file('file');
            $file_path_name = rand(1, 10000000) . $file->getClientOriginalName();
           // $image = str_replace(' ', '+', $file_path_name);
           // $imageName = str_random(10).'.'.'png';
            // return $imageName;
            // exit();
            $file->move('uploads/', $file_path_name);
        }

        Mail::to($emails)->send(new SendMailable($subject,$body,$file_path_name));
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
