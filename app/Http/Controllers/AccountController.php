<?php

namespace App\Http\Controllers;

use App\category_product;
use App\customer;
use Illuminate\Http\Request;

class AccountController extends Controller

{

    public function index()
    {
        $categoryProduct = category_product::all();
        return view('user.account.index', compact('categoryProduct'));
    }

    public function register()
    {
        $categoryProduct = category_product::all();
        return view('user.account.register', compact('categoryProduct'));
    }

    public function login()
    {
        if(session('customer_fullname')){
            return redirect()->route('home.user');
        }
        $categoryProduct = category_product::all();
        return view('user.account.login', compact('categoryProduct'));
    }

    public function forgot()
    {
        $categoryProduct = category_product::all();
        return view('user.account.forgot',compact('categoryProduct'));
    }

    public function changePassword()
    {
        $categoryProduct = category_product::all();
        return view('user.account.changePassword',compact('categoryProduct'));
    }

    public function info()
    {
        $item = customer::where('customer_id', session('customer_id'))->first();
        $categoryProduct = category_product::all();
        return view('user.account.info',compact('categoryProduct','item'));
    }

    public function edit()
    {
        $item = customer::where('customer_id', session('customer_id'))->first();
        $categoryProduct = category_product::all();
        return view('user.account.edit',compact('categoryProduct','item'));
    }

    public function logout(Request $request)
    {
        // $request->session()->flush();
        // return redirect()->route('home.login')->with('status', 'Bạn đã thoát thành công');
    }
}
