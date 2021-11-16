<!DOCTYPE html>
<html>
    <head>
        <title>ISMART</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
        <link href="{{url('/')}}/public/user/reset.css" rel="stylesheet" type="text/css"/>
        <link href="{{url('/')}}/public/user/css/carousel/owl.carousel.css" rel="stylesheet" type="text/css"/>
        <link href="{{url('/')}}/public/user/css/carousel/owl.theme.css" rel="stylesheet" type="text/css"/>
        <link href="{{url('/')}}/public/user/css/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
        <link href="{{url('/')}}/public/user/responsive.css" rel="stylesheet" type="text/css"/>
        <link href="{{url('/')}}/public/user/css/import/fonts.css" rel="stylesheet" type="text/css"/>
        <link href="{{url('/')}}/public/user/css/import/global.css" rel="stylesheet" type="text/css"/>
        <link href="{{url('/')}}/public/user/css/import/header.css" rel="stylesheet" type="text/css"/>
        <link href="{{url('/')}}/public/user/css/import/footer.css" rel="stylesheet" type="text/css"/>
        <link href="{{url('/')}}/public/user/css/import/home.css" rel="stylesheet" type="text/css"/>
        <link href="{{url('/')}}/public/user/css/import/category_product.css" rel="stylesheet" type="text/css"/>
        <link href="{{url('/')}}/public/user/css/import/blog.css" rel="stylesheet" type="text/css"/>
        <link href="{{url('/')}}/public/user/css/import/detail_product.css" rel="stylesheet" type="text/css"/>
        <link href="{{url('/')}}/public/user/css/import/detail_blog.css" rel="stylesheet" type="text/css"/>
        <link href="{{url('/')}}/public/user/css/import/cart.css" rel="stylesheet" type="text/css"/>
        <link href="{{url('/')}}/public/user/css/import/checkout.css" rel="stylesheet" type="text/css"/>
        <script src="{{url('/')}}/public/user/js/jquery-2.2.4.min.js" type="text/javascript"></script>
        <script src="{{url('/')}}/public/user/js/jquery-3.6.0.min.js" type="text/javascript"></script>
        <script src="{{url('/')}}/public/user/js/app.js" type="text/javascript"></script>
        <script src="{{url('/')}}/public/user/js/elevatezoom-master/jquery.elevatezoom.js" type="text/javascript"></script>
        <script src="{{url('/')}}/public/user/js/bootstrap/bootstrap.min.js" type="text/javascript"></script>
        <script src="{{url('/')}}/public/user/js/carousel/owl.carousel.js" type="text/javascript"></script>
        <script src="{{url('/')}}/public/user/js/main.js" type="text/javascript"></script>
    </head>
    <body>
        <div id="site">
            <div id="container">
                <div id="header-wp">
                    <div id="head-top" class="clearfix">
                        <div class="wp-inner">
                            <a href="" title="" id="payment-link" class="fl-left">Hình thức thanh toán</a>
                            <div id="main-menu-wp" class="fl-right">
                                <ul id="main-menu" class="clearfix">
                                    <li>
                                        <a href="{{url('/')}}" title="">Trang chủ</a>
                                    </li>
                                    <li>
                                        <a href="{{route('product.index')}}" title="">Sản phẩm</a>
                                    </li>
                                    <li>
                                        <a href="{{route('blog')}}" title="">Bài Viết</a>
                                    </li>
                                    @if (session('customer_fullname'))
                                    <li>
                                        <a href="{{url('/')}}" title=""> Xin chào: {{session('customer_fullname')}}</a>
                                    </li>
                                    <li>
                                        <a href="{{route('home.info')}}" title="">Info</a>
                                    </li>
                                    <li>
                                        <a href="{{route('home.edit')}}" title="">Edit Profile</a>
                                    </li>
                                    <li>
                                        <a href="{{route('home.handle.logout')}}" title="">Thoát</a>
                                    </li>
                                    @else
                                    <li>
                                        <a href="{{route('home.login')}}" title="">Đăng nhập</a>
                                    </li>
                                    <li>
                                        <a href="{{route('home.register')}}" title="">Đăng ký</a>
                                    </li>
                                    <li>
                                        <a href="{{route('home.forgot')}}" title="">Quên Mật Khẩu</a>
                                    </li>
                                    @endif
                                    <li>
                                        <a href="{{route('contact')}}" title="">Liên hệ</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div id="head-body" class="clearfix">
                        <div class="wp-inner">
                            <a href="{{url('/')}}" title="" id="logo" class="fl-left"><img src="{{url('/')}}/public/user/images/logo.png"/></a>
                            <div id="search-wp" class="fl-left">
                                <form method="GET" action="{{route('product.index')}}">
                                    <input type="text" name="s" id="s" placeholder="Tìm kiếm sản phẩm tại đây !">
                                    <button type="submit" id="sm-s">Tìm kiếm</button>
                                </form>
                            </div>
                            <div id="action-wp" class="fl-right">
                                <div id="advisory-wp" class="fl-left">
                                    <span class="title">Tư vấn</span>
                                    <span class="phone">0987.654.321</span>
                                </div>
                                <div id="btn-respon" class="fl-right"><i class="fa fa-bars" aria-hidden="true"></i></div>
                                <a href="{{route('cart')}}" title="giỏ hàng" id="cart-respon-wp" class="fl-right">
                                    <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                                    <span id="num">{{Cart::count()}}</span>
                                </a>
                                <div id="cart-wp" class="fl-right">
                                    <a href="{{route('cart')}}" style="color:white">
                                        <div id="btn-cart">
                                            <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                                            <span id="num">{{Cart::count()}}</span>
                                        </div>
                                    </a>
                                    <div id="dropdown">
                                        <a href="{{route('cart')}}"><p class="desc">Có <span>{{Cart::count()}} sản phẩm</span> trong giỏ hàng</p></a>
                                        <dic class="action-cart clearfix">
                                            <a href="{{route('cart')}}" title="Giỏ hàng" class="view-cart fl-left">Giỏ hàng</a>
                                            <a href="{{route('checkout')}}" title="Thanh toán" class="checkout fl-right">Thanh toán</a>
                                        </dic>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
