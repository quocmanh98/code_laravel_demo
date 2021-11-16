@extends('layouts.user')
@section('content')
<div id="main-content-wp" class="cart-page" style="padding-bottom: 300px;">
    <div class="section" id="breadcrumb-wp">
        <div class="wp-inner">
            <div class="section-detail">
                <ul class="list-item clearfix">
                    <li>
                        <a href="" title="">Trang chủ</a>
                    </li>
                    <li>
                        <a href="" title="">Đơn hàng chi tiết</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div id="wrapper" class="wp-inner clearfix">
        <div class="section" id="info-cart-wp">
            <div class="section-detail table-responsive">
                @if ($history->total()>0)
                <table class="table">
                    <thead>
                        <tr>
                            <td>Mã sản phẩm</td>
                            <td>Ảnh sản phẩm</td>
                            <td>Tên sản phẩm</td>
                            <td>Giá sản phẩm</td>
                            <td>Số lượng</td>
                            <td>Thành tiền</td>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($history as $item)
                        <tr>
                            <td scope="row">{{$item->product_code}}</td>
                            <td scope="row"><img style="max-width:20%" class='img-fluid img-thumbnail' src="{{url('/')}}/{{$item->product_image}}" alt=""></td>
                            <td>{{$item->product_name}}</td>
                            <td>{{number_format($item->or_price,'0','','.')}} đ</td>
                            <td>{{$item->or_qty}}</td>
                            <td>{{number_format($item->subtotal,'0','','.')}} đ</td>
                        </tr>
                        @endforeach
                    </tbody>

                </table>
                @else
                <br> <br> <br> <br>
                <div class="alert alert-warning" role="alert" style='font-size:22px'>
                    Không có đơn hàng chi tiết ! Xin vui lòng quay lại <a href="{{url('/')}}">trang chủ</a> !
                  </div>
                @endif
            </div>
        </div>
        <div class="section" id="action-cart-wp">

        </div>
    </div>
</div>
@endsection
