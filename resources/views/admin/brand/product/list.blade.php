@extends('layouts.admin')
@section('content')
<div id="content" class="container-fluid">
    <form action='{{route('admin.brand.product.action')}}' method='post'>
        @csrf
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header font-weight-bold">
                    Danh sách thương hiệu sản phẩm
                </div>
                <div class="card-body">
                    <div class="analytic">
                        <a href="{{request()->fullUrlWithQuery(['status' => 'active'])}}" class="text-primary">Kích hoạt<span class="text-muted"></span></a>
                        <a href="{{request()->fullUrlWithQuery(['status' => 'trash'])}}" class="text-primary">Vô hiệu hóa<span class="text-muted"></span></a>
                    </div>
                    <div class="form-action form-inline py-3">
                        <select class="form-control mr-1" id="" name='permission'>
                            <option>Chọn</option>
                            <option value=""></option>
                        </select>
                        <input type="submit" name="btn_permission" value="Áp dụng" class="btn btn-primary">
                    </div>
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>
                                    <input type="checkbox" name="checkall">
                                </th>
                                <th scope="col">#</th>
                                <th scope="col">Name</th>
                                <th scope="col">Slug</th>
                                <th scope="col">Status</th>
                                <th scope="col">Quản lý</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <input type="checkbox" name="list_check[]" value="">
                                </td>
                                <th scope="row"></th>
                                <td></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    </form>
</div>
@endsection
