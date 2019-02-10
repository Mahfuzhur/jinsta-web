<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HashtagSchedule extends Model
{
    protected $table = 'hashtag_schedule';
    protected $fillable = ['hashtag_id','schedule_id'];
}
