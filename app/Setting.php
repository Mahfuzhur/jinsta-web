<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $table = 'setting';
    protected $fillable = ['trial_period','invoice_grace_time','message_rate'];
    protected $dates = ['deleted_at'];
}
