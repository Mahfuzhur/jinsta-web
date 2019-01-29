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
    public $ig;
    public function __construct()
    {
        $this->ig = new \InstagramAPI\Instagram();
    }
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

    public function hashtagSelected($hashtagName){
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
        //return $result;
    }

    public function hashtagSearch(Request $request){
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
