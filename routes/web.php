<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'laravel-filemanager'], function () {
    \UniSharp\LaravelFilemanager\Lfm::routes();
});

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/demo/{id}', 'HomeController@demo')->name('home.demo');
// USER
Route::get('/', 'HomeController@index')->name('home.user');

Route::get('/bai-viet', 'BlogController@index')->name('blog');
Route::get('/bai-viet-chi-tiet/{slug}.html', 'BlogController@detail')->name('blog.detail');

Route::get('/san-pham', 'ProductController@index')->name('product.index');
Route::get('/san-pham-chi-tiet/{slug}.html', 'ProductController@detail')->name('product.detail');
Route::get('/danh-muc-san-pham/{slug}', 'ProductController@category')->name('product.category');

Route::get('/gio-hang', 'CartController@index')->name('cart');
Route::post('/gio-hang/update', 'CartController@update')->name('cart.update');
Route::get('/gio-hang/destroy', 'CartController@destroy')->name('cart.destroy');
Route::get('/gio-hang/add/{id}', 'CartController@add')->name('cart.add');
Route::get('/gio-hang/remove/{rowId}', 'CartController@remove')->name('cart.remove');
Route::get('/thanh-toan', 'CartController@checkout')->name('checkout');
Route::post('/saveInfoCart', 'CartController@saveInfoCart')->name('saveInfoCart');

Route::get('/lich-su-don-hang', 'CartController@OrderHistory')->name('user.order.history');
Route::get('/don-hang-chi-tiet/{id}', 'CartController@DetailHistory')->name('user.detail.history');
Route::get('/xoa-don-hang/{id}', 'CartController@DeleteHistory')->name('user.delete.history');
Route::get('/huy-don-hang/{id}', 'CartController@CancelHistory')->name('user.cancel.history');

Route::get('/gioi-thieu', 'HomeController@about')->name('about');
Route::get('/lien-he', 'HomeController@contact')->name('contact');

Route::get('/tai-khoan', 'AccountController@index')->name('account');
Route::get('/trang-chu/dang-nhap', 'AccountController@login')->name('home.login');
Route::get('/trang-chu/quen-mat-khau', 'AccountController@forgot')->name('home.forgot');
Route::get('/trang-chu/dang-ky', 'AccountController@register')->name('home.register');
Route::get('/trang-chu/thay-doi-mat-khau', 'AccountController@changePassword')->name('home.changePassword');
Route::get('/trang-chu/thong-tin-ca-nhan', 'AccountController@info')->name('home.info');
Route::get('/trang-chu/sua-thong-tin-ca-nhan', 'AccountController@edit')->name('home.edit');

// Xử lý đăng nhâp đăng ký ......
Route::post('/handle/register', 'HandleController@register')->name('home.handle.register');
Route::post('/handle/login', 'HandleController@login')->name('home.handle.login');
Route::get('/handle/logout', 'HandleController@logout')->name('home.handle.logout');
Route::post('/handle/forgot', 'HandleController@forgot')->name('home.handle.forgot');
Route::post('/handle/edit', 'HandleController@edit')->name('home.handle.edit');


Route::get('/demo/sendmail', 'DemoController@sendmail')->name('sendmail');

Auth::routes(['verify' => true]);

Route::get('/trang-chu', 'HomeController@index')->name('home')->middleware('verified');

// Route::get('admin/{age}',function(){

//     return view('admin.home.dashboard');

// })->middleware('CheckAge');

// Route::get('/admin/{age}', 'AdminController@index')->middleware('CheckAge');
// Route::get('/admin/{age}', 'AdminController@index')->middleware('auth', 'CheckRole');

