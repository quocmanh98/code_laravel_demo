<div class="section" id="category-product-wp">
    <div class="section-head">
        <h3 class="section-title">Danh mục sản phẩm</h3>
    </div>
    <div class="secion-detail">
        <ul class="list-item">
            <li>
                @foreach ($categoryProduct as $item )
                    <li>
                        <a href="{{route('product.category', $item->category_slug)}}" title="">{{$item->category_name}}</a>
                    </li>
                @endforeach

            </li>
        </ul>
    </div>
</div>
