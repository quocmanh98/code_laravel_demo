<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class product extends Model
{
    Use SoftDeletes;
    protected $fillable = [
        'product_name', 'product_slug', 'product_code','product_category_id','product_desc','product_content','product_price_old','product_price_new','product_display','product_count','product_view','product_image','product_user','product_status'
    ];
}
