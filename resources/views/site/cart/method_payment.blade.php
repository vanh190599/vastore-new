@extends('site.layout.main')
@section('title')
    <title>Giỏ hàng</title>
@endsection
@section('content')
    <style>
        .title-text {
            color: orangered;
            font-weight: 700;
            font-size: 18px;
        }
    </style>

    <div class="container-fluid">

        <div class="row">
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Ảnh</th>
                    <th>Tên sản phẩm</th>
                    <th>Giá</th>
                    <th>Số lượng</th>
                    <th>Tổng</th>
                </tr>
                </thead>

                <tbody>
                @if(!empty($data))
                    @php $stt = 1 @endphp
                    @foreach($data as $key => $value)
                        <tr>
                            <td>{{ $stt++ }}</td>
                            <td><img src="{{$value->model->image}}" alt="" width="100px" height="100px" style="object-fit: cover"></td>
                            <td>{{ $value->name }}</td>
                            <td>{{ number_format($value->price) }} đ </td>
                            <td>
                                {{ $value->qty }}
                            </td>
                            <td>{{ number_format($value->price * $value->qty)  }} đ </td>
                        </tr>
                    @endforeach
                @endif
                <tr>
                    <td colspan="7" class="text-right">
                        <span style="font-size: 20px">Thành tiền: <span class="text-danger">{{ Cart::subtotal() }} đ</span>  </span>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>

        <div class="row">
            <div class="col-lg-3"></div>
            <div class="col-lg-6">
                <p class="text-center title-text">Hình thức thanh toán</p>
                <div class="form-group">
                    <label for="">Vui lòng chọn hình thức thanh toán</label>
                    <div class="radio">
                        <label><input id="pay" type="radio" name="optradio" checked>Thanh toán bằng tiền mặt</label>
                    </div>
                    <div class="radio">
                        <label><input id="online" type="radio" name="optradio">Thanh toán qua chuyển khoản (VNPay)</label>
                    </div>
                </div>
                <hr>
                <div>
                    <div class="text-center">
                        <a href="{{ route('site.cart.postShipping') }}" class="btn btn-danger btn-lg btn-1">Đặt hàng</a>
                    </div>
                    <br>
                    <div class="text-center">
                        <a href="{{ route('site.linkToVNPay') }}" class="btn btn-success btn-lg btn-2">Thanh thanh toán qua VN Pay</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-3"></div>
        </div>

    </div>
@endsection

@section('custom_js')
    <script>
        $('.btn-2').hide()
        $('#pay').on('click', function (){
            $('.btn-1').show()
            $('.btn-2').hide()
        })
        $('#online').on('click', function (){
            $('.btn-1').hide()
            $('.btn-2').show()
        })
    </script>
@endsection

@section('custom_css')
    <style>
        .input-custom {
            height: 40px;
            border-radius: 0 !important;
            background: #F0F0E9;
        }
        .textarea-custom {
            border-radius: 0 !important;
            background: #F0F0E9;
        }
        .text-danger {
            color: red;
        }
    </style>
@endsection


