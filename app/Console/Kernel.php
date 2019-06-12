<?php

namespace App\Console;

use App\Http\Controllers\LoginController;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Session;
use Auth;
use DB;
use InstagramAPI;
use GuzzleHttp\Exception\ServerException;
use App\Client;
use App\History;
use Log;
use Carbon;


class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [

    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {

        try{

            $current_date = date("d-m-Y");
            $current_time = date("H:i");
            $this->users = DB::table('users')
                ->join('user_schedule', 'users.id', '=','user_schedule.user_id' )
                ->join('schedule', 'schedule.id', '=', 'user_schedule.schedule_id')
                ->join('hashtag_schedule', 'hashtag_schedule.schedule_id', '=', 'schedule.id')
                ->join('template_schedule', 'template_schedule.schedule_id', '=', 'schedule.id')
                ->join('template', 'template.id', '=', 'template_schedule.template_id')
                ->join('hashtag', 'hashtag.id', '=', 'hashtag_schedule.hashtag_id')
                ->join('client', 'client.hashtag_id', '=', 'hashtag.id')
                ->leftJoin('history', 'client.id', '=', 'history.client_id_fk')
                ->leftJoin('history as h1', 'hashtag.id', '=', 'h1.hashtag_name')
                ->leftJoin('history as h2', 'template.id', '=', 'h1.template_name')
                ->leftJoin('history as h3', 'users.id', '=', 'h1.user_id')
                ->select('users.name','users.instagram_username','users.instagram_password','schedule.delivery_period_start','schedule.delivery_period_end'
                    ,'schedule.date_exclusion_setting_start','schedule.date_exclusion_setting_end'
                    ,'schedule.specify_time_start','schedule.specify_time_end', 'schedule.time_exclusion_setting_start'
                    , 'schedule.time_exclusion_setting_end','hashtag.hashtag','client.user_id','client.client_id',
                    'client.hashtag_id','client.id','template.title','template.id as template_id','template.description','template.image')
                ->where([['history.client_id_fk','=',null],['schedule.status','=','1'],['schedule.delivery_period_start','<=',$current_date],
                    ['schedule.delivery_period_end','>=',$current_date]])
                ->whereNull('schedule.deleted_at')
                ->groupBy('template.title')
                ->groupBy('hashtag.hashtag')
                ->get();



        }catch (\Exception $ex){
            echo $ex;
        }

        if ($this->users != null){
            $this->counter = 0;

            foreach($this->users as $this->user){

            //exit();
                $schedule->call(function () {

//                    print_r($this->users[$this->counter]);
//                    exit();
                    try{
                        echo '**' .$this->counter. '*';
//                        exit();

                        $this->ig = new \InstagramAPI\Instagram();
                        echo $this->users[$this->counter]->client_id;

                        $result = $this->ig->login($this->users[$this->counter]->instagram_username,$this->users[$this->counter]->instagram_password);
                        $recipents = [
                            'users' => [$this->users[$this->counter]->client_id]
                        ];
                        $time_in_12_hour_format  = date("g:i a", strtotime($this->users[$this->counter]->specify_time_start));
                        $time_in_12_hour_format_ex_start  = date("g:i a", strtotime($this->users[$this->counter]->time_exclusion_setting_start));
                        $time_in_12_hour_format_end  = date("g:i a", strtotime($this->users[$this->counter]->specify_time_end));
                        $time_in_12_hour_format_ex_end  = date("g:i a", strtotime($this->users[$this->counter]->time_exclusion_setting_end));
                        $this->history_result = History::where(['user_id' => $this->users[$this->counter]->user_id,'hashtag_name' => $this->users[$this->counter]->hashtag,'client_id'=>$this->users[$this->counter]->client_id,'template_name'=>$this->users[$this->counter]->title ])->get();
//                        print_r($this->history_result);
//                        exit();

//
                        if($this->users[$this->counter]->specify_time_start <= $this->users[$this->counter]->specify_time_end ){
                            if($this->users[$this->counter]->specify_time_start <= date('H:i') && $this->users[$this->counter]->specify_time_end >= date('H:i')){
                                $imagePath = 'uploads/'.$this->users[$this->counter]->image;
                                $this->ig->direct->sendText($recipents,$this->users[$this->counter]->description);
                                $this->ig->direct->sendPhoto($recipents,base_path($imagePath));
                                \Log::info('message sent');

                            }
                        }
                        elseif($this->users[$this->counter]->specify_time_start >= $this->users[$this->counter]->specify_time_end){
                            if($this->users[$this->counter]->specify_time_start <= date('H:i') || $this->users[$this->counter]->specify_time_end >= date('H:i')){
                                $imagePath = 'uploads/'.$this->users[$this->counter]->image;
                                $this->ig->direct->sendText($recipents,$this->users[$this->counter]->description);
                                $this->ig->direct->sendPhoto($recipents,base_path($imagePath));
                                \Log::info('message sent');

                            }
                        }

                    }catch (\Exception $ex){
                        echo "something went wrong";
                    }
                    finally{

                        if($this->users[$this->counter]->specify_time_start <= $this->users[$this->counter]->specify_time_end ){
                            if($this->users[$this->counter]->specify_time_start <= date('H:i') && $this->users[$this->counter]->specify_time_end >= date('H:i')){
//                                $client = Client::find($this->users[$this->counter]->id);
//                                $client->dm_sent = 1;
//                                $client->save();
                                    $history = new History();
                                    $history->user_id = $this->users[$this->counter]->user_id;
                                    $history->hashtag_name = $this->users[$this->counter]->hashtag_id;
                                    $history->client_id = $this->users[$this->counter]->client_id;
                                    $history->template_name = $this->users[$this->counter]->template_id;
                                    $history->client_id_fk = $this->users[$this->counter]->id;
                                    $history->created_at = Carbon\Carbon::now()->addHour(6);
                                $history->save();
                                \Log::info('update ok');
                            }
                        }
                        elseif($this->users[$this->counter]->specify_time_start >= $this->users[$this->counter]->specify_time_end ){
                            if($this->users[$this->counter]->specify_time_start <= date('H:i') || $this->users[$this->counter]->specify_time_end >= date('H:i')){
//                                $client = Client::find($this->users[$this->counter]->id);
//                                $client->dm_sent = 1;
//                                $client->save();
                                $history = new History();
                                $history->user_id = $this->users[$this->counter]->user_id;
                                $history->hashtag_name = $this->users[$this->counter]->hashtag_id;
                                $history->client_id = $this->users[$this->counter]->client_id;
                                $history->template_name = $this->users[$this->counter]->template_id;
                                $history->client_id_fk = $this->users[$this->counter]->id;
                                $history->created_at = Carbon\Carbon::now()->addHour(6);
                                $history->save();
                                \Log::info('update ok');
                            }
                        }

                    }
                    $this->counter++;
                })
                    ->everyMinute();
                echo $this->user->delivery_period_start;
            }
        }else{
            \Log::info('i was here');
        }


//        $schedule->call(function () {
//            \Log::info('i was here');
//       })->everyMinute();
        if (Carbon\Carbon::now()->day == 1){
            $schedule->call('App\Http\Controllers\AdminController@monthlyBill')->between('01:00','24:00');
        }

    }

    /**
     * Register the Closure based commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        require base_path('routes/console.php');
    }
}
