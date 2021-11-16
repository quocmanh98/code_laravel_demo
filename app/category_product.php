<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class category_product extends Model
{
    Use SoftDeletes;
    protected $fillable = [
        'category_id','category_name', 'category_slug', 'category_status'
    ];
}
