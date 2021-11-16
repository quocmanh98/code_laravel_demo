@extends('layouts.user')
@section('content')
{{-- {{$id}} -- {{$price}} --}}
{{-- @if ($data % 2 == 0)
    {{$data}} là số chẵn
@endif --}}
{{-- @include('admin.login',['title' => 'Comment']) --}}
<div id="main-content-wp" class="home-page clearfix">
    <div class="wp-inner">
        <div class="main-content fl-right">
            @include('inc.user.slider')
            @include('inc.user.support')
            <div class="section" id="feature-product-wp">
                <div class="section-head">
                    <h3 class="section-title">Sản phẩm</h3>
                </div>
                <div class="section-detail">
                    <ul class="list-item">
                        @foreach ( $product_all as $item )
                        <li>
                            <a href="{{route('product.detail',$item->product_slug)}}" title="" class="thumb">
                                <img src="{{url('/')}}/{{$item->product_image}}">
                            </a>
                            <a href="{{route('product.detail',$item->product_slug)}}" title="" class="product-name">{{$item->product_name}}</a>
                            <div class="price">
                                <span class="new">{{number_format($item->product_price_new,'0','','.')}} đ</span>
                                <span class="old">{{number_format($item->product_price_old,'0','','.')}} đ</span>
                            </div>
                            <div class="action clearfix">
                                <a href="{{route('cart.add',$item->product_id)}}" title="" class="add-cart fl-left">Thêm giỏ hàng</a>
                                <a href="{{route('checkout')}}" title="" class="buy-now fl-right">Mua ngay</a>
                            </div>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
            @foreach ($categoryProduct as $item )
            <div class="section" id="list-product-wp">
                <div class="section-head">
                    <h3 class="section-title">{{$item->category_name}}</h3>
                </div>
                @includeIf('user.category.product',['catid' => $item->category_id])
            </div>
            @endforeach
        </div>
        <div class="sidebar fl-left">
            @include('inc.user.category_product')
            @include('inc.user.selling')
            <div class="section" id="banner-wp">
                <div class="section-detail">
                    <a href="" title="" class="thumb">
                        <img src="{{url('/')}}/public/user/images/banner.png" alt="">
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

