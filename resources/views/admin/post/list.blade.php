@extends('layouts.admin')
@section('content')
<div id="content" class="container-fluid">
    <div class="card">
        <div class="card-header font-weight-bold d-flex justify-content-between align-items-center">
            <h5 class="m-0 ">Danh sách bài viết</h5>
            <div class="form-search form-inline">
                <form action="{{route('admin.post.list')}}" method='get'>
                    <input type="" class="form-control form-search" name='q' placeholder="Tìm kiếm">
                    <input type="submit" name="btn-search" value="Tìm kiếm" class="btn btn-primary">
                </form>
            </div>
        </div>
        <form action="{{route('admin.post.action')}}" method='post'>
            @csrf
        <div class="card-body">
            <div class="analytic">
                <a href="{{request()->fullUrlWithQuery(['status' => 'active'])}}" class="text-primary">Kích hoạt<span class="text-muted">({{$count['0']}})</span></a>
                <a href="{{request()->fullUrlWithQuery(['status' => 'trash'])}}" class="text-primary">Vô hiệu hóa<span class="text-muted">({{$count['1']}})</span></a>
            </div>
            <div class="form-action form-inline py-3">
                <select class="form-control mr-1" id="" name='permission'>
                    <option>Chọn</option>
                    @foreach ($action as $k => $v)
                    <option value="{{$k}}">{{$v}}</option>
                    @endforeach
                </select>
                <input type="submit" name="btn_permission" value="Áp dụng" class="btn btn-primary">
            </div>
            @if (count($posts) > 0)
            <table class="table table-striped table-checkall">
                <thead>
                    <tr>
                        <th scope="col">
                            <input name="checkall" type="checkbox">
                        </th>
                        <th scope="col">#</th>
                        <th scope="col">Ảnh</th>
                        <th scope="col">Tên</th>
                        <th scope="col">Danh mục</th>
                        <th scope="col">Lượt xem</th>
                        <th scope="col">Người tạo</th>
                        <th scope="col">Trạng thái</th>
                        <th scope="col">Tác vụ</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $t = 0;
                    @endphp
                    @foreach ($posts as  $item)
                    @php
                        $t++;
                    @endphp
                    <tr class="">
                        <td>
                            <input type="checkbox" name='list_check[]' value='{{$item->post_id}}'>
                        </td>
                        <td>{{$t}}</td>
                        <td><img class='img-fluid img-thumbnail' src="{{url('/')}}/{{$item->post_image}}" alt=""></td>
                        <td><a href="{{route('admin.post.detail',$item->post_id)}}">{{$item->post_name}}</a></td>
                        <td>
                            @php
                                foreach($categorys as $category){
                                    if($category->category_post_id == $item->post_category_id){
                                        echo $category->category_post_name;
                                    }
                                }
                            @endphp
                        </td>
                        <td>{{$item->post_view}}</td>
                        <td>
                            @php
                                foreach($users as $user){
                                    if($user->id == $item->post_user){
                                        echo $user->name;
                                    }
                                }
                            @endphp
                        </td>
                        <td>
                            @if ($item->post_status == 0)
                            <a href="{{route('admin.post.active',$item->post_id)}}" class="btn btn-success btn-sm rounded-0 text-white" type="button" data-toggle="tooltip" data-placement="top" ><i class="fas fa-thumbs-down"></i></a>
                            @else
                            <a href="{{route('admin.post.unactive',$item->post_id)}}" class="btn btn-success btn-sm rounded-0 text-white" type="button" data-toggle="tooltip" data-placement="top" ><i class="fas fa-thumbs-up"></i></a>
                            @endif
                            </td>
                        <td>
                        <td>
                            <a href="{{route('admin.post.edit',$item->post_id)}}" class="btn btn-success btn-sm rounded-0 text-white" type="button" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-edit"></i></a>
                            <a href="{{route('admin.post.destroy',$item->post_id)}}" class="btn btn-danger btn-sm rounded-0 text-white" type="button" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fa fa-trash"></i></a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            @else
            <div class="alert alert-warning" role="alert">
                không có bản ghi nào !
            </div>
            @endif
            @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{session('status')}}
            </div>
            @endif
            {{$posts->links()}}
        </div>
        </form>
    </div>
</div>

@endsection