Route::middleware(['auth', 'CheckRole'])->group(function () {
    Route::get('/admin/login', 'AdminController@login')->name('admin.login');
    Route::get('/admin/index', 'AdminController@index')->name('admin.index');
    Route::get('/admin', 'AdminController@index')->name('admin.index');
    // 5. Post
    Route::get('/admin/post/create', 'AdminPostController@create')->name('admin.post.create');
    Route::get('/admin/post/list', 'AdminPostController@index')->name('admin.post.list');
    Route::post('/admin/post/store', 'AdminPostController@store')->name('admin.post.store');
    Route::get('/admin/post/edit/{id}', 'AdminPostController@edit')->name('admin.post.edit');
    Route::post('/admin/post/update/{id}', 'AdminPostController@update')->name('admin.post.update');
    Route::get('/admin/post/destroy/{id}', 'AdminPostController@destroy')->name('admin.post.destroy');
    Route::get('/admin/post/show/{id}', 'AdminPostController@show')->name('admin.post.detail');
    Route::post('/admin/post/action', 'AdminPostController@action')->name('admin.post.action');
    Route::get('/admin/post/active/{id}', 'AdminPostController@active')->name('admin.post.active');
    Route::get('/admin/post/unactive/{id}', 'AdminPostController@unactive')->name('admin.post.unactive');

    // 1. Category Product
    Route::get('/admin/cat/product/create', 'AdminCatProductController@create')->name('admin.cat.product.create');
    Route::get('/admin/cat/product/list', 'AdminCatProductController@index')->name('admin.cat.product.list');
    Route::post('/admin/cat/producct/store', 'AdminCatProductController@store')->name('admin.cat.product.store');
    Route::get('/admin/cat/product/edit/{id}', 'AdminCatProductController@edit')->name('admin.cat.product.edit');
    Route::post('/admin/cat/product/update/{id}', 'AdminCatProductController@update')->name('admin.cat.product.update');
    Route::get('/admin/cat/product/destroy/{id}', 'AdminCatProductController@destroy')->name('admin.cat.product.destroy');
    Route::get('/admin/cat/product/show/{id}', 'AdminCatProductController@show')->name('admin.cat.product.detail');
    Route::get('/admin/cat/product/active/{id}', 'AdminCatProductController@active')->name('admin.cat.product.active');
    Route::get('/admin/cat/product/unactive/{id}', 'AdminCatProductsController@unactive')->name('admin.cat.product.unactive');
    Route::post('/admin/cat/product/action', 'AdminCatProductController@action')->name('admin.cat.product.action');

    // 2. Category Post
    Route::get('/admin/cat/post/create', 'AdminCatPostController@create')->name('admin.cat.post.create');
    Route::get('/admin/cat/post/ist', 'AdminCatPostController@index')->name('admin.cat.post.list');
    Route::post('/admin/cat/poststore', 'AdminCatPostController@store')->name('admin.cat.post.store');
    Route::get('/admin/cat/post/edit/{id}', 'AdminCatPostController@edit')->name('admin.cat.post.edit');
    Route::post('/admin/cat/post/update/{id}', 'AdminCatPostController@update')->name('admin.cat.post.update');
    Route::get('/admin/cat/post/destroy/{id}', 'AdminCatPostController@destroy')->name('admin.cat.post.destroy');
    Route::get('/admin/cat/post/show/{id}', 'AdminCatPostController@show')->name('admin.cat.post.detail');
    Route::get('/admin/cat/post/active/{id}', 'AdminCatPostController@active')->name('admin.cat.post.active');
    Route::get('/admin/cat/post/unactive/{id}', 'AdminCatPostController@unactive')->name('admin.cat.post.unactive');
    Route::post('/admin/cat/post/action', 'AdminCatPostController@action')->name('admin.cat.post.action');

    // 3. Customer
    Route::get('/admin/customer/create', 'AdminCustomerController@create')->name('admin.customer.create');
    Route::get('/admin/customer/list', 'AdminCustomerController@index')->name('admin.customer.list');
    Route::post('/admin/customer/store', 'AdminCustomerController@store')->name('admin.customer.store');
    Route::get('/admin/customer/edit/{id}', 'AdminCustomerController@edit')->name('admin.customer.edit');
    Route::post('/admin/customer/update/{id}', 'AdminCustomerController@update')->name('admin.customer.update');
    Route::get('/admin/customer/destroy/{id}', 'AdminCustomerController@destroy')->name('admin.customer.destroy');
    Route::get('/admin/customer/show/{id}', 'AdminCustomerController@show')->name('admin.customer.detail');
    Route::get('/admin/customer/demo', 'AdminCustomerController@demo')->name('admin.customer.demo');
    Route::post('/admin/customer/action', 'AdminCustomerController@action')->name('admin.customer.action');


    // 4. Product
    Route::get('/admin/product/create', 'AdminProductController@create')->name('admin.product.create');
    Route::get('/admin/product/list', 'AdminProductController@index')->name('admin.product.list');
    Route::post('/admin/product/store', 'AdminProductController@store')->name('admin.product.store');
    Route::get('/admin/product/edit/{id}', 'AdminProductController@edit')->name('admin.product.edit');
    Route::post('/admin/product/update/{id}', 'AdminProductController@update')->name('admin.product.update');
    Route::get('/admin/product/destroy/{id}', 'AdminProductController@destroy')->name('admin.product.destroy');
    Route::get('/admin/product/show/{id}', 'AdminProductController@show')->name('admin.product.detail');
    Route::post('/admin/product/action', 'AdminProductController@action')->name('admin.product.action');
    Route::get('/admin/product/active/{id}', 'AdminProductController@active')->name('admin.product.active');
    Route::get('/admin/product/unactive/{id}', 'AdminProductController@unactive')->name('admin.product.unactive');
    Route::post('/admin/product/action', 'AdminProductController@action')->name('admin.product.action');


    // Order
    Route::get('/admin/order/create', 'AdminOrderController@create')->name('admin.order.create');
    Route::get('/admin/order/list', 'AdminOrderController@index')->name('admin.order.list');
    Route::post('/admin/order/store', 'AdminOrderController@store')->name('admin.order.store');
    Route::get('/admin/order/edit/{id}', 'AdminOrderController@edit')->name('admin.order.edit');
    Route::post('/admin/order/update/{id}', 'AdminOrderController@update')->name('admin.order.update');
    Route::get('/admin/order/destroy/{id}', 'AdminOrderController@destroy')->name('admin.order.destroy');
    Route::get('/admin/order/show/{id}', 'AdminOrderController@show')->name('admin.order.detail');

    // Admin
    Route::get('/admin/user/create', 'AdminUserController@create')->name('admin.user.create');
    Route::get('/admin/user/list', 'AdminUserController@index')->name('admin.user.list');
    Route::post('/admin/user/store', 'AdminUserController@store')->name('admin.user.store');
    Route::get('/admin/user/edit/{id}', 'AdminUserController@edit')->name('admin.user.edit');
    Route::post('/admin/user/update/{id}', 'AdminUserController@update')->name('admin.user.update');
    Route::get('/admin/user/destroy/{id}', 'AdminUserController@destroy')->name('admin.user.destroy');
    Route::get('/admin/user/show/{id}', 'AdminUserController@show')->name('admin.user.detail');
    Route::get('/admin/user/demo', 'AdminUserController@demo')->name('admin.user.demo');
    Route::post('/admin/user/action', 'AdminUserController@action')->name('admin.user.action');
});
