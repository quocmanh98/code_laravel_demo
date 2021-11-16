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
                        <a href="" title="">Thông tin cá nhân</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div id="wrapper" class="wp-inner clearfix">
        <div class='container'>
            <div class='row'>
                <div class='col-12'>
                    <h1 class='text-center' style="font-size: 19px">Thông tin cá nhân</h1>
                    <form action="" method='post'>
                        @csrf
                        <div class='form-group'>
                            {!! Form::label('username', 'Username') !!}
                            <input class="form-control" type="text" name="customer_username" id="username" value='{{$item->customer_username}}' disabled>
                        </div>
                        <div class='form-group'>
                            {!! Form::label('fullname', 'Họ Tên') !!}
                            <input class="form-control" type="text" name="fullname" id="fullname" value='{{$item->customer_fullname}}' disabled>
                        </div>
                        <div class='form-group'>
                            {!! Form::label('email', 'Email:') !!}
                            <input class="form-control" type="email" name="customer_email" id="customer_email" value='{{$item->customer_email}}' disabled>
                        </div>
                        <div class='form-group'>
                            {!! Form::label('phone', 'Phone:') !!}
                            <input class="form-control" type="number" name="phone" id="phone" value='{{$item->customer_phone}}' disabled>
                        </div>
                        <div class='form-group'>
                            {!! Form::label('birthday', 'Ngày sinh:') !!}
                            <input class="form-control" type="date" name="birthday" id="birthday" value='{{$item->customer_birthday}}' disabled>
                        </div>
                        <div class='form-group'>
                            {!! Form::label('gender', 'Giới Tính:') !!}
                            <select class="form-control" id="gender" name='gender' disabled>
                                <option value=''>Chọn</option>
                                <option value='male' @if($item->customer_gender == 'male') selected='selected' @endif>Nam</option>
                                <option value='female'  @if($item->customer_gender == 'female') selected='selected' @endif>Nữ</option>
                            </select>
                        </div>
                        <div class='form-group'>
                            {!! Form::label('address', 'Địa chỉ') !!}
                            <textarea name="address" id="address" cols="30" rows="10" class='form-control' disabled>{{$item->customer_address}}</textarea>
                        </div>
                        {!! Form::close() !!}
                </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
