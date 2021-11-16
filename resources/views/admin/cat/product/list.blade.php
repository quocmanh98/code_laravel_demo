@extends('layouts.admin')
@section('content')

<div id="content" class="container-fluid">
    <div class="card">
        <div class="card-header font-weight-bold d-flex justify-content-between align-items-center">
            <h5 class="m-0 ">Danh sách danh mục sản phẩm</h5>
            <div class="form-search form-inline">
                <form action="" method="GET">
                    <input type="text" name='keyword' class="form-control form-search mb-1" value="{{request()->input('keyword')}}" placeholder="Tìm kiếm">
                    <input type="submit" name="btn-search" value="Search" class="btn btn-primary">
                </form>
            </div>
        </div>
        <form action="{{route('admin.cat.product.action')}}" method='post'>
            @csrf
        <div class="card-body">
            <div class="analytic">
                <a href="{{request()->fullUrlWithQuery(['status' => 'active'])}}" class="text-primary">Kích hoạt<span class="text-muted">({{$count['0']}})</span></a>
                <a href="{{request()->fullUrlWithQuery(['status' => 'trash'])}}" class="text-primary">Vô hiệu hóa<span class="text-muted">({{$count['1']}})</span></a>
            </div>
                <div class="form-action form-inline py-3">
                    <select class="form-control mr-1" id="" name='act'>
                        <option value=''>Chọn</option>
                        @foreach ( $action as $k => $v)
                        <option value='{{$k}}'>{{$v}}</option>
                        @endforeach
                    </select>
                    <input type="submit" name="btn-search" value="Áp dụng" class="btn btn-primary">
                </div>
            @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{session('status')}}
            </div>
            @endif
            @if ($list_categorys->total()>0)
            <table class="table table-striped table-checkall">
                <thead>
                    <tr>
                        <th>
                            <input type="checkbox" name="checkall">
                        </th>
                        <th scope="col">#</th>
                        <th scope="col">Name</th>
                        <th scope="col">Slug</th>
                        <th scope="col">Status</th>
                        <th scope="col">Quản lý</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $t = 0;
                    @endphp
                    @foreach (  $list_categorys as $list_category )
                    <tr>
                        <td>
                            <input type="checkbox" name='list_check[]' value='{{$list_category->category_id}}'>
                        </td>
                        <th scope="row">{{$t++}}</th>
                        <td>{{$list_category->category_name}}</td>
                        <td>{{$list_category->category_slug}}</td>
                        <td>
                            @if ($list_category->category_status == 1)
                            Hiện
                            @else
                            Ẩn
                            @endif
                        </td>
                        <td>{{$list_category->created_at}}</td>
                        <td>
                            <a href="{{route('admin.cat.product.edit',$list_category->category_id)}}" class="btn btn-success btn-sm rounded-0 text-white" type="button" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-edit"></i></a>
                            <a href="{{route('admin.cat.product.destroy',$list_category->category_id)}}" class="btn btn-danger btn-sm rounded-0 text-white" type="button" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fa fa-trash"></i></a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            @else
            <div class="alert alert-warning" role="alert">
                Không tìm thấy bản ghi nào !
            </div>
            @endif
            {{$list_categorys->links()}}
        </div>
        </form>
    </div>
</div>
@endsection
