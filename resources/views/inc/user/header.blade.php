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
                            <a href="" title="" id="payment-link" class="fl-left">H??nh th???c thanh to??n</a>
                            <div id="main-menu-wp" class="fl-right">
                                <ul id="main-menu" class="clearfix">
                                    <li>
                                        <a href="{{url('/')}}" title="">Trang ch???</a>
                                    </li>
                                    <li>
                                        <a href="{{route('product.index')}}" title="">S???n ph???m</a>
                                    </li>
                                    <li>
                                        <a href="{{route('blog')}}" title="">B??i Vi???t</a>
                                    </li>
                                    @if (session('customer_fullname'))
                                    <li>
                                        <a href="{{url('/')}}" title=""> Xin ch??o: {{session('customer_fullname')}}</a>
                                    </li>
                                    <li>
                                        <a href="{{route('home.info')}}" title="">Info</a>
                                    </li>
                                    <li>
                                        <a href="{{route('home.edit')}}" title="">Edit Profile</a>
                                    </li>
                                    <li>
                                        <a href="{{route('home.handle.logout')}}" title="">Tho??t</a>
                                    </li>
                                    @else
                                    <li>
                                        <a href="{{route('home.login')}}" title="">????ng nh???p</a>
                                    </li>
                                    <li>
                                        <a href="{{route('home.register')}}" title="">????ng k??</a>
                                    </li>
                                    <li>
                                        <a href="{{route('home.forgot')}}" title="">Qu??n M???t Kh???u</a>
                                    </li>
                                    @endif
                                    <li>
                                        <a href="{{route('contact')}}" title="">Li??n h???</a>
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
                                    <input type="text" name="s" id="s" placeholder="T??m ki???m s???n ph???m t???i ????y !">
                                    <button type="submit" id="sm-s">T??m ki???m</button>
                                </form>
                            </div>
                            <div id="action-wp" class="fl-right">
                                <div id="advisory-wp" class="fl-left">
                                    <span class="title">T?? v???n</span>
                                    <span class="phone">0987.654.321</span>
                                </div>
                                <div id="btn-respon" class="fl-right"><i class="fa fa-bars" aria-hidden="true"></i></div>
                                <a href="{{route('cart')}}" title="gi??? h??ng" id="cart-respon-wp" class="fl-right">
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
                                        <a href="{{route('cart')}}"><p class="desc">C?? <span>{{Cart::count()}} s???n ph???m</span> trong gi??? h??ng</p></a>
                                        <dic class="action-cart clearfix">
                                            <a href="{{route('cart')}}" title="Gi??? h??ng" class="view-cart fl-left">Gi??? h??ng</a>
                                            <a href="{{route('checkout')}}" title="Thanh to??n" class="checkout fl-right">Thanh to??n</a>
                                        </dic>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
