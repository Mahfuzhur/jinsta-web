<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Template extends Model
{
    use SoftDeletes;
    protected $table = 'template';
    protected $fillable = ['user_id','title', 'description','image'];
    protected $dates = ['deleted_at'];
 }
