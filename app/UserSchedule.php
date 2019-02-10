<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserSchedule extends Model
{
    protected $table = 'user_schedule';
    protected $fillable = ['user_id','schedule_id'];
}
