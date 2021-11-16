@extends('layouts.admin')
@section('content')
<div id="content" class="container-fluid">
    <div class="card">
        <div class="card-header font-weight-bold">
            Thêm người dùng
        </div>
        <div class="card-body">
            <form action='{{route('admin.user.store')}}' method='POST'>
                @csrf
                <div class="form-group">
                    <label for="name">Họ và tên</label>
                    <input class="form-control" type="text" name="name" id="name" value='{{old('name')}}'>
                    @error('name')
                    <span class="badge badge-danger">{{$message}}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input class="form-control" type="text" name="email" id="email" value='{{old('email')}}'>
                    @error('email')
                    <span class="badge badge-danger">{{$message}}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="password">Mật khẩu</label>
                    <input class="form-control" type="password" name="password" id="password" value='{{old('password')}}'>
                    @error('password')
                    <span class="badge badge-danger">{{$message}}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="password_confirmation">Xác nhận Mật khẩu</label>
                    <input class="form-control" type="password" name="password_confirmation" id="password_confirmation">
                </div>
                <div class="form-group">
                    <label for="permissions">Nhóm quyền</label>
                    <select class="form-control" id="permissions" name='permissions'>
                        <option value=''>Chọn</option>
                        <option value='1' @if(old('permissions') == 1) selected='selected' @endif>Admin</option>
                        <option value='2'  @if(old('permissions') == 2) selected='selected' @endif>User</option>
                    </select>
                    @error('permissions')
                    <span class="badge badge-danger">{{$message}}</span>
                    @enderror
                </div>
                <input type="submit" name="btn_add" value="Thêm" class="btn btn-primary">
            </form>
        </div>
    </div>
</div>
@endsection
