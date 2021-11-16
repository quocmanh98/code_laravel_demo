@extends('layouts.user')
@section('content')
<div id="main-content-wp" class="cart-page">
    <div class="section" id="breadcrumb-wp">
        <div class="wp-inner">
            <div class="section-detail">
                <ul class="list-item clearfix">
                    <li>
                        <a href="{{url('/')}}" title="">Trang chủ</a>
                    </li>
                    <li>
                        <a href="" title="">Giỏ Hàng</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div id="wrapper" class="wp-inner clearfix">
        <div class="section" id="info-cart-wp">
            <form action="{{route('cart.update')}}" method='post'>
                @csrf
                <div class="section-detail table-responsive">
                    @if (Cart::total() >0)
                    <table class="table">
                        <thead>
                            <tr>
                                <td>STT</td>
                                <td>Mã sản phẩm</td>
                                <td>Ảnh sản phẩm</td>
                                <td>Tên sản phẩm</td>
                                <td>Giá sản phẩm</td>
                                <td>Số lượng</td>
                                <td colspan="2">Thành tiền</td>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $t = 0;
                            @endphp
                            @foreach (Cart::content() as $row)
                            <tr>
                                <td>{{$t++}}</td>
                                <td>{{$row->options->code}}</td>
                                <td>
                                    <a href="{{route('product.detail',[$row->options->slug])}}" title="" class="thumb">
                                        <img src="{{url('/')}}/{{$row->options->image}}" alt="">
                                    </a>
                                </td>
                                <td>
                                    <a href="{{route('product.detail',[$row->options->slug])}}" title="" class="name-product">{{$row->name}}</a>
                                </td>
                                <td>{{number_format($row->price,'0','','.')}} đ</td>
                                <td>
                                    <input type="number"  min='0' max='10' name="qty[{{$row->rowId}}]" value="{{$row->qty}}" class="num-order">
                                </td>
                                <td>{{number_format($row->total,'0','','.')}} đ</td>
                                <td>
                                    <a href="{{route('cart.remove',$row->rowId)}}" title="" class="del-product"><i class="fa fa-trash-o"></i></a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="7">
                                    <div class="clearfix">
                                        <p id="total-price" class="fl-right">Tổng giá: <span>{{Cart::total()}} đ</span></p>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="7">
                                    <div class="clearfix">
                                        <div class="fl-right">
                                            <input type="submit" value="Cập nhật giỏ hàng" name='btn_update' class='btn btn-primary'>
                                            <a href="{{route('checkout')}}" class='btn btn-primary'>Thanh toán</a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        </tfoot>
                    </table>
                    @else
                    <div class="alert alert-warning" role="alert">
                        Không có sản phẩm nào trong giỏ hàng !
                    </div>
                    @endif
                </div>
            </form>
        </div>
        <div class="section" id="action-cart-wp">
            <div class="section-detail">
                <p class="title">Click vào <span>“Cập nhật giỏ hàng”</span> để cập nhật số lượng. Nhập vào số lượng <span>0</span> để xóa sản phẩm khỏi giỏ hàng. Nhấn vào thanh toán để hoàn tất mua hàng.</p>
                <a href="{{url('/')}}" title="" id="buy-more">Mua tiếp</a><br/>
                <a href="{{route('cart.destroy')}}" title="" id="delete-cart">Xóa giỏ hàng</a>
            </div>
        </div>
    </div>
</div>
@endsection
