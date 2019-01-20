<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Encryption\EncryptException;
use Illuminate\Http\Request;
use Session;
use InstagramAPI;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function userRegistration(){
        $content = view('login_registration.form.user_registration_form');
        return view('login_registration.master',compact('content'));
    }

    public function registrationSuccess(){
        $content = view('login_registration.form.registration_success_form');
        return view('login_registration.master',compact('content'));
    }

    public function dashboard(){
        // $user_name = Session::get('current_user_name');
        // $user_profile_image = Session::get('current_user_image');
        $title = 'Index page';
        $user_main_content = view('user.dashboard');
        return view('master',compact('user_main_content','title'));
    }

    public function manuscriptRegistration(){
        $title = '新規作成';
        $active_manuscript = 'active';
        $user_main_content = view('user.manuscript_registration');
        return view('master',compact('user_main_content','active_manuscript','title'));
    }

    public function createManuscript(){
        $title = 'テンプレート名：テストテストテスト';
        $active_manuscript = 'active';
        $user_main_content = view('user.create_manuscript');
        return view('master',compact('user_main_content','active_manuscript','title'));
    }

    public function destinationRegistration(){
        $title = '宛先登録';
        $active_destination = 'active';
        $user_main_content = view('user.destination_registration');
        return view('master',compact('user_main_content','active_destination','title'));
    }

    public function createDestination(){
        $title = '宛先登録';
        $active_destination = 'active';
        $user_main_content = view('user.create_destination');
        return view('master',compact('user_main_content','active_destination','title'));
    }

    public function deliverySetting(){
        $title = '配信設定';
        $delivery_setting = 'active';
        $user_main_content = view('user.delivery_setting');
        return view('master',compact('user_main_content','delivery_setting','title'));
    }

    public function template(){
        $user_main_content = view('user.template');
        return view('master',compact('user_main_content'));
    }

    public function analytics(){
        $title = 'アナリティクス';
        $analytics = 'active';
        $user_main_content = view('user.analytics');
        return view('master',compact('user_main_content','analytics','title'));
    }

    public function request(){
        $title = 'ご請求';
        $request = 'active';
        $user_main_content = view('user.request');
        return view('master',compact('user_main_content','request','title'));
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
