@extends('layouts.admin')
@section('content')
<div id="content" class="container-fluid">
    <div class="card">
        <div class="card-header font-weight-bold">
            Sửa sản phẩm
        </div>
        <div class="card-body">
            <form action='{{route('admin.product.update',$product->product_id)}}' method='post' enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-12">
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input class="form-control" type="text" name="name" id="name" value="{{$product->product_name}}">
                            @error('name')
                            <small class='form-text text-danger'>{{$message}}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-group">
                            <label for="slug">Slug</label>
                            <input class="form-control" type="text" name="slug" id="slug" value="{{$product->product_slug}}">
                            @error('slug')
                            <small class='form-text text-danger'>{{$message}}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-group">
                            <label for="code">Code</label>
                            <input class="form-control" type="text" name="code" id="code" value="{{$product->product_code}}">
                            @error('code')
                            <small class='form-text text-danger'>{{$message}}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-group">
                            <label>Danh mục sản phẩm</label>
                            <select class="form-control" id="category" name='category'>
                                <option value=''>Chọn danh mục</option>
                                @foreach ($category as $item)
                                <option value='{{$item->category_id}}' <?php if( $product->product_category_id == $item->category_id ){ echo "selected=selected" ; }  ?>>{{$item->category_name}}</option>
                                @endforeach
                            </select>
                            @error('category')
                            <small class='form-text text-danger'>{{$message}}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-group">
                            <label for="desc">Mô tả sản phẩm</label>
                            <textarea name="desc" id="mytextarea" class="form-control" id="desc" cols="30" rows="5">{{$product->product_desc}}</textarea>
                            @error('desc')
                            <small class='form-text text-danger'>{{$message}}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-group">
                            <label for="content">Chi tiết sản phẩm</label>
                            <textarea name="content" id="mytextarea" class="form-control" id="content" cols="30" rows="5">{{$product->product_content}}</textarea>
                            @error('content')
                            <small class='form-text text-danger'>{{$message}}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-group">
                            <label for="PriceOld">Gía cũ</label>
                            <input class="form-control" type="number" name="PriceOld" id="name" value="{{$product->product_price_old}}">
                            @error('PriceOld')
                            <small class='form-text text-danger'>{{$message}}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-group">
                            <label for="PriceNew">Gía mới</label>
                            <input class="form-control" type="number" name="PriceNew" id="PriceNew" value="{{$product->product_price_new}}">
                            @error('PriceNew')
                            <small class='form-text text-danger'>{{$message}}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-group">
                            <label for="display">Tình trạng</label>
                            <select class="form-control" id="display" name='display'>
                                <option value=''> Chọn </option>
                                <option value='còn hàng' <?php if( $product->product_display == 'còn hàng' ){ echo "selected=selected" ;} ?>>Còn hàng </option>
                                <option value='hết hàng' <?php if(  $product->product_display == 'hết hàng' ){ echo "selected=selected"; } ?>>Hết hàng</option>
                                <option value='hàng sắp về' <?php if(  $product->product_display == 'hàng sắp về' ){ echo "selected=selected"; } ?>>Hàng sắp về</option>
                            </select>
                            @error('display')
                            <small class='form-text text-danger'>{{$message}}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-group">
                            <label for="count">Số lượng</label>
                            <input class="form-control" type="number" name="count" id="count" value='{{ $product->product_count}}'>
                            @error('count')
                            <small class='form-text text-danger'>{{$message}}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-group">
                            <label for="view">Lượt xem</label>
                            <input class="form-control" type="number" name="view" id="view" value="{{ $product->product_view}}">
                            @error('view')
                            <small class='form-text text-danger'>{{$message}}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-group">
                            <label for="image">Hình sản phẩm</label> <br>
                            <input class="form-control-file" name="file" type="file" value='{{ $product->product_image}}'>
                            <img class='img-thumbnail img-fluid' src="{{url('/')}}/{{ $product->product_image}}" alt="">
                            @error('file')
                            <small class='form-text text-danger'>{{$message}}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-group">
                            <label for="user">Người tạo</label>
                            <select class="form-control" id="user" name='user'>
                                <option value=''>Chọn</option>
                                @foreach ($user as $item)
                                <option value='{{$item->id}}' <?php if( $product->product_user == $item->id ){ echo "selected=selected" ;} ?>>{{$item->name}}</option>
                                @endforeach
                            </select>
                            @error('user')
                            <small class='form-text text-danger'>{{$message}}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-group">
                            <label for="">Status</label>
                            <select class="form-control" id="" name='status'>
                                <option value=''> Chọn </option>
                                <option value='0' <?php if( $product->product_status == 0 ){ echo "selected=selected" ;} ?>>Ẩn </option>
                                <option value='1' <?php if( $product->product_status == 1 ){ echo "selected=selected"; } ?>>Hiện</option>
                            </select>
                            @error('status')
                            <small class='form-text text-danger'>{{$message}}</small>
                            @enderror
                        </div>
                    </div>
                </div>
                <input type="submit" value="Thêm mới" class="btn btn-primary" name='btn_edit'>
            </form>
        </div>
    </div>
</div>

@endsection
