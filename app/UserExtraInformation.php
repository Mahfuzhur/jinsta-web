<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserExtraInformation extends Model
{
	protected $table = 'user_extra_info';
    protected $fillable = ['name','company_name', 'contact_number','street','postal_code'];
}
