<?php

namespace App\Http\Controllers;
use Illuminate\Contracts\Encryption\EncryptException;
use Illuminate\Http\Request;
use InstagramAPI;
class LoginController extends Controller
{
    public $ig;
    public function __construct()
    {
        $this->ig = new \InstagramAPI\Instagram();
    }

    public function login(){
        $result =  $this->ig->login('webvision100','instagram123456');
        session()->put('userName','webvision100');
        session()->put('password','instagram123456');
        $selfInfo = $this->ig->people->getSelfInfo();
        $selfInfo = json_decode($selfInfo);

        if ($result !=null){
            return view('login');
        }

        return view('profile',compact('selfInfo'));
    }

    public function dm(){
        $counter = 1;
        try{
            while (true){
                $this->ig->login(session()->get('userName'),session()->get('password'));
                $recipents = [
                    'users' => ['8576755585']
                ];

                $text = $counter;
                $result = $this->ig->direct->sendText($recipents,$text);
                $counter++;
                sleep(rand(1,30));
            }
        }catch (EncryptException $ex){

            return $ex;
        }

    }
}
