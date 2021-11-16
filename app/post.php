<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class post extends Model
{
    Use SoftDeletes;
    protected $fillable = [
        'post_name', 'post_slug','post_category_id','post_desc','post_content','post_view','post_image','post_user','post_status'
    ];
}
