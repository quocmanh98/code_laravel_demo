@extends('layouts.admin')
@section('content')
<div id="content" class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header font-weight-bold">
                    Thêm danh mục bài viết
                </div>
                <div class="card-body">
                    <form action='{{route('admin.cat.post.store')}}' method='post'>
                        @csrf
                        <div class="form-group">
                            <label for="name">Tên danh mục</label>
                            <input class="form-control" type="text" name="name" id="name" value='{{old('name')}}'>
                            @error('name')
                            <small class='form-text text-danger'>{{$message}}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="slug">Slug</label>
                            <input class="form-control" type="text" name="slug" id="slug" value='{{old('slug')}}'>
                            @error('slug')
                            <small class='form-text text-danger'>{{$message}}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="status">Trạng thái</label>
                            <select class="form-control" id="status" name='status'>
                                <option value=''> Chọn </option>
                                <option value='0' <?php if( old('status') == 1 ){ echo "selected=selected" ;} ?>>Hiện </option>
                                <option value='1' <?php if( old('status') == 0 ){ echo "selected=selected"; } ?>>Ẩn</option>
                            </select>
                            @error('status')
                            <small class='form-text text-danger'>{{$message}}</small>
                            @enderror
                        </div>
                        <input type="submit" value="Thêm mới" class="btn btn-primary" name='btn_add'>
                    </form>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection
