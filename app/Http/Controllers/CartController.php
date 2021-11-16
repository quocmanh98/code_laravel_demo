<?php

namespace App\Http\Controllers;

use App\category_post;
use App\category_product;
use App\customer;
use App\order;
use App\product;
use App\transaction;
use Carbon\Carbon;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\checkout;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;


class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Cart::add('293ad', 'Product 1', 1, 9.99);
        // return Cart::content();
        // Cart::destroy();
        $categoryProduct = category_product::all();
        return view('user.cart.index', compact('categoryProduct'));
    }

    public function checkout()
    {
        // return Cart::content();
        $item = customer::where('customer_id', session('customer_id'))->first();
        $categoryProduct = category_product::all();
        if(empty(session('customer_id'))){
            return redirect()->route('home.login')->with('error', 'Bạn vui lòng đăng nhập để tiếp tục thanh toán');
        }else{
            return view('user.checkout.index', compact('categoryProduct','item'));
        }

    }

    public function add(Request $request,$id)
    {
        $product = product::where('product_id',$id)->first();
        Cart::add(
            [
                'id' => $product->product_id,
                'name' => $product->product_name,
                'qty' => 1,
                'price' => $product->product_price_new,
                'options' => ['image' => $product->product_image,'code'=>$product->product_code,'slug'=>$product->product_slug]
            ]
        );
        return redirect()->route('cart');
    }

    public function remove($rowId)
    {
        Cart::remove($rowId);
        return redirect()->route('cart');
    }

    public function saveInfoCart(Request $request)

    {
        if ($request->input('btn_order')) {

        $request->validate(
            [
                'fullname' => "required |min:8 |max:255",
                'email' => 'required |min:8 |max:255',
                'phone' => 'required|min:10',
                'address' => 'required |min:10 |max:255',
                'note' => 'required |min:10 |max:255',
                'payment-method'=> 'required',
            ],
            [
                'required' => ":attribute không được để trống",
                'min' => ":attribute có độ dài ít nhất :min ký tự",
                'max' => ":attribute có độ dài tối đa :max ký tự",
                'integer' => 'Dữ liệu nhập vào phải là số nguyên',
                'date'=> 'Dữ liệu nhập vào phải đúng định dạng date'
            ],
            [
                'fullname' => "Họ tên",
                'email' => 'Gmail',
                'phone' => 'Điện thoại',
                'address' => 'Địa chỉ',
                'note'=> 'Ghi chú',
                'payment-method' => 'Thanh toán'
            ]
        );
        // return Str::random(date('m-d-Y H:i:s',strtotime(Carbon::now())));
        $qty = 0;
        $products = Cart::content();
        foreach ($products as $row) {
            $qty += $row->qty;
        }

        $total = str_replace('.','',Cart::subtotal());
        $tranId = transaction::insertGetId([
            'tr_user_id' => session('customer_id'),
            'tr_code' => Str::random(10),
            'tr_total' =>  $total,
            'tr_fullname' => $request->input('fullname'),
            'tr_email' => $request->input('email'),
            'tr_address' => $request->input('address'),
            'tr_phone' => $request->input('phone'),
            'tr_note' => $request->input('note'),
            'tr_date' => Carbon::now(),
            'tr_total_product' => $qty,
            'tr_status' => 'Chưa xác nhận',
            'tr_payment' => $request->input('payment-method')
        ]);

        if($tranId){
            $products = Cart::content();
            foreach($products as $row){
                order::insert(
                    [
                        'order_transactions_id' => $tranId,
                        'order_product_id' => $row->id,
                        'order_status' => 'Chưa xác nhận',
                        'or_price' => $row->price,
                        'or_qty' => $row->qty,
                        'subtotal' => $row->subtotal
                    ]
                );
            }
        }

        $data = 'Thông tin đơn hàng';
        Mail::to($request->input('email'))->send(new checkout($data));
        Cart::destroy();
        return redirect()->route('user.order.history')->with('status', 'Bạn đã đặt hàng thành công');
    }

    }

    public function OrderHistory()
    {
        if(session('customer_id')){
            $history = transaction::where('tr_user_id',session('customer_id'))->paginate(10);
            $categoryProduct = category_product::all();
            return view('user.checkout.Story',compact('categoryProduct','history'));
        }else{
            return redirect()->route('home.login')->with('error', 'Bạn vui lòng đăng nhập để tiếp tục thanh toán');
        }
    }

    public function DetailHistory($id){

        if(session('customer_id')){
            $categoryProduct = category_product::all();
            $history = DB::table('orders')
                ->join('products', 'product_id', '=', 'orders.order_product_id')
                ->where([
                    ['orders.order_transactions_id', $id],
                    ['products.product_status', 1]
                ])->paginate(10);
            return view('user.checkout.detailStory',compact('categoryProduct','history'));
        }else{
            return redirect()->route('home.login')->with('error', 'Bạn vui lòng đăng nhập để tiếp tục thanh toán');
        }
    }

    public function DeleteHistory($id){
        order::where('order_transactions_id',$id)
        ->delete();
        transaction::where('transactions_id',$id)
        ->delete();
        return redirect()->route('user.order.history');
    }

    public function CancelHistory($id){
        transaction::where('transactions_id',$id)
        ->update(
            ['tr_status' => 'Hủy']
        );
        return redirect()->route('user.order.history');
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
    public function update(Request $request, $id='')
    {
        // return $request->input();
        $data = $request->get('qty');
        foreach ($data as $k => $v) {
            Cart::update($k, $v);
        }
        return redirect()->route('cart');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id='')
    {
        Cart::destroy();
        return redirect()->route('cart');
    }
}
