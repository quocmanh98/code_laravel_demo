@extends('layouts.user')
@section('content')
<div id="main-content-wp" class="cart-page" style="padding-bottom: 500px;">
    <div class="section" id="breadcrumb-wp">
        <div class="wp-inner">
            <div class="section-detail">
                <ul class="list-item clearfix">
                    <li>
                        <a href="?page=home" title="">Trang chủ</a>
                    </li>
                    <li>
                        <a href="" title="">Lịch sử đơn hàng</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div id="wrapper" class="wp-inner clearfix">
        <div class="section" id="info-cart-wp">
            @if (session('status'))
            <div class="alert alert-success" role="alert">
               {{session('status')}}
            </div>
            @endif
            <div class="section-detail table-responsive">
                @if ($history->total()>0)

                  <table class="table">
                    <thead>
                        <tr>
                            <td>STT</td>
                            <td>Mã đơn hàng</td>
                            <td>Họ Tên</td>
                            <td>Thời gian đặt</td>
                            <td>Tổng sản phẩm</td>
                            <td>Tổng giá tiền</td>
                            <td>Trạng thái</td>
                            <td>Hoàn tác</td>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $t = 0;
                        @endphp
                        @foreach ($history as $item)
                        <tr>
                            <td>{{$t++}}</td>
                            <td>#{{$item->tr_code}}</td>
                            <td>{{$item->tr_fullname}}</td>
                            <td>{{$item->tr_date}}</td>
                            <td>{{$item->tr_total_product}}</td>
                            <td>{{number_format($item->tr_total,'0','','.')}} đ</td>
                            <td>{{$item->tr_status}}</td>
                            <td>
                                <a href="{{route('user.cancel.history',$item->transactions_id)}}" class='btn btn-primary'>Hủy đơn hàng</a> <br> <br>
                                <a href="{{route('user.delete.history',$item->transactions_id)}}" class='btn btn-primary'>Xóa đơn hàng</a> <br> <br>
                                <a href="{{route('user.detail.history',$item->transactions_id)}}" class='btn btn-primary'>Chi tiết đơn hàng</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                @else
                <br> <br> <br> <br>
                <div class="alert alert-warning" role="alert" style='font-size:22px'>
                    Không có đơn hàng ! Xin vui lòng quay lại <a href="{{url('/')}}">trang chủ</a> !
                  </div>
                @endif

            </div>
        </div>

    </div>
</div>
@endsection
