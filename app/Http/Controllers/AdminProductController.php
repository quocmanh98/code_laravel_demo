<?php

namespace App\Http\Controllers;

use App\category_product;
use Illuminate\Http\Request;
use App\product;
use App\User;
use Illuminate\Support\Str;

class AdminProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        // $this->middleware('CheckAge')->only('index','login');
        // $this->middleware('CheckAge')->except('index');
        // $this->middleware('CheckRole');
        $this->middleware (function ($request,$next){
            session(['module_active'=>'product']);
            return $next($request);
        });
    }

    public function active($id)
    {
        product::where('product_id',$id)
        ->update(
            [
                'product_status' => 1,
            ]
        );
        return redirect()->route('admin.product.list')->with('status', 'Kích hoạt sản phẩm thành công');
    }

    public function unactive($id)
    {
        product::where('product_id',$id)
        ->update(
            [
                'product_status' => 0,
            ]
        );
        return redirect()->route('admin.product.list')->with('status', 'Hủy kích hoạt sản phẩm thành công');
    }

    public function index(Request $request)
    {
        $status = $request->input('status');
        $categorys = category_product::all();
        $users = User::all();

        if($status == 'trash'){
            $action = [
                'restore' => 'Khôi Phục',
                'forceDelete' => 'Xóa Vĩnh Viễn'
            ];
            $products = product::onlyTrashed()->paginate(10);
        }else{
            $action = [
                'delete' => 'Xóa Tạm Thời'
            ];
            if($request->input('keyword')){
                $keyword = $request->input('keyword');
            }else{
                $keyword = '';
            }
            $products = product::where('product_name','LIKE',"%$keyword%")->paginate(10);
        }

        $count_product_active = product::count();
        $count_product_trash = product::onlyTrashed()->count();
        $count = [ $count_product_active,$count_product_trash ];
        // dd( $list_categorys);
        return view('admin.product.list',compact('action','products','count','categorys','users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $category = category_product::all();
        $user = User::all();
        return view('admin.product.add',compact('category','user'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($request->input('btn_add')) {
            $request->validate(
                [
                    'name' => "required |min:8 |max:255",
                    'slug' => 'required |min:8 |max:255',
                    'code' => 'required |min:6 |max:255',
                    'category' => 'required',
                    'desc' => 'required |min:20 |max:255',
                    'content' => 'required |min:20',
                    'PriceOld' => 'required|integer|digits_between:5,10',
                    'PriceNew' => 'required|integer|digits_between:5,10',
                    'display' => 'required',
                    'count' => 'required|integer',
                    'view' => 'required|integer',
                    'file' => 'required',
                    'user' => 'required',
                    'status' => 'required',
                ],
                [
                    'required' => ":attribute không được để trống",
                    'min' => ":attribute có độ dài ít nhất :min ký tự",
                    'max' => ":attribute có độ dài tối đa :max ký tự",
                    'digits_between' => ':attribute phải là số và có giá khoảng từ 10,000 trở lên',
                    'integer' => 'Dữ liệu nhập vào số nguyên',
                ],
                [
                    'name' => "Tên sản phẩm",
                    'slug' => 'Tên sản phẩm không dấu',
                    'code' => 'Mã code',
                    'category' => 'Danh mục',
                    'desc' => 'Mô tả',
                    'content' => 'Chi tiết',
                    'PriceOld' => 'Gía cũ',
                    'PriceNew' => 'Gía mới',
                    'display' => 'Tình trạng',
                    'count' => 'Số lượng',
                    'view' => 'Lượt xem',
                    'file' => 'Hình ảnh',
                    'user' => 'Người tạo',
                    'status' => 'Hiển thị',
                ]
            );

            $input = array();
            if ($request->hasFile('file')) {
                $file = $request->file;
                $filename = $file->getClientOriginalName();
                $file->move('public/uploads', $filename);
                $thumbnail = "public/uploads/".$filename;
                $input['product_image'] =  $thumbnail;

                product::create(
                    [
                        'product_name' => $request->input('name'),
                        'product_slug' => Str::slug($request->input('slug')),
                        'product_code' => $request->input('code'),
                        'product_category_id' => $request->input('category'),
                        'product_desc' =>  $request->input('desc'),
                        'product_content' =>  $request->input('content'),
                        'product_price_old' =>  $request->input('PriceOld'),
                        'product_price_new' =>  $request->input('PriceNew'),
                        'product_display' =>  $request->input('display'),
                        'product_count' =>  $request->input('count'),
                        'product_view' =>  $request->input('view'),
                        'product_image' =>  $input['product_image'],
                        'product_user' =>  $request->input('user'),
                        'product_status' => $request->input('status')
                    ]
                );
                return redirect()->route('admin.product.list')->with('status', 'Thêm sản phẩm thành công');
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = product::where('product_id',$id)
        ->first();
        return view('admin.product.detail',compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = category_product::all();
        $user = User::all();
        $product = product::where('product_id',$id)
        ->first();
        return view('admin.product.edit',compact('category','user','product'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if ($request->input('btn_edit')) {
            $request->validate(
                [
                    'name' => "required |min:8 |max:255",
                    'slug' => 'required |min:8 |max:255',
                    'code' => 'required |min:6 |max:255',
                    'category' => 'required',
                    'desc' => 'required |min:20 |max:255',
                    'content' => 'required |min:20',
                    'PriceOld' => 'required|integer|digits_between:5,10',
                    'PriceNew' => 'required|integer|digits_between:5,10',
                    'display' => 'required',
                    'count' => 'required|integer',
                    'view' => 'required|integer',
                    'file' => 'required',
                    'user' => 'required',
                    'status' => 'required',
                ],
                [
                    'required' => ":attribute không được để trống",
                    'min' => ":attribute có độ dài ít nhất :min ký tự",
                    'max' => ":attribute có độ dài tối đa :max ký tự",
                    'digits_between' => ':attribute phải là số và có giá khoảng từ 10,000 trở lên',
                    'integer' => 'Dữ liệu nhập vào số nguyên',
                ],
                [
                    'name' => "Tên sản phẩm",
                    'slug' => 'Tên sản phẩm không dấu',
                    'code' => 'Mã code',
                    'category' => 'Danh mục',
                    'desc' => 'Mô tả',
                    'content' => 'Chi tiết',
                    'PriceOld' => 'Gía cũ',
                    'PriceNew' => 'Gía mới',
                    'display' => 'Tình trạng',
                    'count' => 'Số lượng',
                    'view' => 'Lượt xem',
                    'file' => 'Hình ảnh',
                    'user' => 'Người tạo',
                    'status' => 'Hiển thị',
                ]
            );

            $input = array();
            if ($request->hasFile('file')) {
                $file = $request->file;
                $filename = $file->getClientOriginalName();
                $file->move('public/uploads', $filename);
                $thumbnail = "public/uploads/".$filename;
                $input['product_image'] =  $thumbnail;

                product::where('product_id',$id)->update(
                    [
                        'product_name' => $request->input('name'),
                        'product_slug' => Str::slug($request->input('slug')),
                        'product_code' => $request->input('code'),
                        'product_category_id' => $request->input('category'),
                        'product_desc' =>  $request->input('desc'),
                        'product_content' =>  $request->input('content'),
                        'product_price_old' =>  $request->input('PriceOld'),
                        'product_price_new' =>  $request->input('PriceNew'),
                        'product_display' =>  $request->input('display'),
                        'product_count' =>  $request->input('count'),
                        'product_view' =>  $request->input('view'),
                        'product_image' =>  $input['product_image'],
                        'product_user' =>  $request->input('user'),
                        'product_status' => $request->input('status')
                    ]
                );
                return redirect()->route('admin.product.list')->with('status', 'Sửa sản phẩm thành công');
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        product::where('product_id',$id)->delete();
        return redirect()->route('admin.product.list')->with('status','Xóa sản phẩm thành công');
    }

    public function action(Request $request)
    {

        $action = $request->input('act');
            $list_check = $request->input('list_check');
            if(!empty($action) && !empty($list_check)){
                if($action == 'delete'){
                    product::whereIn('product_id',$list_check)->delete();
                    return redirect()->route('admin.product.list')->with('status','Xóa tạm thời sản phẩm thành công');
                }else if($action == 'forceDelete'){
                    product::onlyTrashed()
                    ->whereIn('product_id',$list_check)
                    ->forceDelete();
                    return redirect()->route('admin.product.list')->with('status','Xóa vĩnh viễn sản phẩm thành công');
                }else{
                    product::onlyTrashed()
                    ->whereIn('product_id',$list_check)
                    ->restore();
                    return redirect()->route('admin.product.list')->with('status','Khôi phục sản phẩm thành công');
                }
            }else{
                return redirect()->route('admin.product.list')->with('status','Hệ thống không thể xóa sản phẩm !');
            }
    }
}
