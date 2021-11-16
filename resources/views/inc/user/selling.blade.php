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
                    <a href="{{route('cart.add',$item->product_id)}}" title="" class="buy-now">Mua ngay</a>
                </div>
            </li>
            @endforeach
        </ul>
    </div>
</div>
