<?php

namespace App\Http\Controllers;

use App\category_product;
use App\product;
use App\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index(Request $request)
    {
        $categoryProduct = category_product::all();
        $product = product::orderBy('product_view', 'desc')->limit(8)->get();
        $product_all = product::where(['product_status'=>1])->get();
        $user = User::all();
        return view('user.home.index',compact('categoryProduct','product','product_all','user'));
    }

    public function demo($id='')
    {
        // return $id;
        $price = 20000;
        $data = 2;
        // return view('user.home.index',array('id' => $id,'price' => $price));
        // return redirect('blog/detail');
        return view('user.home.index',compact('id','price','data'));
    }

    public function about()
    {
        $categoryProduct = category_product::all();
        return view('user.home.about',compact('categoryProduct'));
    }

    public function contact()
    {
        $categoryProduct = category_product::all();
        return view('user.home.contact',compact('categoryProduct'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
