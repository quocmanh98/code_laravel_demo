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
                        <a href="" title="">Login</a>
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
                    <h1 class='text-center' style="font-size: 19px">Đăng nhập</h1>
                    <form action="{{route('home.handle.login')}}" method='post'>
                        @csrf
                    <div class='form-group'>
                        {!! Form::label('email', 'Email:') !!}
                        <input class="form-control" type="email" name="customer_email" id="customer_email" value='{{old('customer_email')}}'>
                        @error('customer_email')
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
                    <div class='form-group'>
                        {!! Form::submit("Đăng nhập", ['name'=>'btn_login','class'=>'btn btn-success']) !!}
                    </div>
                </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
