<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use InstagramAPI;
class LogDemo extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'log:demo';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'corn';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {

        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->ig = new \InstagramAPI\Instagram();
        try{
            $this->ig->login('webvision100','instagram123456');
            $recipents = [
                'users' => ['8574903852']
            ];

            $imagePath = 'uploads/'.'bylP39uuyy.png';
            //$this->ig->direct->sendText($recipents,$this->user->title);
            $this->ig->direct->sendPhoto($recipents,$imagePath);
        }catch(\Exception $ex){
            echo $ex;
        }

    }
}
