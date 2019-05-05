<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    protected $table = 'invoice';
    protected $fillable = ['invoice_id','user_id','issue_date','due_date','billing_status','dm_total_number'];
    protected $dates= ['created_at','updated_at'];
}
