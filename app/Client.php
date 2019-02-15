<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use InstagramAPI;
class Client extends Model
{

    protected $table = 'client';
    protected $fillable = ['user_id','hashtag_id','client_id'];
    public function imageSend($imagePath,$id){
       $ig = new \InstagramAPI\Instagram();
        $recipents = [
            'users' => [$id]
        ];
       $ig->direct->sendPhoto($recipents,$imagePath);
    }
}
