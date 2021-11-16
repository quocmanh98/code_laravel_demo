<?php

namespace App\Http\Controllers;

use App\category_product;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AdminCatProductController extends Controller
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
            session(['module_active'=>'category product']);
            return $next($request);
        });
    }

    public function active($id)
    {
        category_product::where('category_id',$id)
        ->update(
            [
                'category_status' => 1,
            ]
        );
        return redirect()->route('admin.cat.product.list')->with('status', 'Kích hoạt danh mục thành công');
    }

    public function unactive($id)
    {
        category_product::where('category_id',$id)
        ->update(
            [
                'category_status' => 0,
            ]
        );
        return redirect()->route('admin.cat.product.list')->with('status', 'Hủy kích hoạt danh mục thành công');
    }

    public function index(Request $request)
    {
        $status = $request->input('status');

        if($status == 'trash'){
            $action = [
                'restore' => 'Khôi Phục',
                'forceDelete' => 'Xóa Vĩnh Viễn'
            ];
            $list_categorys = category_product::onlyTrashed()->paginate(10);
        }else{
            $action = [
                'delete' => 'Xóa Tạm Thời'
            ];
            if($request->input('keyword')){
                $keyword = $request->input('keyword');
            }else{
                $keyword = '';
            }
            $list_categorys = category_product::where('category_name','LIKE',"%$keyword%")->paginate(10);
        }

        $count_category_active = category_product::count();
        $count_category_trash = category_product::onlyTrashed()->count();
        $count = [$count_category_active, $count_category_trash];
        // dd( $list_categorys);
        return view('admin.cat.product.list',compact('action','list_categorys','count'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.cat.product.add');
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
                    'name' => "required |min:6 |max:255",
                    'slug' => 'required |min:6 |max:255',
                    'status' => 'required',
                ],
                [
                    'required' => ":attribute không được để trống",
                    'min' => ":attribute có độ dài ít nhất :min ký tự",
                    'max' => ":attribute có độ dài tối đa :max ký tự",
                ],
                [
                    'name' => 'Tên danh mục',
                    'slug' => 'Tên danh mục không dấu',
                    'status' => 'Trạng thái',
                ]
            );

            category_product::create(
                [
                    'category_name' => $request->input('name'),
                    'category_slug' => Str::slug($request->input('slug')),
                    'category_status' => $request->input('status'),
                ]
            );
            return redirect()->route('admin.cat.product.list')->with('status', 'Thêm danh mục thành công');
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $item = category_product::where('category_id',$id)->first();
        return view('admin.cat.product.edit',compact('item'));
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
                    'name' => "required |min:6 |max:255",
                    'status' => 'required',
                ],
                [
                    'required' => ":attribute không được để trống",
                    'min' => ":attribute có độ dài ít nhất :min ký tự",
                    'max' => ":attribute có độ dài tối đa :max ký tự",
                ],
                [
                    'name' => 'Tên danh mục',
                    'status' => 'Trạng thái',
                ]
            );

            category_product::where('category_id',$id)->update(
                [
                    'category_name' => $request->input('name'),
                    'category_slug' => Str::slug($request->input('name')),
                    'category_status' => $request->input('status'),
                ]
            );
            return redirect()->route('admin.cat.product.list')->with('status', 'Sửa danh mục thành công');
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
        category_product::where('category_id',$id)->delete();
        return redirect()->route('admin.cat.product.list')->with('status','Xóa danh mục thành công');
    }

    public function action(Request $request)
    {

        $action = $request->input('act');
            $list_check = $request->input('list_check');
            if(!empty($action) && !empty($list_check)){
                if($action == 'delete'){
                    category_product::whereIn('category_id',$list_check)->delete();
                    return redirect()->route('admin.cat.product.list')->with('status','Xóa tạm thời danh mục sản phẩm thành công');
                }else if($action == 'forceDelete'){
                    category_product::onlyTrashed()
                    ->whereIn('category_id',$list_check)
                    ->forceDelete();
                    return redirect()->route('admin.cat.product.list')->with('status','Xóa vĩnh viễn danh mục sản phẩm thành công');
                }else{
                    category_product::onlyTrashed()
                    ->whereIn('category_id',$list_check)
                    ->restore();
                    return redirect()->route('admin.cat.product.list')->with('status','Khôi phục danh mục sản phẩm thành công');
                }
            }else{
                return redirect()->route('admin.cat.product.list')->with('status','Hệ thống không thể xóa danh mục sản phẩm !');
            }
    }
}
