@extends('layouts.admin')
@section('content')

<div id="content" class="container-fluid">
    <div class="card">
        <div class="card-header font-weight-bold d-flex justify-content-between align-items-center">
            <h5 class="m-0 ">Trang chủ</h5>
            <div class="form-search form-inline">
                <form action="" method="GET">
                    <input type="text" name='keyword' class="form-control form-search mb-1" value="{{request()->input('keyword')}}" placeholder="Tìm kiếm">
                    <input type="submit" name="btn-search" value="Search" class="btn btn-primary">
                </form>
            </div>
        </div>
        <form action="{{route('admin.product.action')}}" method='post'>
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
            @if ($products->total() >0)
            <table class="table table-striped table-checkall">
                <thead>
                    <tr>
                        <th scope="col">
                            <input name="checkall" type="checkbox">
                        </th>
                        <th scope="col">#</th>
                        <th scope="col">Ảnh</th>
                        <th scope="col">Tên</th>
                        <th scope="col">Code</th>
                        <th scope="col">Danh mục</th>
                        <th scope="col">Giá cũ</th>
                        <th scope="col">Giá mới</th>
                        <th scope="col">Tình trạng</th>
                        <th scope="col">Số lượng</th>
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
                    @foreach ($products as  $item)
                    @php
                        $t++;
                    @endphp
                    <tr class="">
                        <td>
                            <input type="checkbox" name='list_check[]' value='{{$item->product_id}}'>
                        </td>
                        <td>{{$t}}</td>
                        <td><img class='img-fluid img-thumbnail' src="{{url('/')}}/{{$item->product_image}}" alt=""></td>
                        <td><a href="{{route('admin.product.detail',$item->product_id)}}">{{$item->product_name}}</a></td>
                        <td>{{$item->product_code}}</td>
                        <td>
                            @php
                                foreach($categorys as $category){
                                    if($category->category_id == $item->product_category_id){
                                        echo $category->category_name;
                                    }
                                }
                            @endphp
                        </td>
                        <td> {{number_format($item->product_price_old,'0','','.')}} đ</td>
                        <td> {{number_format($item->product_price_new,'0','','.')}} đ</td>
                        <td>
                            @php
                                if($item->product_display == 'còn hàng'){
                                    echo 'Còn hàng';
                                }elseif($item->product_display == 'hết hàng'){
                                    echo 'Hết hàng';
                                }else{
                                    echo 'Hàng sắp về';
                                }
                            @endphp
                        </td>
                        <td>{{$item->product_count}}</td>
                        <td>{{$item->product_view}}</td>
                        <td>
                            @php
                                foreach($users as $user){
                                    if($user->id == $item->product_user){
                                        echo $user->name;
                                    }
                                }
                            @endphp
                        </td>
                        <td>
                            @if ($item->product_status == 0)
                            <a href="{{route('admin.product.active',$item->product_id)}}" class="btn btn-success btn-sm rounded-0 text-white" type="button" data-toggle="tooltip" data-placement="top" ><i class="fas fa-thumbs-down"></i></a>
                            @else
                            <a href="{{route('admin.product.unactive',$item->product_id)}}" class="btn btn-success btn-sm rounded-0 text-white" type="button" data-toggle="tooltip" data-placement="top" ><i class="fas fa-thumbs-up"></i></a>
                            @endif
                            </td>
                        <td>
                        <td>
                            <a href="{{route('admin.product.edit',$item->product_id)}}" class="btn btn-success btn-sm rounded-0 text-white" type="button" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fa fa-edit"></i></a>
                            <a href="{{route('admin.product.destroy',$item->product_id)}}" class="btn btn-danger btn-sm rounded-0 text-white" type="button" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fa fa-trash"></i></a>
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
            {{$products->links()}}
        </div>
        </form>
    </div>
</div>
@endsection
