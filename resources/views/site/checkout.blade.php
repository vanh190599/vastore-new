@extends('frontend.layout_4')
@section('content')

	<section id="cart_items">
            <div class="text-center" style="padding: 2px; color: #FE980F; font-size: 20px"> <span class="glyphicon glyphicon-shopping-cart"></span> Thanh toán giỏ hàng </div>
            <div class="text-center" style="padding: 10px; color: #FE980F; font-size: 20px"></span>
                @if(session('thanks')) {{ session('thanks') }} @endif
            </div>

			<div style="font-size: 17xp; background: #dddddd; padding: 10px">
                Để tiếp tục đặt hàng, quý khách vui lòng nhập thông tin bên dưới
            </div>
        <div class="text-center text-info" style="padding: 10px; font-size: 20px"></span>
            @if(session('thanks')) {{ session('thanks') }} @endif
        </div>

        <div class="shopper-informations">
				<div class="row">
					<div class="col-sm-5 clearfix">
						<div class="bill-to">
							<p style="color: #222222; font-size: 25px;">Điền thông tin nhận hàng</p>
							<div class="form-two" style="width: 100%">
								<form action="{{ url('save-checkout-customer') }}" method="post">
                                    {{ csrf_field() }}
                                    <span style="font-size: 16px; color: #222222 "><b>Họ và tên *</b></span>
									<input type="text" name="shipping_name" value="@if(session('shipping_name')) {{ session('shipping_name') }} @endif" placeholder="Họ tên người nhận">

                                    <span style="font-size: 16px; color: #222222 "><b>Số điện thoại *</b></span>
                                    <input type="text" name="shipping_phone" placeholder="Dùng để liên lạc khi giao hàng" value="@if(session('shipping_phone')) {{ session('shipping_phone') }} @endif">

                                    <span style="font-size: 16px; color: #222222 "><b>Email (Vui lòng điền chính xác)*</b></span>
                                    <input type="email" name="shipping_email" placeholder="để nhận thông báo đơn hàng" value="@if(session('shipping_email')) {{ session('shipping_email') }} @endif" placeholder="Họ tên người nhận">

                                    <span style="font-size: 16px; color: #222222 "><b>Địa chỉ *</b></span>
									<input type="text" name="shipping_address" placeholder="Địa chỉ nhận hàng" value="@if(session('shipping_address')) {{ session('shipping_address') }} @endif">

                                    <span style="font-size: 16px; color: #222222 "><b>Ghi chú</b></span>
                                    <textarea name="shipping_note" id="" style="background: none; border: 1px solid #dddddd" cols="30" rows="7" placeholder="Ghi chú thông tin viết hóa đơn, yêu cầu lắp đặt...">@if(session('shipping_note')) {{ session('shipping_note') }} @endif</textarea>
                                    <input type="submit" value="Gửi" class="btn"  style="background: #FE980F; color: white; margin-top: 10px " name="" id="">
                                </form>
							</div>
						</div>
					</div>
					<div class="col-sm-7">
                        <div class="text-center" style="color: #222222; font-size: 25px;">Thanh toán qua ngân hàng</div>
                        <p>Tổng cộng: <span style="color: #EE0000; font-size: 19px"> <b>149.0000</b></span></p>
                        <p>- Quý khách hàng thực hiện việc chuyển khoản qua ngân hàng tổng số tiền mua hàng</p>
                        <p>- Tên tài khoản: <span><b>Văn Anh VAstore</b></span></p>
                        <table border="1" cellpadding="5" style="border-colappse:collapse; border-color: #dddddd">
                            <tr>
                                <th class="text-center">Tên ngân hàng</th>
                                <th class="text-center">Địa chỉ</th>
                                <th class="text-center" >Số tài khoản</th>
                            </tr>
                            <tr>
                                <td>Ngân hàng TMCP Đầu tư và phát triển Việt Nam ( <b>BIDV</b> )</td>
                                <td>Chi nhánh Hồ Tùng Mậu</td>
                                <td class="text-center">123-2345-345-345-2345</td>
                            </tr>
                            <tr>
                                <td>Ngân hàng TMCP Kỹ thương Việt Nam ( <b>Techcombank</b>)</td>
                                <td>Chi nhánh Hồ Tùng Mậu</td>
                                <td class="text-center">123-2345-345-345-2345</td>
                            </tr>
                                <td>Ngân hàng TMCP Đầu tư và phát triển Việt Nam ( <b>BIDV</b>)</td>
                                <td>Chi nhánh Hồ Tùng Mậu</td>
                                <td class="text-center">123-2345-345-345-2345</td>
                            </tr>
                            </tr>
                                <td>Ngân hàng TMCP Đầu tư và phát triển Việt Nam ( <b>BIDV</b>)</td>
                                <td>Chi nhánh Hồ Tùng Mậu</td>
                                <td class="text-center">123-2345-345-345-2345</td>
                            </tr>
                        </table>

                        <div class="chose_area" style="border: 1px solid #dddddd; margin-top: 25px; padding-top: 20px">
                            <ul class="user_option">
                                <li style="color: black; line-height: 30px">
                                    <span class="glyphicon glyphicon-map-marker"></span>
                                    <label style="color: black">Địa chỉ: Nguyên Xá, Minh Khai, Bắc Từ Liêm, Hà Nội</label>
                                </li>
                                <li style="color: black ; line-height: 30px">
                                    <span  class="glyphicon glyphicon-envelope"></span>
                                    <label style="color: black">Email: anh195np@gmail.com</label>
                                </li>
                                <li style="line-height: 30px">
                                    <span style="color: black" class="glyphicon glyphicon-phone-alt"></span>
                                    <label style="color: black">Liên hệ: 0843.189.000 (Nguyễn Văn Anh)</label>
                                </li>
                            </ul>
                        </div>
                    </div>
				</div>
			</div>

        <div class="review-payment">
				<h2 style="color: #222222">Xem lại giỏ hàng của bạn</h2>
			</div>

        <div class="text-center" style="padding: 10px; color: #FE980F; font-size: 20px"> <span class="glyphicon glyphicon-shopping-cart"></span> Giỏ hàng @if(Cart::content()->count()) ( {{Cart::content()->count()}} )@endif </div>
        <div class="table-responsive">
            <table class="table table-cart" border="1" style="border: 1px solid #dddddd">
                <thead>
                <tr style="background: #FE980F; color:white;">
                    <th>STT</th>
                    <th class="image text-center" style="width: 120px">Ảnh</th>
                    <th class="name text-center">Tên sản phẩm</th>
                    <th class="price text-center">Giá bán lẻ</th>
                    <th class="quantity text-center" >Số lượng</th>
                    <th class="price text-center">Tổng tiền</th>
                    <th>Xóa</th>
                </tr>
                </thead>
                <tbody>
                <?php $i=1; ?>
                <tr>
                    @foreach($content as $rows)
                        <td class="text-center ">{{$i++}}</td>
                        <!-- Anh -->
                        <td><img style="width: 100px; height: 100px;" src="{{asset('upload/product/'.$rows->options->image)}}" class="" /></td>
                        <!-- ma san pham -->
                        <td>
                            <a href="">
                                <p><a href=""> {{isset($rows->name)?$rows->name:''}} </a></p>
                                <p style="color: red">MSP: {{isset($rows->id)?$rows->id:''}} </p>
                            </a>
                        </td>
                        <!-- Gia ban le -->
                        <td>
                            {{ isset($rows->price)?number_format($rows->price,0,',','.') :'' }}
                        </td>
                        <!-- so luong -->
                        <td style="width: 170px;">
                            <form action="{{url('update-cart-qty')}}" method="post">
                                {{ csrf_field() }}
                                <input type="hidden" name="rowId" value="{{isset($rows->rowId)?$rows->rowId:''}}">
                                <input type="number" name="qty"  id="qty" min="1" class="form-control" style="width: 65px; float: left" value="{{isset($rows->qty)?$rows->qty:''}}" required="Không thể để trống">
                                <a href="#" style="float: left"><button type="submit" class="btn-sm" style="background: #FE980F; color: white"><span class="glyphicon glyphicon-refresh"></span> Cập nhật</button></a>
                            </form>
                        </td>
                        <!-- Tong tien -->
                        <td class="text-center">
                            <p style="font-size: 17px; width: 120px">
                                <b>{{ number_format($rows->price*$rows->qty,0,',','.') }} ₫</b>
                            </p>
                        </td>
                        <td class="text-center"><a href="{{ url('delete-cart/'.$rows->rowId) }}" data-id="2479395"><i class="glyphicon glyphicon-trash" style="color: red"></i></a></td>
                </tr>
                @endforeach
                </tbody>
                <tfoot>
                <tr>
                    <td colspan="7"><a href="{{ url('delete-all-cart') }}" class="btn pull-left" style="background: #FE980F; color:white;"><span class="glyphicon glyphicon-trash"></span> Xóa toàn bộ</a>
                        <a href="{{ url('tiep-tuc-mua-hang/') }}" class="button btn pull-right black" style="background: #FE980F; color: white; margin-left: 10px;">Tiếp tục mua hàng</a>
                        {{--                        <input type="submit" class="button btn pull-right" style="background: #FE980F; color:white;" value="Cập nhật">--}}
                    </td>
                </tr>
                </tfoot>
            </table>
        </div>
        <section id="do_action">
            <div class="row">
                <div class="col-sm-6">
{{--                    <div class="chose_area">--}}
{{--                        <ul class="user_option">--}}
{{--                            <li style="color: black; line-height: 30px">--}}
{{--                                <span class="glyphicon glyphicon-map-marker"></span>--}}
{{--                                <label style="color: black">Địa chỉ: Nguyên Xá, Minh Khai, Bắc Từ Liêm, Hà Nội</label>--}}
{{--                            </li>--}}
{{--                            <li style="color: black ; line-height: 30px">--}}
{{--                                <span  class="glyphicon glyphicon-envelope"></span>--}}
{{--                                <label style="color: black">Email: anh195np@gmail.com</label>--}}
{{--                            </li>--}}
{{--                            <li style="line-height: 30px">--}}
{{--                                <span style="color: black" class="glyphicon glyphicon-phone-alt"></span>--}}
{{--                                <label style="color: black">Liên hệ: 0843.189.000 (Nguyễn Văn Anh)</label>--}}
{{--                            </li>--}}
{{--                        </ul>--}}
{{--                    </div>--}}
                </div>
                <div class="col-sm-6">
                    <div class="total_area">
                        <ul>
                            <li style="color: black">Tổng số lượng mặt hàng mua <span> {{ Cart::count() }}</span></li>
                            <li style="color: black">Tổng tiền <span style="font-weight: bold"> {{ Cart::priceTotal() }} </span></li>
                            <li style="color: black">Thuế <span>0 đ</span></li>
                            <li style="color: black">Phí vận chuyển <span>Miễn phí</span></li>
                            <li style="line-height: 30px; color: black">Thành tiền <span style="font-size: 19px; font-weight: bold; color: red;">{{ Cart::priceTotal() }} ₫</span></li>
                        </ul>
                        <a href="{{ url('login-checkout') }}" class="btn btn-default check_out " style="float: right" >Thanh toán</a>
                    </div>
                </div>
            </div>
	</section> <!--/#cart_items-->


    @endsection
