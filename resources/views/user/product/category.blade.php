@extends('layouts.user')
@section('content')

<div id="main-content-wp" class="clearfix category-product-page">
    <div class="wp-inner">
        <div class="secion" id="breadcrumb-wp">
            <div class="secion-detail">
                <ul class="list-item clearfix">
                    <li>
                        <a href="" title="">Trang chủ</a>
                    </li>
                    <li>
                        <a href="" title="">{{ $item->category_name }}</a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="main-content fl-right">
            <div class="section" id="list-product-wp">
                <div class="section-head clearfix">
                    <h3 class="section-title fl-left">{{ $item->category_name }}</h3>
                    <div class="filter-wp fl-right">
                        <p class="desc"><b>Hiển thị  {{$category_by_product->total()}} sản phẩm</b></p>
                        {{-- <div class="form-filter">
                            <form method="POST" action="">
                                <select name="select">
                                    <option value="0">Sắp xếp</option>
                                    <option value="1">Từ A-Z</option>
                                    <option value="2">Từ Z-A</option>
                                    <option value="3">Giá cao xuống thấp</option>
                                    <option value="3">Giá thấp lên cao</option>
                                </select>
                                <button type="submit">Lọc</button>
                            </form>
                        </div> --}}
                    </div>
                </div>
                <div class="section-detail">
                    <ul class="list-item clearfix">
                            @foreach ($category_by_product as $item )
                            <li>
                                <a href="{{route('product.detail',[$item->product_slug])}}" title="" class="thumb">
                                <img src="{{url('/')}}/{{$item->product_image}}">
                                </a>
                                <a href="{{route('product.detail',[$item->product_slug])}}" title="" class="product-name">{{$item->product_name}}</a>
                                <div class="price">
                                    <span class="new">{{number_format($item->product_price_new,'0','','.')}} đ</span>
                                    <span class="old">{{number_format($item->product_price_old,'0','','.')}} đ</span>
                                </div>
                                <div class="action clearfix">
                                    <a href="{{route('cart.add',$item->product_id)}}" title="Thêm giỏ hàng" class="add-cart fl-left">Thêm giỏ hàng</a>
                                    <a href="{{route('checkout')}}" title="Mua ngay" class="buy-now fl-right">Mua ngay</a>
                                </div>
                            </li>
                            @endforeach
                    </ul>
                </div>
            </div>
            {{$category_by_product->links()}}
        </div>
        <div class="sidebar fl-left">
            <div class="section" id="category-product-wp">
                <div class="section-head">
                    <h3 class="section-title">Danh mục sản phẩm</h3>
                </div>
                <div class="secion-detail">
                    <ul class="list-item">
                        <li>
                            @foreach ($categoryProduct as $item )
                                <li>
                                    <a href="{{route('product.category',[$item->category_slug,$item->category_id])}}" title="">{{$item->category_name}}</a>
                                </li>
                            @endforeach

                        </li>
                    </ul>
                </div>
            </div>
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

