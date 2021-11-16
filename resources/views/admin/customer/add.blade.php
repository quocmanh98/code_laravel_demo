@extends('layouts.admin')
@section('content')
<div id="content" class="container-fluid">
    <div class="card">
        <div class="card-header font-weight-bold">
            Thêm người dùng
        </div>
        <div class="card-body">
            <form action='{{route('admin.customer.store')}}' method='POST'>
                @csrf
                <div class="form-group">
                    <label for="name">Username</label>
                    <input class="form-control" type="text" name="username" id="username" value='{{old('username')}}'>
                    @error('name')
                    <span class="badge badge-danger">{{$message}}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="fullname">Fullname</label>
                    <input class="form-control" type="text" name="fullname" id="fullname" value='{{old('fullname')}}'>
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
                    <label for="phone">Số điện thoại</label>
                    <input class="form-control" type="number" name="phone" id="phone" value='{{old('phone')}}'>
                    @error('phone')
                    <span class="badge badge-danger">{{$message}}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="address">Địa chỉ cụ thể</label>
                    <textarea name="address" id="mytextarea" class="form-control" id="address" cols="30" rows="5">{{old('address')}}</textarea>
                    @error('address')
                    <small class='form-text text-danger'>{{$message}}</small>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="gender">Giới Tính</label>
                    <select class="form-control" id="gender" name='gender'>
                        <option value=''>Chọn</option>
                        <option value='1' @if(old('gender') == 1) selected='selected' @endif>Nam</option>
                        <option value='2'  @if(old('gender') == 2) selected='selected' @endif>Nữ</option>
                    </select>
                    @error('permissions')
                    <span class="badge badge-danger">{{$message}}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="birthday">Birthday</label>
                    <input class="form-control" type="date" name="birthday" id="birthday" value='{{old('birthday')}}'>
                    @error('phone')
                    <span class="badge badge-danger">{{$message}}</span>
                    @enderror
                </div>
                <input type="submit" name="btn_add" value="Thêm" class="btn btn-primary">
            </form>
        </div>
    </div>
</div>
@endsection
