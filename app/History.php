<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class History extends Model
{
    protected $table = 'history';
    protected $fillable = ['user_id','hashtag_name','client_id','template_name','billing_status','client_id_fk'];
    protected $dates= ['created_at','updated_at'];
}
