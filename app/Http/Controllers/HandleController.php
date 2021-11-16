<?php

namespace App\Http\Controllers;

use App\customer;
use App\Mail\forgot;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class HandleController extends Controller
{
    public function register(Request $request ){
        if ($request->input('btn_res')) {
            $request->validate(
                [
                    'customer_username' => "required |min:8 |max:255|unique:customers",
                    'fullname' => "required |min:8 |max:255",
                    'customer_email' => 'required |min:8 |max:255|unique:customers',
                    'password' => 'required |min:8|confirmed',
                    'phone' => 'required|min:10',
                    'address' => 'required |min:10 |max:255',
                    'gender'=> 'required',
                    'birthday' => ['required','date']
                ],
                [
                    'required' => ":attribute không được để trống",
                    'min' => ":attribute có độ dài ít nhất :min ký tự",
                    'max' => ":attribute có độ dài tối đa :max ký tự",
                    "confirmed" => "Xác nhận mật khẩu không thành công",
                    'integer' => 'Dữ liệu nhập vào phải là số nguyên',
                    'date'=> 'Dữ liệu nhập vào phải đúng định dạng date'
                ],
                [
                    'customer_username' => "Tên người dùng",
                    'fullname' => "Họ tên",
                    'customer_email' => 'Gmail',
                    'password' => 'Mật khẩu',
                    'phone' => 'Điện thoại',
                    'address' => 'Địa chỉ',
                    'gender'=> 'Giới Tính',
                    'birthday' => 'Ngày sinh'
                ]
            );

            $insert_customer = Customer::create(
                [
                    'customer_username' => $request->input('customer_username'),
                    'customer_fullname' => $request->input('fullname'),
                    'customer_email' => $request->input('customer_email'),
                    'customer_password' => md5($request->input('password')),
                    'customer_phone' => $request->input('phone'),
                    'customer_address' => $request->input('address'),
                    'customer_gender' => $request->input('gender'),
                    'customer_birthday' => $request->input('birthday'),
                ]
            );
            // $request->session()->put('customer_username',  $request->input('customer_username'));
            // $request->session()->put('customer_fullname',  $request->input('fullname'));
            return redirect()->route('home.login')->with('status', 'Bạn đã đăng ký tài khoản thành công');
        }
    }

    public function login(Request $request){
        if ($request->input('btn_login')) {
            $request->validate(
                [
                    'customer_email' => 'required |min:8 |max:255 |email',
                    'password' => 'required |min:8',
                ],
                [
                    'required' => ":attribute không được để trống",
                    'min' => ":attribute có độ dài ít nhất :min ký tự",
                    'max' => ":attribute có độ dài tối đa :max ký tự",
                    "email" => "Dữ liệu nhập vào phải là email",
                ],
                [
                    'customer_email' => 'Gmail',
                    'password' => 'Mật khẩu',
                ]
            );
            $return = Customer::where('customer_email',$request->input('customer_email'))
            ->where('customer_password',md5($request->input('password')))
            ->first();
            if(!empty($return)){
                $request->session()->put('customer_id', $return->customer_id);
                $request->session()->put('customer_fullname', $return->customer_fullname);
                $request->session()->put('customer_email', $return->customer_email);
                return redirect()->route('home.user')->with('status', 'Bạn đã đăng nhập thành công');
            }else{
                return redirect()->route('home.login')->with('error', 'Bạn đã đăng nhập sai email or password');
            }
        }
    }

    public function logout(Request $request){
        $request->session()->flush();
        return redirect()->route('home.login')->with('status', 'Bạn đã thoát thành công !');
    }

    public function forgot(Request $request){
        if ($request->input('btn_forgot')) {
            $request->validate(
                [
                    'customer_email' => 'required |min:8 |max:255 |email',
                ],
                [
                    'required' => ":attribute không được để trống",
                    'min' => ":attribute có độ dài ít nhất :min ký tự",
                    'max' => ":attribute có độ dài tối đa :max ký tự",
                    "email" => "Dữ liệu nhập vào phải là email",
                ],
                [
                    'customer_email' => 'Gmail'
                ]
            );
            $customer = Customer::where('customer_email',$request->input('customer_email'))->first();
            if(!empty($customer)){
                $pass_new = random_int(0, 99999999);
                $pass_two = htmlspecialchars(md5(($pass_new )));
                Customer::where('customer_email',$request->input('customer_email'))
                ->update(
                    ['customer_password' => $pass_two]
                );
                $data = [
                    'key' => $pass_new
                ];
                Mail::to('quocmanh1998s@gmail.com')->send(new forgot($data));
                return redirect()->route('home.login')->with('status', 'Bạn đã đổi mật khẩu thành công');
            }else{
                return redirect()->route('home.login')->with('error', 'Bạn không đổi được mật khẩu ');
            }
        }
    }

    public function edit(Request $request ){
        if ($request->input('btn_edit')) {
            $request->validate(
                [
                    'customer_username' => "required |min:8 |max:255",
                    'fullname' => "required |min:8 |max:255",
                    'password' => 'required |min:8|confirmed',
                    'phone' => 'required|min:10',
                    'address' => 'required |min:10 |max:255',
                    'gender'=> 'required',
                    'birthday' => ['required','date']
                ],
                [
                    'required' => ":attribute không được để trống",
                    'min' => ":attribute có độ dài ít nhất :min ký tự",
                    'max' => ":attribute có độ dài tối đa :max ký tự",
                    "confirmed" => "Xác nhận mật khẩu không thành công",
                    'integer' => 'Dữ liệu nhập vào phải là số nguyên',
                    'date'=> 'Dữ liệu nhập vào phải đúng định dạng date'
                ],
                [
                    'customer_username' => "Tên người dùng",
                    'fullname' => "Họ tên",
                    'password' => 'Mật khẩu',
                    'phone' => 'Điện thoại',
                    'address' => 'Địa chỉ',
                    'gender'=> 'Giới Tính',
                    'birthday' => 'Ngày sinh'
                ]
            );

            $insert_customer = Customer::where('customer_id',session('customer_id'))
            ->update(
                [
                    'customer_username' => $request->input('customer_username'),
                    'customer_fullname' => $request->input('fullname'),
                    'customer_password' => md5($request->input('password')),
                    'customer_phone' => $request->input('phone'),
                    'customer_address' => $request->input('address'),
                    'customer_gender' => $request->input('gender'),
                    'customer_birthday' => $request->input('birthday'),
                ]
            );
            return redirect()->route('home.edit')->with('status', 'Bạn đã sửa đổi thông tin thành công');
        }
    }


}
