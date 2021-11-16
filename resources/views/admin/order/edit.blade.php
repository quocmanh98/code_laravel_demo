@extends('layouts.admin')
@section('content')
<div id="content" class="container-fluid">
    <div class="card">
        <div class="card-header font-weight-bold">
            Sửa thông tin hóa đơn
        </div>
        <div class="card-body">
            <form action='{{route('admin.order.update',$item->order_transactions_id)}}' method='POST'>
                @csrf
                <div class="form-group">
                    <label for="permissions">Trạng thái</label>
                    <select class="form-control" id="permissions" name='permissions'>
                        <option value='Chưa xác nhận'  selected>Chưa xác nhận</option>
                        <option value='Thành công'  >Thành công</option>
                        <option value='Hủy' >Hủy</option>
                    </select>
                </div>
                <input type="submit" name="btn_edit" value="Sửa" class="btn btn-primary">
            </form>
        </div>
    </div>
</div>
@endsection
