<?php

namespace App\Http\Controllers;

use App\category_post;
use App\post;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AdminPostController extends Controller
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
            session(['module_active'=>'post']);
            return $next($request);
        });
    }
    public function index(Request $request)
    {
        $status = $request->input('status');
        $action = array();
        if($status == 'trash'){
            $action = [
                'delete' => 'Xóa vĩnh viễn',
                'restore' => 'Khôi phục'
            ];
            $posts =  post::onlyTrashed()->simplePaginate(10);
        }else{
            $action = [
                'destory' => 'Xóa tạm thời'
            ];
                $q = '';
                if($request->input('q')){
                    $q = $request->input('q');
                }
                $posts =  post::where('post_name','LIKE',"%$q%")->simplePaginate(10);
        }
        $count_post_active = count(post::all());
        $count_post_trash = count(post::onlyTrashed()
        ->get());
        $count = [ $count_post_active,$count_post_trash];
        $categorys = category_post::all();
        $users = User::all();
        return view('admin.post.list',compact('posts','categorys','users','count','action'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $category = category_post::all();
        $user = User::all();
        return view('admin.post.add',compact('category','user'));
    }


    public function active($id)
    {
        post::where('post_id',$id)
        ->update(
            [
                'post_status' => 1,
            ]
        );
        return redirect()->route('admin.post.list')->with('status', 'Kích hoạt bài viết thành công');
    }

    public function unactive($id)
    {
        post::where('post_id',$id)
        ->update(
            [
                'post_status' => 0,
            ]
        );
        return redirect()->route('admin.post.list')->with('status', 'Hủy Kích hoạt bài viết thành công');
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
                    'category' => 'required',
                    'desc' => 'required |min:20',
                    'content' => 'required |min:20',
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
                    'name' => "Tên danh mục bài viết",
                    'slug' => 'Tên danh mục bài viết không dấu',
                    'category' => 'Danh mục bài viết',
                    'desc' => 'Mô tả',
                    'content' => 'Chi tiết',
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
                $input['post_image'] =  $thumbnail;

                post::create(
                    [
                        'post_name' => $request->input('name'),
                        'post_slug' => Str::slug($request->input('slug')),
                        'post_category_id' => $request->input('category'),
                        'post_desc' =>  $request->input('desc'),
                        'post_content' =>  $request->input('content'),
                        'post_view' =>  $request->input('view'),
                        'post_image' =>  $input['post_image'],
                        'post_user' =>  $request->input('user'),
                        'post_status' => $request->input('status')
                    ]
                );
                return redirect()->route('admin.post.list')->with('status', 'Thêm bài viết thành công');
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
        $post = post::where('post_id',$id)
        ->first();
        return view('admin.post.detail',compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = category_post::all();
        $user = User::all();
        $post = post::where('post_id',$id)
        ->first();
        return view('admin.post.edit',compact('category','user','post'));
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
                    'category' => 'required',
                    'desc' => 'required |min:20',
                    'content' => 'required |min:20',
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
                    'name' => "Tên danh mục bài viết",
                    'slug' => 'Tên danh mục bài viết không dấu',
                    'category' => 'Danh mục bài viết',
                    'desc' => 'Mô tả',
                    'content' => 'Chi tiết',
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
                $input['post_image'] =  $thumbnail;

                post::where('post_id',$id)
                ->update(
                    [
                        'post_name' => $request->input('name'),
                        'post_slug' => Str::slug($request->input('slug')),
                        'post_category_id' => $request->input('category'),
                        'post_desc' =>  $request->input('desc'),
                        'post_content' =>  $request->input('content'),
                        'post_view' =>  $request->input('view'),
                        'post_image' =>  $input['post_image'],
                        'post_user' =>  $request->input('user'),
                        'post_status' => $request->input('status')
                    ]
                );
                return redirect()->route('admin.post.list')->with('status', 'Sửa bài viết thành công');
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
        post::where('post_id',$id)
        ->delete();
        return redirect()->route('admin.post.list')->with('status', 'Xóa tạm thời bài viết thành công');
    }

    public function action(Request $request){
        if ($request->input('btn_permission')) {

            $list_check = $request->input('list_check');
            $permission = $request->input('permission');

            if(!empty($list_check)){

                if($permission == 'destory'){
                    foreach($list_check as $v){
                        post::where('post_id',$v)
                        ->delete();
                    }
                    return redirect()->route('admin.post.list')->with('status', 'Xóa tạm thời bài viết thành công');
                }elseif($permission == 'delete'){
                    foreach($list_check as $v){
                        post::onlyTrashed()
                        ->where('post_id',$v)
                        ->forceDelete();
                    }
                    return redirect()->route('admin.post.list')->with('status', 'Xóa vĩnh viễn bài viết thành công');
                }else{
                    foreach($list_check as $v){
                        post::onlyTrashed()
                        ->where('post_id',$v)
                        ->restore();
                    }
                    return redirect()->route('admin.post.list')->with('status', 'khôi phục bài viết thành công');
                }

            }else{
                return  redirect()->route('admin.post.list');
            }

        }
    }
}
