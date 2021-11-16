@extends('layouts.admin')
@section('content')
<div id="content" class="container-fluid">
    <div class="card">
        <div class="card-header font-weight-bold">
            Thêm bài viết
        </div>
        <div class="card-body">
            <form action='{{route('admin.post.store')}}' method='post' enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-12">
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input class="form-control" type="text" name="name" id="name" value="{{old('name')}}">
                            @error('name')
                            <small class='form-text text-danger'>{{$message}}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-group">
                            <label for="slug">Slug</label>
                            <input class="form-control" type="text" name="slug" id="slug" value="{{old('slug')}}">
                            @error('slug')
                            <small class='form-text text-danger'>{{$message}}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-group">
                            <label>Danh mục bài viết</label>
                            <select class="form-control" id="category" name='category'>
                                <option value=''>Chọn danh mục</option>
                                @foreach ($category as $item)
                                <option value='{{$item->category_post_id}}' <?php if( old('category') == $item->category_post_id ){ echo "selected=selected" ; }  ?>>{{$item->category_post_name}}</option>
                                @endforeach
                            </select>
                            @error('category')
                            <small class='form-text text-danger'>{{$message}}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-group">
                            <label for="desc">Mô tả bài viết</label>
                            <textarea name="desc" id="mytextarea" class="form-control" id="desc" cols="30" rows="5">{{old('desc')}}</textarea>
                            @error('desc')
                            <small class='form-text text-danger'>{{$message}}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-group">
                            <label for="content">Chi tiết bài viết</label>
                            <textarea name="content" id="mytextarea" class="form-control" id="content" cols="30" rows="5">{{old('content')}}</textarea>
                            @error('content')
                            <small class='form-text text-danger'>{{$message}}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-group">
                            <label for="view">Lượt xem</label>
                            <input class="form-control" type="number" name="view" id="view" value="{{old('view')}}">
                            @error('view')
                            <small class='form-text text-danger'>{{$message}}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-group">
                            <label for="image">Hình bài viết</label> <br>
                            <input class="form-control-file" name="file" type="file">
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
                                <option value='{{$item->id}}' <?php if( old('user') == $item->id ){ echo "selected=selected" ;} ?>>{{$item->name}}</option>
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
                                <option value='0' <?php if( old('status') == 0 ){ echo "selected=selected" ;} ?>>Ẩn </option>
                                <option value='1' <?php if( old('status') == 1 ){ echo "selected=selected"; } ?>>Hiện</option>
                            </select>
                            @error('status')
                            <small class='form-text text-danger'>{{$message}}</small>
                            @enderror
                        </div>
                    </div>
                </div>
                <input type="submit" value="Thêm mới" class="btn btn-primary" name='btn_add'>
            </form>
        </div>
    </div>
</div>

@endsection
