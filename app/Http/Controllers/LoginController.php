<?php

namespace App\Http\Controllers;
use Illuminate\Contracts\Encryption\EncryptException;
use Illuminate\Http\Request;
use Session;
use InstagramAPI;
class LoginController extends Controller
{
    public $ig;
    public function __construct()
    {
        $this->ig = new \InstagramAPI\Instagram();
    }

    public function index(){
        return view('login_with_instagram');
    }

    public function userLogin(){
        return view('user_login_form');
    }

    public function login(Request $request){
        // $userName = $request->header('userName');
        // $password = $request->header('password');
        $userName = $request->username;
        $password = $request->password;
        session()->put('userName',$userName);
        session()->put('password',$password);
        $result = $this->ig->login($userName,$password);
        $selfInfo = $this->ig->people->getSelfInfo();
       // $rank_token= \InstagramAPI\Signatures::generateUUID();

        $userFeed = $this->ig->timeline->getSelfUserFeed();

        // $json_self_info = json_encode($selfInfo, JSON_PRETTY_PRINT);
        // $json_userfeed = json_encode($userFeed, JSON_PRETTY_PRINT);

        $json_selfinfo = json_decode($selfInfo,true);

        // echo "<pre>";
        // print_r($json_selfinfo['user']['username']);
        // exit();

        // echo "<pre>";
        // print_r($json_selfinfo);
        // exit();


        if ($selfInfo != null){

            Session::put('current_user_name',$json_selfinfo['user']['username']);
            Session::put('current_user_image',$json_selfinfo['user']['profile_pic_url']);
            return redirect('user-dashboard');

            // return response()->json(
            //     ['self_info'=> $selfInfo,'user_feed' => $userFeed]
            // );
        }
        else{
            return response()->json(
                ['data'=> $request]
            );
        }
    }

    // public function login(){
    //     $result =  $this->ig->login('webvision100','instagram123456');
    //     session()->put('userName','webvision100');
    //     session()->put('password','instagram123456');
    //     $selfInfo = $this->ig->people->getSelfInfo();
    //     $selfInfo = json_decode($selfInfo);

    //     if ($result !=null){
    //         return view('login');
    //     }

    //     return view('profile',compact('selfInfo'));
    // }

    public function dm(){
        $counter = 1;
        $message = $_GET['text'];
        try{
//            while (true){
                $this->ig->login(session()->get('userName'),session()->get('password'));
                $recipents = [
                    'users' => ['8574903852']
                ];

                $text = $counter;
                $result = $this->ig->direct->sendText($recipents,$message);
                $counter++;
//                sleep(rand(1,30));
//            }
            return 2;
        }catch (EncryptException $ex){

            return $ex;
        }

    }
}
