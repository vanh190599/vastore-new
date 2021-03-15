@extends('frontend.layout_4')
@section('content')

<!--    --><?php
//        echo "<pre>";
//            print_r(Cart::content());
//        echo "</pre>";
//    ?>
    @if(session('order-message'))
        <div style="font-size: 20px; background: #e6e4df; padding: 6px; color: orangered; text-align: center">{{ session('order-message') }}</div>
    @endif
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
                        <a href="{{ url('trang-chu') }}" class="button btn pull-right black" style="background: #FE980F; color: white; margin-left: 10px;">Tiếp tục mua hàng</a>
{{--                        <input type="submit" class="button btn pull-right" style="background: #FE980F; color:white;" value="Cập nhật">--}}
                    </td>
                </tr>
                </tfoot>
            </table>
        </div>

	<section id="do_action">
			<div class="heading">
                @if(session('customer_email') == NULL)
                    <h4 style="color:red; padding-bottom: 7px" class="text-center">Vui lòng đăng nhập để thực hiện thanh toán !</h4>
                @endif
			</div>
			<div class="row">
				<div class="col-sm-6">
					<div class="chose_area">
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
				<div class="col-sm-6">
					<div class="total_area">
						<ul>
                            <li style="color: black">Tổng số lượng mặt hàng mua <span> {{ Cart::count() }}</span></li>
							<li style="color: black">Tổng tiền <span style="font-weight: bold"> {{ Cart::priceTotal() }} </span></li>
							<li style="color: black">Thuế <span>0 đ</span></li>
							<li style="color: black">Phí vận chuyển <span>Miễn phí</span></li>
							<li style="line-height: 30px; color: black">Thành tiền <span style="font-size: 19px; font-weight: bold; color: red;">{{ Cart::priceTotal() }} ₫</span></li>
						</ul>
							<a class="btn btn-default update" href="{{ url('trang-chu') }}">Tiếp tục mua hàng</a>

							<a href="{{ url('show-checkout') }}" class="btn btn-default check_out " style="float: right;" >Thanh toán</a>

                    </div>
				</div>
			</div>
	</section><!--/#do_action-->
    @endsection
