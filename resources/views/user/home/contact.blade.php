@extends('layouts.user')
@section('content')
<div id="main-content-wp" class="checkout-page">
    <div class="section" id="breadcrumb-wp">
        <div class="wp-inner">
            <div class="section-detail">
                <ul class="list-item clearfix">
                    <li>
                        <a href="{{url('/')}}" title="">Trang chủ</a>
                    </li>
                    <li>
                        <a href="" title="">Liên hệ</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div id="wrapper" class="wp-inner clearfix">
        <div class="section" id="customer-info-wp" >
            <div class="section-head">
                <h1 class="section-title">Đóng Góp ý kiến của khách hàng</h1>
            </div>
            <div class="section-detail">
                <form method="POST" action="" name="form-checkout">
                    <div class="form-row clearfix">
                        <div class="form-col fl-left">
                            <label for="fullname">Họ tên</label>
                            <input type="text" name="fullname" id="fullname">
                        </div>
                        <div class="form-col fl-right">
                            <label for="email">Email</label>
                            <input type="email" name="email" id="email">
                        </div>
                    </div>
                    <div class="form-row clearfix">
                        <div class="form-col fl-left">
                            <label for="address">Địa chỉ</label>
                            <input type="text" name="address" id="address">
                        </div>
                        <div class="form-col fl-right">
                            <label for="phone">Số điện thoại</label>
                            <input type="tel" name="phone" id="phone">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-col">
                            <label for="notes">Nội dung</label>
                            <textarea name="note"></textarea>
                        </div>
                    </div>
                    <input type="submit" disabled name="btn_submit_crate" id="btn-submit" value="Gửi" style="height: 40px;
                                                                                                border-radius: 60px;
                                                                                                width: 150px;
                                                                                                color: green;
                                                                                                border-color: white;
                                                                                                color: white;
                                                                                                background-color: #48ad48;">
                </form>
            </div>
        </div>
        <div class="section" id="order-review-wp">
            <div class="section-head">
                <h1 class="section-title">Thông tin liên hệ</h1>
            </div>

                    <div class="map">
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3918.347737262346!2d106.76118051411704!3d10.861134060595992!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3175279b31d4725b%3A0x11e0519f6515dd70!2zRMOybmcgVMOqbiBWaeG7h3QgTmFt!5e0!3m2!1svi!2s!4v1634091174648!5m2!1svi!2s" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                  </div>

            <div class="section-detail">
                <table class="shop-table">
                    <thead>
                        <tr>
                            <td>ISMART</td>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="cart-item">
                            <td class="product-name">Phường Linh Trung, Quận Thủ Đức</td>
                        </tr>
                        <tr class="cart-item">
                            <td class="product-name">Mobile: 09616154483</td>
                        </tr>
                        <tr class="order-total">
                            <td><strong class="total-price">Email: quocmanh1998s@gmail.com</strong></td>
                        </tr>
                    </tbody>
                    <tfoot>
                        <tr class="order-total">
                            <td><strong class="total-price">Mạng xã hội</strong></td>
                        </tr>
                        <tr class="order-total">
                        	<td>
                        		<strong class="total-price">
                        			<ul>
										<li style="display: inline-block; padding: 0px 20px; font-size: 50px;">
											<a style="color:gray;" href="https://www.facebook.com/anhtruongnd210198/"><i class="fa fa-facebook"></i></a>
										</li >
										<li style="display: inline-block;padding: 0px 20px;font-size: 50px;">
											<a style="color:gray;" href="#"><i class="fa fa-twitter"></i></a>
										</li>
										<li style="display: inline-block;padding: 0px 20px;font-size: 50px;">
											<a style="color:gray;" href="#"><i class="fa fa-google-plus"></i></a>
										</li>
										<li style="display: inline-block;padding: 0px 20px;font-size: 50px;">
											<a style="color:gray;" href="https://www.youtube.com/watch?v=di7QjvmmNGg"><i  class="fa fa-youtube"></i></a>
										</li>
									</ul>
                        		</strong>
                        	</td>

                        </tr>

                    </tfoot>
                </table>

            </div>
        </div>
    </div>
</div>

@endsection

