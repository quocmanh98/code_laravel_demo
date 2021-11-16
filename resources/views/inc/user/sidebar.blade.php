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
    <div class="section" id="filter-product-wp">
        <div class="section-head">
            <h3 class="section-title">Bộ lọc</h3>
        </div>
        <div class="section-detail">
            <form method="GET" action="">
                <table>
                    <thead>
                        <tr>
                            <td colspan="2">Giá</td>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><input type="radio" name="price" value='1'></td>
                            <td>Dưới 500.000đ</td>
                        </tr>
                        <tr>
                            <td><input type="radio" name="price" value='2'></td>
                            <td>500.000đ - 1.000.000đ</td>
                        </tr>
                        <tr>
                            <td><input type="radio" name="price" value='3'> </td>
                            <td>1.000.000đ - 5.000.000đ</td>
                        </tr>
                        <tr>
                            <td><input type="radio" name="price" value='4'></td>
                            <td>5.000.000đ - 10.000.000đ</td>
                        </tr>
                        <tr>
                            <td><input type="radio" name="price" value='5'></td>
                            <td>Trên 10.000.000đ</td>
                        </tr>

                    </tbody>

                </table>
                <input type="submit" value='Lọc'>
            </form>
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
