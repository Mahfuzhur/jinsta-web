<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Hashtag extends Model
{
	use SoftDeletes;
    protected $table = 'hashtag';
    protected $fillable = ['user_id','hashtag'];
    protected $dates = ['deleted_at'];
}
