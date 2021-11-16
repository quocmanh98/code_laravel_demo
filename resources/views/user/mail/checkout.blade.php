
@php
    use Carbon\Carbon;
    use Illuminate\Support\Str;
@endphp
<div style="background-color:#ffffff;color:#000000">
    <div style="margin:0px auto;width:600px">
    <div style="padding:30px 20px">
                            <table align="center" bgcolor="#dcf0f8" border="0" cellpadding="0" cellspacing="0" style="margin:0;padding:0;background-color:#ffffff;width:100%!important;font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444;line-height:18px" width="100%">
                                <tbody>
                                    <tr>
                                        <td>
                                        <h1 style="font-size:17px;font-weight:bold;color:#444;padding:0 0 5px 0;margin:0">Cảm ơn quý khách {{session('customer_fullname')}} đã đặt hàng tại Ismart</h1>

                                        <p style="margin:4px 0;font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444;line-height:18px;font-weight:normal"> Ismart rất vui thông báo đơn hàng của quý khách {{session('customer_fullname')}} đã được tiếp nhận và đang trong quá trình xử lý.  Ismart sẽ thông báo đến quý khách ngay khi hàng chuẩn bị được giao.</p>

                                        <h3 style="font-size:13px;font-weight:bold;color:#02acea;text-transform:uppercase;margin:20px 0 0 0;border-bottom:1px solid #ddd">Thông tin mã đơn hàng #{{Str::random(10)}} <span style="font-size:12px;color:#777;text-transform:none;font-weight:normal">({{Carbon::now()}})</span></h3>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444;line-height:18px">
                                        <table border="0" cellpadding="0" cellspacing="0" width="100%">
                                            <thead>
                                                <tr>
                                                    <th align="left" style="padding:6px 9px 0px 9px;font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444;font-weight:bold" width="50%">Thông tin thanh toán</th>
                                                    <th align="left" style="padding:6px 9px 0px 9px;font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444;font-weight:bold" width="50%"> Địa chỉ giao hàng </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td style="padding:3px 9px 9px 9px;border-top:0;font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444;line-height:18px;font-weight:normal" valign="top"><span style="text-transform:capitalize">
                                                    {{$item->tr_fullname}}</span><br>
                                                    <a href="http://quocmanh.fptstore.xyz" target="_blank"> {{$item->tr_email}}</a><br>
                                                    {{$item->tr_phone}}</td>
                                                    <td style="padding:3px 9px 9px 9px;border-top:0;border-left:0;font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444;line-height:18px;font-weight:normal" valign="top"><span style="text-transform:capitalize">{{$item->tr_fullname}}</span><br>
                                                     <a href="http://quocmanh.fptstore.xyz" target="_blank">{{$item->tr_email}}</a><br>
                                                     {{$item->tr_address}}<br>
                                                     T: {{$item->tr_phone}}</td>
                                                </tr>
                                                                                            <tr>
                                                    <td colspan="2" style="padding:7px 9px 0px 9px;border-top:0;font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444" valign="top">
                                                    <p style="font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444;line-height:18px;font-weight:normal">
                                                        <strong>Phương thức thanh toán: </strong>
                                                         @if ( ($item->tr_payment) == 'direct-payment' )
                                                            thanh toán tại cửa hàng
                                                         @else
                                                            thanh toán tại nhà
                                                         @endif<br>
                                                      <strong>Thời gian giao hàng dự kiến:</strong>
                                                       Dự kiến giao hàng vào 17/11/2021 - không giao ngày Chủ Nhật  <br>
                                                     </p>
                                                                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                        <p style="margin:4px 0;font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444;line-height:18px;font-weight:normal"><i>Lưu ý: Đối với đơn hàng đã được thanh toán trước, nhân viên giao nhận có thể yêu cầu người nhận hàng cung cấp CMND / giấy phép lái xe để chụp ảnh hoặc ghi lại thông tin.</i></p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                        <h2 style="text-align:left;margin:10px 0;border-bottom:1px solid #ddd;padding-bottom:5px;font-size:13px;color:#02acea">CHI TIẾT ĐƠN HÀNG</h2>

                                        <table border="0" cellpadding="0" cellspacing="0" style="background:#f5f5f5" width="100%">
                                            <thead>
                                                <tr>
                                                    <th align="left" bgcolor="#02acea" style="padding:6px 9px;color:#fff;font-family:Arial,Helvetica,sans-serif;font-size:12px;line-height:14px">Sản phẩm</th>
                                                    <th align="left" bgcolor="#02acea" style="padding:6px 9px;color:#fff;font-family:Arial,Helvetica,sans-serif;font-size:12px;line-height:14px">Đơn giá</th>
                                                    <th align="left" bgcolor="#02acea" style="padding:6px 9px;color:#fff;font-family:Arial,Helvetica,sans-serif;font-size:12px;line-height:14px">Số lượng</th>
                                                    <th align="left" bgcolor="#02acea" style="padding:6px 9px;color:#fff;font-family:Arial,Helvetica,sans-serif;font-size:12px;line-height:14px">Giảm giá</th>
                                                    <th align="right" bgcolor="#02acea" style="padding:6px 9px;color:#fff;font-family:Arial,Helvetica,sans-serif;font-size:12px;line-height:14px">Tổng tạm</th>
                                                </tr>
                                            </thead>
                                            <tbody bgcolor="#eee" style="font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444;line-height:18px">
                                                @foreach (Cart::content() as $row )
                                                <tr>
                                                    <td align="left" style="padding:3px 9px" valign="top"><span>{{$row->name}}</span><br>
                                                    </td>
                                                    <td align="left" style="padding:3px 9px" valign="top"><span>{{number_format($row->price,'0','','.')}} đ</span></td>
                                                    <td align="left" style="padding:3px 9px" valign="top">{{$row->qty}}</td>
                                                    <td align="left" style="padding:3px 9px" valign="top"><span>0đ</span></td>
                                                    <td align="right" style="padding:3px 9px" valign="top"><span>{{number_format($row->subtotal,'0','','.')}} đ</span></td>
                                                </tr>
                                                @endforeach

                                                                                         </tbody>
                                            <tfoot style="font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444;line-height:18px">											<tr>
                                                    <td align="right" colspan="4" style="padding:5px 9px">Tạm tính</td>
                                                    <td align="right" style="padding:5px 9px"><span>{{Cart::total()}} đ</span></td>
                                                </tr>
                                                                                            <tr>
                                                    <td align="right" colspan="4" style="padding:5px 9px">Phí vận chuyển</td>
                                                    <td align="right" style="padding:5px 9px"><span>50.000đ</span></td>
                                                </tr>
                                                                                            <tr bgcolor="#eee">
                                                    <td align="right" colspan="4" style="padding:7px 9px"><strong><big>Tổng giá trị đơn hàng</big> </strong></td>
                                                    <td align="right" style="padding:7px 9px"><strong><big><span>{{ str_replace('.','',Cart::subtotal()) + 50000 }} đ</span> </big> </strong></td>
                                                </tr>
                                            </tfoot>
                                        </table>

                                        <div style="margin:auto"><a href="http://quocmanh.fptstore.xyz">Chi tiết đơn hàng tại  Ismart</a></div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>&nbsp;
                                        <p style="margin:0;font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444;line-height:18px;font-weight:normal">Trường hợp quý khách có những băn khoăn về đơn hàng, có thể xem thêm mục <a href="http://quocmanh.fptstore.xyz"> <strong>các câu hỏi thường gặp</strong>.</a></p>

                                        <p style="font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444;line-height:18px;font-weight:normal;border:1px #14ade5 dashed;padding:5px;list-style-type:none">Từ ngày 14/10/2021,  Ismart sẽ không gởi tin nhắn SMS khi đơn hàng của bạn được xác nhận thành công. Chúng tôi chỉ liên hệ trong trường hợp đơn hàng có thể bị trễ hoặc không liên hệ giao hàng được.</p>

                                        <p style="margin:10px 0 0 0;font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444;line-height:18px;font-weight:normal">Mọi thắc mắc và góp ý, quý khách vui lòng liên hệ với  Ismart qua <a href="http://quocmanh.fptstore.xyz">http://quocmanh.fptstore.xyz</a>. Đội ngũ  Ismart luôn sẵn sàng hỗ trợ bạn.</p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>&nbsp;
                                        <p>Một lần nữa Ismart cảm ơn quý khách.</p>

                                        <p><strong><a href="http://quocmanh.fptstore.xyz"> Ismart </a> </strong></p>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
    </div>
    </div>
    </div>
