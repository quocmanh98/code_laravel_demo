@extends('layouts.user')
@section('content')

<div id="main-content-wp" class="checkout-page">
    <div class="section" id="breadcrumb-wp">
        <div class="wp-inner">
            <div class="section-detail">
                <ul class="list-item clearfix">
                    <li>
                        <a href="{{url('/')}}" title="">Trang chủ</a>
                    </li>
                    <li>
                        <a href="" title="">Thanh toán</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <form method="POST" action="{{route('saveInfoCart')}}" name="form-checkout">
        @csrf
    <div id="wrapper" class="wp-inner clearfix">
        <div class="section" id="customer-info-wp">
            <div class="section-head">
                <h1 class="section-title">Thông tin khách hàng</h1>
            </div>
            <div class="section-detail">
                    <div class="form-row clearfix">
                        <div class="form-col fl-left">
                            <label for="fullname">Họ tên</label>
                            <input type="text" name="fullname" id="fullname" value='{{$item->customer_fullname}}'>
                            @error('fullname')
                            <small class='form-text text-danger'>{{$message}}</small>
                            @enderror
                        </div>
                        <div class="form-col fl-right">
                            <label for="email">Email</label>
                            <input type="email" name="email" id="email" value='{{$item->customer_email}}'>
                            @error('email')
                            <small class='form-text text-danger'>{{$message}}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-col">
                            <label for="phone">Số điện thoại</label>
                            <input type="tel" name="phone" id="phone" value='{{$item->customer_phone}}'>
                            @error('phone')
                            <small class='form-text text-danger'>{{$message}}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-col">
                            <b> <label for="address">Địa chỉ đặt hàng cụ thể:</label> </b>
                            <textarea name="address" class="form-control">{{$item->customer_address}}</textarea>
                            @error('address')
                            <small class='form-text text-danger'>{{$message}}</small>
                            @enderror
                        </div>
                        <div class="form-col">
                            <label for="notes">Ghi chú</label>
                            <textarea name="note" class="form-control"></textarea>
                            @error('note')
                            <small class='form-text text-danger'>{{$message}}</small>
                            @enderror
                        </div>
                    </div>
            </div>
        </div>
        <div class="section" id="order-review-wp">
            <div class="section-head">
                <h1 class="section-title">Thông tin đơn hàng</h1>
            </div>
            <div class="section-detail">
                <table class="shop-table">
                    <thead>
                        <tr>
                            <td>Sản phẩm</td>
                            <td>Tổng</td>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach (Cart::content() as $row )
                        <tr class="cart-item">
                            <td class="product-name">{{$row->name}}<strong class="product-quantity">x {{$row->qty}}</strong></td>
                            <td class="product-total">{{number_format($row->price,'0','','.')}} đ</td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr class="order-total">
                            <td>Tổng đơn hàng:</td>
                            <td><strong class="total-price">{{Cart::total()}} đ</strong></td>
                        </tr>
                    </tfoot>
                </table>
                <div id="payment-checkout-wp">
                    <ul id="payment_methods">
                        <li>
                            <input type="radio" id="direct-payment" name="payment-method" value="direct-payment">
                            <label for="direct-payment">Thanh toán tại cửa hàng</label>
                        </li>
                        <li>
                            <input type="radio" id="payment-home" name="payment-method" value="payment-home">
                            <label for="payment-home">Thanh toán tại nhà</label>
                        </li>
                        @error('payment-method')
                        <small class='form-text text-danger'>{{$message}}</small>
                        @enderror
                    </ul>
                </div>
                @if ( Cart::total() >0 )
                <div class="place-order-wp clearfix">
                    <input type="submit" id="order-now" value="Đặt hàng" name='btn_order'>
                </div>
                @else
                <div class="place-order-wp clearfix">
                    <input type="submit" id="order-now" value="Đặt hàng" disabled>
                </div> <br>
                <div class="alert alert-danger" role="alert">
                    Qúy khách vui lòng mua sản phẩm khi thanh toán !
                </div>
                @endif
            </div>
            <a href="{{route('user.order.history')}}" class="btn btn-success">Lịch sử đơn hàng</a>
        </div>
    </div>
</form>
</div>

@endsection
