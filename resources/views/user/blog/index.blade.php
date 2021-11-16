@extends('layouts.user')
@section('content')
<div id="main-content-wp" class="clearfix blog-page">
    <div class="wp-inner">
        <div class="secion" id="breadcrumb-wp">
            <div class="secion-detail">
                <ul class="list-item clearfix">
                    <li>
                        <a href="" title="">Trang chủ</a>
                    </li>
                    <li>
                        <a href="" title="">Bài Viết</a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="main-content fl-right">
            <div class="section" id="list-blog-wp">
                <div class="section-head clearfix">
                    <h3 class="section-title">Bài Viết</h3>
                </div>
                <div class="section-detail">
                    <ul class="list-item">
                        @foreach ( $post as $item)
                        <li class="clearfix">
                            <a href="{{route('blog.detail',$item->post_slug)}}" title="" class="thumb fl-left">
                                <img src="{{url('/')}}/{{$item->post_image}}" alt="">
                            </a>
                            <div class="info fl-right">
                                <a href="{{route('blog.detail',$item->post_slug)}}" title="" class="title">{{$item->post_name}}</a>
                                <b><span class="create-date">{{$item->created_at}}</span></b>
                                <b>
                                    <span>Người tạo:
                                        @foreach ($users as $user )
                                            @php
                                                if($user->id == $item->post_user){
                                                    echo $user->name;
                                                }
                                            @endphp
                                        @endforeach
                                    </span>
                                </b> <br>
                                <b>
                                    <span>Danh Mục:
                                        @foreach ($categoryPost as $cate )
                                            @php
                                                if($cate->category_post_id  == $item->post_category_id ){
                                                    echo $cate->category_post_name;
                                                }
                                            @endphp
                                        @endforeach
                                    </span>
                                </b>
                                <p class="desc">{!!$item->post_desc !!}</p>
                            </div>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
            {{$post->links()}}
        </div>
        <div class="sidebar fl-left">
            <div class="section" id="selling-wp">
                <div class="section-head">
                    <h3 class="section-title">Sản phẩm nổi bật</h3>
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
