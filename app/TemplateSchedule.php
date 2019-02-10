<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TemplateSchedule extends Model
{
    protected $table = 'template_schedule';
    protected $fillable = ['template_id','schedule_id'];
}
