@extends('layouts.admin')
@section('content')
<div id="content" class="container-fluid">
    <div class="card">
        <div class="card-header font-weight-bold d-flex justify-content-between align-items-center">
            <h5 class="m-0 ">Danh sách đơn hàng chi tiết</h5>
        </div>
        <div class="card-body">
            <table class="table table-striped table-checkall">
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
            {{$history->links()}}
        </div>
    </div>
</div>
@endsection
