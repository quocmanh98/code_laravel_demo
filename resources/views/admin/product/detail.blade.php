@extends('layouts.admin')
@section('content')
<div id="content" class="container-fluid">
    <div class="card">
        <div class="card-header font-weight-bold d-flex justify-content-between align-items-center">
            <h5 class="m-0 ">Sản phẩm chi tiết:  {!! $product->product_name !!} </h5>
        </div>
        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Tên sản phẩm</th>
                        <th scope="col">Chi tiết</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th scope="row">{{ $product->product_id }}</th>
                        <td>{{ $product->product_name }}</td>
                        <td>
                            {!! $product->product_content !!}
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection
