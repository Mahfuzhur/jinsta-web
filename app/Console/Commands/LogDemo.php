<?php

namespace App\Console\Commands;
use Illuminate\Contracts\Encryption\EncryptException;
use Illuminate\Console\Command;
use DB;
use Session;
use Auth;
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



    }
}
