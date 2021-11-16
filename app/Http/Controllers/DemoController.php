<?php

namespace App\Http\Controllers;

use App\Mail\DemoMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class DemoController extends Controller
{
    public function sendmail(){
        $data =  [
            'title' => 'Gửi email từ Laravel',
            'content' => 'Nội dung thư Laravel'
        ];
        Mail::to('quocmanh1998s@gmail.com')->send(new DemoMail($data));
    }
}
