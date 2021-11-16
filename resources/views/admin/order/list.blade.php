@extends('layouts.admin')
@section('content')
<div id="content" class="container-fluid">
    <div class="card">
        <div class="card-header font-weight-bold d-flex justify-content-between align-items-center">
            <h5 class="m-0 ">Danh sách đơn hàng</h5>
        </div>
        <div class="card-body">
            <table class="table table-striped table-checkall">
                <thead>
                    <tr>
                        <td>STT</td>
                        <td>Mã đơn hàng</td>
                        <td>Họ Tên</td>
                        <td>Điện thoại</td>
                        <td>Địa chỉ đặt hàng</td>
                        <td>Thời gian đặt</td>
                        <td>Tổng sản phẩm</td>
                        <td>Tổng giá tiền</td>
                        <td>Trạng thái</td>
                        <td>Hoàn tác</td>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $to = 0;
                    @endphp
                    @foreach ( $history as $t )
                    @php
                        $to++
                    @endphp
                    <tr>
                        <td>{{$to}}</td>
                        <td>#{{$t->tr_code}}</td>
                        <td>
                            {{$t->tr_fullname}} <br>
                        </td>
                        <td>
                            {{$t->tr_phone}} <br>
                        </td>
                        <td>
                            {{$t->tr_address}} <br>
                        </td>
                        <td>
                            {{$t->tr_date}} <br>
                        </td>
                        <td>
                            {{$t->tr_total_product}} <br>
                        </td>
                        <td>
                            {{$t->tr_total}} <br>
                        </td>
                        <td>
                            {{$t->tr_status}} <br>
                        </td>
                        <td>
                            <a href="{{route('admin.order.detail',$t->transactions_id)}}">Chi tiết</a>
                            <a href="{{route('admin.order.edit',$t->transactions_id)}}" class="btn btn-success btn-sm rounded-0 text-white" type="button" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-edit"></i></a>
                            <a href="{{route('admin.order.destroy',$t->transactions_id)}}" class="btn btn-danger btn-sm rounded-0 text-white" type="button" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fa fa-trash"></i></a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            {{$history->links()}}
        </div>
    </div>
</div>
@endsection
