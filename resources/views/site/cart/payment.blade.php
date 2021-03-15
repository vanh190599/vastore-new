@extends('frontend.layout_4')
@section('content')
<div class="text-center" style="padding: 10px; color: #FE980F; font-size: 20px"> <span class="glyphicon glyphicon-shopping-cart"></span> Xem lại giỏ hàng của bạn @if(Cart::content()->count()) ( {{Cart::content()->count()}} )@endif </div>
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
{{--            <th>Xóa</th>--}}
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
                <td style="text-align: center">
                    {{ isset($rows->price)?number_format($rows->price,0,',','.') :'' }} đ
                </td>
                <!-- so luong -->
                <td style="width: 170px; text-align: center;">
                    <form action="{{url('update-cart-qty')}}" method="post">
                        {{ csrf_field() }}
                        <input type="hidden" name="rowId" value="{{isset($rows->rowId)?$rows->rowId:''}}">
                        <input type="number" name="qty"  id="qty" min="1" class="form-control" style=" float: left" value="{{isset($rows->qty)?$rows->qty:''}}" required="Không thể để trống" readonly>
{{--                        <a href="#" style="float: left"><button type="submit" class="btn-sm" style="background: #FE980F; color: white"><span class="glyphicon glyphicon-refresh"></span> Cập nhật</button></a>--}}
                    </form>
                </td>
                <!-- Tong tien -->
                <td class="text-center">
                    <p style="font-size: 17px; ">
                        <b>{{ number_format($rows->price*$rows->qty,0,',','.') }} ₫</b>
                    </p>
                </td>
{{--                <td class="text-center"><a href="{{ url('delete-cart/'.$rows->rowId) }}" data-id="2479395"><i class="glyphicon glyphicon-trash" style="color: red"></i></a></td>--}}
        </tr>
        @endforeach
        </tbody>
        <tfoot>
        <tr>
{{--            <td colspan="7"><a href="{{ url('delete-all-cart') }}" class="btn pull-left" style="background: #FE980F; color:white;"><span class="glyphicon glyphicon-trash"></span> Xóa toàn bộ</a>--}}
{{--                <a href="{{ url('tiep-tuc-mua-hang/') }}" class="button btn pull-right black" style="background: #FE980F; color: white; margin-left: 10px;">Tiếp tục mua hàng</a>--}}
                {{--                        <input type="submit" class="button btn pull-right" style="background: #FE980F; color:white;" value="Cập nhật">--}}
            </td>
        </tr>
        </tfoot>
    </table>
</div>

<div class="pull-right" style="background: #dddddd; padding: 10px">Tổng thanh toán:
    <span style="color: red; font-size: 20px; font-weight: bold">{{ Cart::priceTotal() }} ₫</span>
</div>


<div class="row">
    <div class="col-sm-4"></div>
    <div class="col-sm-4">
        <h3 style="color: orangered; font-size: 19px; padding-bottom:15px">Chọn hình thức thanh toán</h3>
        <form action="{{'save-order'}}" method="post"  >
            {{ csrf_field() }}
            <select name="payment_method" class="form-control">
                <option value="1">Thanh toán khi nhận hàng</option>
                <option value="2">Thanh toán bằng thẻ ATM</option>
            </select>

            <input class="btn btn-danger " type="submit" style="padding: 15px 25px 15px 25px; margin-top: 15px; margin-left: 90px" value="Đặt hàng">
        </form>
    </div>
</div>

@endsection
