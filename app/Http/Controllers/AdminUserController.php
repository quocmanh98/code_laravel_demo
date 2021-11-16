<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class AdminUserController extends Controller
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
            session(['module_active'=>'user']);
            return $next($request);
        });
    }

    public function index(Request $request)
    {

        $status = $request->input('status');

        if($status == 'trash'){
            $link_action = [
                'restore' => 'Khôi Phục',
                'forceDelete' => 'Xóa Vĩnh Viễn'
            ];
            $users = User::onlyTrashed()->paginate(10);
        }else{
            $link_action = [
                'delete' => 'Xóa Tạm Thời'
            ];
            if($request->input('keyword')){
                $keyword = $request->input('keyword');
            }else{
                $keyword = '';
            }
            $users = User::where('name','LIKE',"%$keyword%")->paginate(10);
        }

        $count_user_active = User::count();
        $count_user_trash = User::onlyTrashed()->count();
        $count = [$count_user_active,$count_user_trash];
        // dd($users->total());
        return view('admin.user.list',compact('users','count','link_action'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.user.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if($request->input('btn_add')){

            $request->validate(
                [
                    'name' => 'required|string|max:255',
                    'email' => 'required|string|email|max:255|unique:users',
                    'password' => 'required |min:8|confirmed',
                    'permissions' => 'required'
                ],
                [
                    'required' => ':attribute không được để trống',
                    'min' => ':attribute có độ dài ít nhất :min ký tự',
                    'max' => ':attribute có độ dài ít nhất :max ký tự',
                    'confirmed' => 'Xác nhận mật khẩu không thành công'
                ],
                [
                    'name' => 'Tên người dùng',
                    'email' => 'Email',
                    'password' => 'Mật khẩu',
                    'permissions' => 'Nhóm quyền'
                ]
            );

            User::create(
                [
                    'name' => $request->input('name'),
                    'email' => $request->input('email'),
                    'password' => md5($request->input('password')),
                    'role_id' => $request->input('permissions')
                ]
                );

                return redirect()->route('admin.user.list')->with('status','Thêm thành viên thành công');

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
        $user = User::find($id);
        return view('admin.user.edit',compact('user'));
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
        if($request->input('btn_edit')){

            $request->validate(
                [
                    'name' => 'required|string|max:255',
                    'password' => 'required |min:8|confirmed',
                    'permissions' => 'required'
                ],
                [
                    'required' => ':attribute không được để trống',
                    'min' => ':attribute có độ dài ít nhất :min ký tự',
                    'max' => ':attribute có độ dài ít nhất :max ký tự',
                    'confirmed' => 'Xác nhận mật khẩu không thành công'
                ],
                [
                    'name' => 'Tên người dùng',
                    'password' => 'Mật khẩu',
                    'permissions' => 'Nhóm quyền'
                ]
            );

            User::where('id',$id)->update(
                [
                    'name' => $request->input('name'),
                    'password' => md5($request->input('password')),
                    'role_id' => $request->input('permissions')
                ]
                );

                return redirect()->route('admin.user.list')->with('status','Sửa thành viên thành công');

        }
    }

    public function action(Request $request)
    {
            $action = $request->input('act');
            $list_check = $request->input('list_check');
            if(!empty($action) && !empty($list_check)){
                if($action == 'delete'){
                    User::whereIn('id',$list_check)->delete();
                    return redirect()->route('admin.user.list')->with('status','Xóa tạm thời thành viên thành công');
                }else if($action == 'forceDelete'){
                    User::onlyTrashed()
                    ->whereIn('id',$list_check)
                    ->forceDelete();
                    return redirect()->route('admin.user.list')->with('status','Xóa vĩnh viễn thành viên thành công');
                }else{
                    User::onlyTrashed()
                    ->whereIn('id',$list_check)
                    ->restore();
                    return redirect()->route('admin.user.list')->with('status','Khôi phục thành viên thành công');
                }
            }else{
                return redirect()->route('admin.user.list')->with('status','Hệ thống không thể xóa thành viên !');
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
        User::find($id)->delete();
        return redirect()->route('admin.user.list')->with('status','Xóa thành viên thành công');

    }
}
