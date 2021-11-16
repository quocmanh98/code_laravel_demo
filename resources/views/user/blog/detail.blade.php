@extends('layouts.user')
@section('content')
<div id="main-content-wp" class="clearfix detail-blog-page">
    <div class="wp-inner">
        <div class="secion" id="breadcrumb-wp">
            <div class="secion-detail">
                <ul class="list-item clearfix">
                    <li>
                        <a href="" title="">Trang chủ</a>
                    </li>
                    <li>
                        <a href="" title="">Bài viết chi tiết</a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="main-content fl-right">
            <div class="section" id="detail-blog-wp">
                <div class="section-head clearfix">
                    <h3 class="section-title">{{$item->post_name}}</h3>
                </div>
                <div class="section-detail">
                    <span class="create-date">{{$item->created_at}}</span>
                    <div class="detail">
                        <p>{!!$item->post_content!!}</p>
                    </div>
                </div>
            </div>
            <div class="section" id="social-wp">
                <div class="section-detail">
                    <div class="fb-like" data-href="" data-layout="button_count" data-action="like" data-size="small" data-show-faces="true" data-share="true"></div>
                    <div class="g-plusone-wp">
                        <div class="g-plusone" data-size="medium"></div>
                    </div>
                    <div class="fb-comments" id="fb-comment" data-href="" data-numposts="5"></div>
                </div>
            </div>
        </div>
        <div class="sidebar fl-left">
            <div class="section" id="selling-wp">
                <div class="section-head">
                    <h3 class="section-title">Sản phẩm bán chạy</h3>
                </div>
                <div class="section-detail">
                    <ul class="list-item">
                        @foreach ($product as $item)
                        <li class="clearfix">
                            <a href="{{route('product.detail',$item->product_slug)}}" title="" class="thumb fl-left">
                                <img src="{{url('/')}}/{{$item->product_image}}" alt="">
                            </a>
                            <div class="info fl-right">
                                <a href="{{route('product.detail',$item->product_slug)}}" title="" class="product-name">{{$item->product_name}}</a>
                                <div class="price">
                                    <span class="new">{{number_format($item->product_price_new,'0','','.')}} đ</span> <br>
                                            <span class="old">{{number_format($item->product_price_old,'0','','.')}} đ</span>
                                </div>
                                <a href="" title="" class="buy-now">Mua ngay</a>
                            </div>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <div class="section" id="banner-wp">
                <div class="section-detail">
                    <a href="{{route('blog')}}" title="" class="thumb">
                        <img src="{{url('/')}}/public/user/images/banner.png" alt="">
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
