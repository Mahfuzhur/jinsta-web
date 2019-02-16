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
            $this->user = DB::table('users')
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
                    'client.hashtag_id','client.id','template.title','template.description','template.image')
                ->where([['client.dm_sent','!=','1']])
                ->groupBy('hashtag.hashtag')
                ->first();
        }catch (\Exception $ex){
            echo "something went wrong";
        }

        $schedule->call(function () {
            try{

                $this->ig = new \InstagramAPI\Instagram();

                $result = $this->ig->login($this->user->instagram_username,$this->user->instagram_password);
                $recipents = [
                    'users' => [$this->user->client_id]
                ];
                $imagePath = 'uploads/'.'bylP39uuyy.png';
                $this->ig->direct->sendText($recipents,$this->user->title);

                $this->ig->direct->sendPhoto($recipents,public_path('uploads/'.'bylP39uuyy.png'));
                $this->ig->direct->sendText($recipents,$this->user->description);

            }catch (\Exception $ex){
                echo "something went wrong";
            }
            finally{
                $client = Client::find($this->user->id);
                $client->dm_sent = 1;
                $client->save();
            }
        })->between($this->user->delivery_period_start,$this->user->delivery_period_end)
            ->unlessBetween($this->user->date_exclusion_setting_start,$this->user->date_exclusion_setting_end)
            ->between($this->user->specify_time_start,$this->user->specify_time_end)
            ->unlessBetween($this->user->time_exclusion_setting_start,$this->user->time_exclusion_setting_end)
            ->everyMinute();

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
