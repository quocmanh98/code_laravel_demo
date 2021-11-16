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
                        <a href="" title="">Đổi mật khẩu</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div id="wrapper" class="wp-inner clearfix">
        <div class='container'>
            <div class='row'>
                <div class='col-12'>
                    <h1 class='text-center' style="font-size: 19px">Đổi mật khẩu</h1>
                    {!! Form::open(['url'=>'user/store','method'=>'POST']) !!}
                    <div class='form-group'>
                        {!! Form::label('email', 'Email:') !!}
                        {!! Form::email('email','', ['placeholder' => 'Nhập email','class'=> 'form-control']) !!}
                    </div>
                    <div class='form-group'>
                        {!! Form::label('password', 'Password:') !!}
                        {!! Form::password('password', ['placeholder' => 'Nhập password','class'=> 'form-control']) !!}
                    </div>
                    <div class='form-group'>
                        {!! Form::submit("Đổi mật khẩu", ['name'=>'sm-change','class'=>'btn btn-success']) !!}
                    </div>
                </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
