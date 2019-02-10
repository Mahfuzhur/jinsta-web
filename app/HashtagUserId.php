<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HashtagUserId extends Model
{
    protected $table = 'hashtag_user_id';
    protected $fillable = ['hashtag_id','user_id'];
}
