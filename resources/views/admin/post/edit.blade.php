@extends('layouts.admin')
@section('content')
<div id="content" class="container-fluid">
    <div class="card">
        <div class="card-header font-weight-bold">
            Sửa bài viết
        </div>
        <div class="card-body">
            <form action='{{route('admin.post.update',$post->post_id)}}' method='post' enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-12">
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input class="form-control" type="text" name="name" id="name" value="{{$post->post_name}}">
                            @error('name')
                            <small class='form-text text-danger'>{{$message}}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-group">
                            <label for="slug">Slug</label>
                            <input class="form-control" type="text" name="slug" id="slug" value="{{$post->post_slug}}">
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
                                <option value='{{$item->category_post_id}}' <?php if( $post->post_category_id == $item->category_post_id ){ echo "selected=selected" ; }  ?>>{{$item->category_post_name}}</option>
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
                            <textarea name="desc" id="mytextarea" class="form-control" id="desc" cols="30" rows="5">{{$post->post_desc}}</textarea>
                            @error('desc')
                            <small class='form-text text-danger'>{{$message}}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-group">
                            <label for="content">Chi tiết bài viết</label>
                            <textarea name="content" id="mytextarea" class="form-control" id="content" cols="30" rows="5">{{$post->post_content}}</textarea>
                            @error('content')
                            <small class='form-text text-danger'>{{$message}}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-group">
                            <label for="view">Lượt xem</label>
                            <input class="form-control" type="number" name="view" id="view" value="{{ $post->post_view}}">
                            @error('view')
                            <small class='form-text text-danger'>{{$message}}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-group">
                            <label for="image">Hình bài viết</label> <br>
                            <input class="form-control-file" name="file" type="file" value='{{ $post->post_image}}'>
                            <img class='img-thumbnail img-fluid' src="{{url('/')}}/{{ $post->post_image}}" alt="">
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
                                <option value='{{$item->id}}' <?php if( $post->post_user == $item->id ){ echo "selected=selected" ;} ?>>{{$item->name}}</option>
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
                                <option value='0' <?php if( $post->post_status == 0 ){ echo "selected=selected" ;} ?>>Ẩn </option>
                                <option value='1' <?php if( $post->post_status == 1 ){ echo "selected=selected"; } ?>>Hiện</option>
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
