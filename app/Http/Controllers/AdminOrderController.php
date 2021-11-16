<?php

namespace App\Http\Controllers;

use App\order;
use App\transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminOrderController extends Controller
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
            session(['module_active'=>'order']);
            return $next($request);
        });
    }

    public function index()
    {
        $history = transaction::paginate(10);
        return view('admin.order.list',compact('history'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.order.add');
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
        $history = DB::table('orders')
                ->join('products', 'product_id', '=', 'orders.order_product_id')
                ->where([
                    ['orders.order_transactions_id', $id],
                    ['products.product_status', 1]
                ])->paginate(10);
        return view('admin.order.detail',compact('history'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $item = DB::table('orders')
                ->join('products', 'product_id', '=', 'orders.order_product_id')
                ->where([
                    ['orders.order_transactions_id', $id],
                    ['products.product_status', 1]
                ])->first();
        return view('admin.order.edit',compact('item'));
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
        transaction::where('transactions_id',$id)
        ->update(
            ['tr_status' => $request->input('permissions')]
        );
        order::where('order_transactions_id',$id)
        ->update(
            ['order_status' => $request->input('permissions')]
        );
        return redirect()->route('admin.order.list');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        order::where('order_transactions_id',$id)
        ->delete();
        transaction::where('transactions_id',$id)
        ->delete();
        return redirect()->route('admin.order.list');
    }
}
