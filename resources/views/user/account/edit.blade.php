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
                        <a href="" title="">Sửa thông tin</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div id="wrapper" class="wp-inner clearfix">
        <div class='container'>
            @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{session('status')}}
            </div>
            @endif
            @if (session('error'))
            <div class="alert alert-danger" role="alert">
                {{session('error')}}
            </div>
            @endif
            <div class='row'>
                <div class='col-12'>
                    <h1 class='text-center' style="font-size: 19px">Sửa thông tin</h1>
                <form action="{{route('home.handle.edit')}}" method='post'>
                    @csrf
                    <div class='form-group'>
                        {!! Form::label('username', 'Username') !!}
                        <input class="form-control" type="text" name="customer_username" id="username" value='{{$item->customer_username}}'>
                        @error('customer_username')
                        <small class='form-text text-danger'>{{$message}}</small>
                        @enderror
                    </div>
                    <div class='form-group'>
                        {!! Form::label('fullname', 'Họ Tên') !!}
                        <input class="form-control" type="text" name="fullname" id="fullname" value='{{$item->customer_fullname}}'>
                        @error('fullname')
                        <small class='form-text text-danger'>{{$message}}</small>
                        @enderror
                    </div>
                    <div class='form-group'>
                        {!! Form::label('password', 'Mật khẩu') !!}
                        <input class="form-control" type="password" name="password" id="password">
                        @error('password')
                        <small class='form-text text-danger'>{{$message}}</small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="password_confirmation">Xác nhận Mật khẩu</label>
                        <input class="form-control" type="password" name="password_confirmation" id="password_confirmation">
                    </div>
                    <div class='form-group'>
                        {!! Form::label('email', 'Email:') !!}
                        <input class="form-control" type="email" name="customer_email" id="customer_email" value='{{$item->customer_email}}' disabled>
                        @error('customer_email')
                        <small class='form-text text-danger'>{{$message}}</small>
                        @enderror
                    </div>
                    <div class='form-group'>
                        {!! Form::label('phone', 'Phone:') !!}
                        <input class="form-control" type="number" name="phone" id="phone" value='{{$item->customer_phone}}'>
                        @error('phone')
                        <small class='form-text text-danger'>{{$message}}</small>
                        @enderror
                    </div>
                    <div class='form-group'>
                        {!! Form::label('birthday', 'Ngày sinh:') !!}
                        <input class="form-control" type="date" name="birthday" id="birthday" value='{{$item->customer_birthday}}'>
                        @error('birthday')
                        <small class='form-text text-danger'>{{$message}}</small>
                        @enderror
                    </div>
                    <div class='form-group'>
                        {!! Form::label('gender', 'Giới Tính:') !!}
                        <select class="form-control" id="gender" name='gender'>
                            <option value=''>Chọn</option>
                            <option value='male' @if($item->customer_gender == 'male') selected='selected' @endif>Nam</option>
                            <option value='female'  @if($item->customer_gender == 'female') selected='selected' @endif>Nữ</option>
                        </select>
                        @error('gender')
                        <small class='form-text text-danger'>{{$message}}</small>
                        @enderror
                    </div>
                    <div class='form-group'>
                        {!! Form::label('address', 'Địa chỉ') !!}
                        <textarea name="address" id="address" cols="30" rows="10" class='form-control'>{{$item->customer_address}}</textarea>
                        @error('address')
                        <small class='form-text text-danger'>{{$message}}</small>
                        @enderror
                    </div>
                    <div class='form-group'>
                        {!! Form::submit("Submit", ['name'=>'btn_edit','class'=>'btn btn-success']) !!}
                    </div>
                    {!! Form::close() !!}
                </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
