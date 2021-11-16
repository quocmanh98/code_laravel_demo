@php
use App\category_product;
use App\product;
$listcatid = category_product::where(['category_id' => $catid,'category_status'=>1])->get();
$array_catid = array();
foreach ($listcatid  as $cat) {
    $array_catid[] = $cat->category_id;
}
$list_product_by_catgory_id = product::where('product_status',1)->whereIn('product_category_id',$array_catid)->limit(8)->get();
@endphp

<div class="section-detail">
    <ul class="list-item clearfix">
        @foreach ($list_product_by_catgory_id as  $item)
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

