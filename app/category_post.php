<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class category_post extends Model
{
    Use SoftDeletes;
    protected $fillable = [
        'category_post_id','category_post_name', 'category_post_slug', 'category_post_status'
    ];
}
