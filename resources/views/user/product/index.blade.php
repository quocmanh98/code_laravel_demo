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
                        <a href="" title="">Sản phẩm</a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="main-content fl-right">
            <div class="section" id="list-product-wp">
                <div class="section-head clearfix">
                    <h3 class="section-title fl-left">Sản phẩm</h3>
                    <div class="filter-wp fl-right">
                        {{-- <p class="desc">Hiển thị {{$product->total()}}  sản phẩm</p> --}}
                        <div class="form-filter">
                            <form method="GET" action="" name='filter'>
                                <select name="select">
                                    <option value="0">Sắp xếp</option>
                                    <option value="1">Mới nhất</option>
                                    <option value="2">Cũ nhất</option>
                                    <option value="3">Giá cao xuống thấp</option>
                                    <option value="4">Giá thấp lên cao</option>
                                </select>
                                <button type="submit">Lọc</button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="section-detail">
                    <ul class="list-item clearfix">
                       @if ($product->total() >0)
                       @foreach ($product as $item )
                       <li>
                           <a href="{{route('product.detail',$item->product_slug)}}" title="" class="thumb">
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
                       @else
                       <div class="alert alert-warning" role="alert">
                        Không có sản phẩm nào !
                      </div>
                       @endif
                </ul>
                </div>
            </div>
            {{$product->links()}}
        </div>
        @include('inc.user.sidebar')
    </div>
</div>

@endsection

