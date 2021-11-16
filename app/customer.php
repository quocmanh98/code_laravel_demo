<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class customer extends Model
{
    Use SoftDeletes;
    protected $fillable = [
        'customer_username','customer_fullname', 'customer_email', 'customer_password','customer_phone','customer_address','customer_gender','customer_birthday'
    ];
}
