<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\category_product;
use App\category_post;
use App\post;
use App\product;
use App\User;

class BlogController extends Controller
{

    public function index()
    {
        $product = product::orderBy('product_view', 'desc')->limit(4)->get();
        $post = post::paginate(12);
        $users = User::all();
        $categoryPost = category_post::all();
        $categoryProduct = category_product::all();
        if(!empty($product) && !empty($post)){
            return view('user.blog.index',compact('product','categoryProduct','post','users','categoryPost'));
        }else{
            return redirect()->route('home.user');
        }

    }

    public function detail($slug)
    {
        $product = product::orderBy('product_view', 'desc')->limit(8)->get();
        $item = post::where(['post_slug'=>$slug])->first();
        $categoryProduct = category_product::all();
        if(!empty($item)){
            return view('user.blog.detail',compact('item','categoryProduct','product'));
        }else{
            return redirect()->route('home.user');
        }
    }
}
