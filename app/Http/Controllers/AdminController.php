<?php

namespace App\Http\Controllers;

use App\category_product;
use App\product;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        // $this->middleware('CheckAge')->only('index','login');
        // $this->middleware('CheckAge')->except('index');
        // $this->middleware('CheckRole');
        $this->middleware (function ($request,$next){
            session(['module_active'=>'dashboard']);
            return $next($request);
        });
    }


    public function index(Request $request)
    {
        // Lấy thông tin user đã đăng nhập
        $users = Auth::user();
        $status = $request->input('status');
        $categorys = category_product::all();
        $users = User::all();

        if($status == 'trash'){
            $action = [
                'restore' => 'Khôi Phục',
                'forceDelete' => 'Xóa Vĩnh Viễn'
            ];
            $products = product::onlyTrashed()->paginate(10);
        }else{
            $action = [
                'delete' => 'Xóa Tạm Thời'
            ];
            if($request->input('keyword')){
                $keyword = $request->input('keyword');
            }else{
                $keyword = '';
            }
            $products = product::where('product_name','LIKE',"%$keyword%")->paginate(10);
        }

        $count_product_active = product::count();
        $count_product_trash = product::onlyTrashed()->count();
        $count = [ $count_product_active,$count_product_trash ];
        // dd( $list_categorys);
        return view('admin.home.dashboard',compact('action','products','count','categorys','users'));
    }

    public function login()
    {
        return view('admin.login');
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
