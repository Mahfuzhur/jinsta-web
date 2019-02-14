<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Illuminate\Contracts\Encryption\EncryptException;
use DB;
use Session;
use Auth;
use Illuminate\Support\Facades\URL;
use InstagramAPI;
class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        //Commands\LogDemo::class,
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->call(function () {
            try{
                $this->ig = new \InstagramAPI\Instagram();
                $user = DB::table('users')
                    ->join('user_schedule', 'users.id', '=','user_schedule.user_id' )
                    ->join('schedule', 'schedule.id', '=', 'user_schedule.schedule_id')
                    ->join('hashtag_schedule', 'hashtag_schedule.schedule_id', '=', 'schedule.id')
                    ->join('template_schedule', 'template_schedule.schedule_id', '=', 'schedule.id')
                    ->join('template', 'template.id', '=', 'template_schedule.template_id')
                    ->join('hashtag', 'hashtag.id', '=', 'hashtag_schedule.hashtag_id')
                    ->join('client', 'client.hashtag_id', '=', 'hashtag.id')
                    ->select('users.name','users.instagram_username','users.instagram_password','schedule.delivery_period_start','schedule.delivery_period_end'
                        ,'schedule.date_exclusion_setting_start','schedule.date_exclusion_setting_end'
                        ,'schedule.specify_time_start','schedule.specify_time_end', 'schedule.time_exclusion_setting_start'
                        , 'schedule.time_exclusion_setting_end','hashtag.hashtag','client.user_id','client.client_id',
                        'client.hashtag_id','template.title','template.description','template.image')
                    ->where([['client.dm_sent','!=','1']])
                    ->groupBy('hashtag.hashtag')
                    ->first();
                $result = $this->ig->login($user->instagram_username,$user->instagram_password);
                $recipents = [
                    'users' => [$user->client_id]
                ];
                $image = $user->image;
                $imagePath = 'uploads/template/'.$image;
                //$path = 'E:/wbits/jinsta-web/public/uploads/template'.$user->image;
                //$this->ig->direct->sendText($recipents,$user->title);
                $this->ig->direct->sendPhoto($recipents,$imagePath);
                //$this->ig->direct->sendText($recipents,$user->description);

            }catch (\Exception $ex){
                echo $ex;
            }
        })->everyMinute();
        $schedule->command('log:demo')->everyMinute();
//        $schedule->call(function () {
//            \Log::info('i was here');
//       })->everyMinute();
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
