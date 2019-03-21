<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Schedule extends Model
{
	use SoftDeletes;
    protected $table = 'schedule';
    protected $fillable = ['destination','draft','delivery_period_start','delivery_period_end','date_exclusion_setting_start',
        'date_exclusion_setting_end','specify_time_start','specify_time_end','time_exclusion_setting_start','time_exclusion_setting_end'];
    protected $dates = ['deleted_at'];
}
