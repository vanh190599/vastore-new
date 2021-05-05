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
        <div class="col-lg-2"></div>
        <div class="col-lg-8">
            <p class="text-center title-text">Điền thông tin nhận hàng</p>
            <hr>
{{--            <form id="myForm" action="{{ route('site.cart.postShipping') }}" method="post">--}}
            <form id="myForm" action="{{ route('site.cart.pushShipping') }}" method="get">
{{--                @csrf--}}
                <div class="form-group">
                    <label for="">Địa chỉ <span class="text-danger">*</span></label>
                    <input class="form-control input-custom" type="text" name="address" value="{{ old('address', 'Ha Noi' ) }}" placeholder="nhập địa chỉ" id="" required>
                </div>

                <div class="form-group">
                    <label for="">Tên người nhận <span class="text-danger">*</span></label>
                    <input class="form-control input-custom" type="text" name="receive" value="{{ old('required', auth('customers')->user()->name) }}" placeholder="tên người nhận" id="" required>
                </div>

                <div class="form-group">
                    <label for="">Email <span class="text-danger">*</span></label>
                    <input class="form-control input-custom" type="text" name="email" value="{{ old('email', auth('customers')->user()->email) }}" placeholder="email" id="" required>
                    @if(session()->has('error'))
                            <div class="text-danger">{{ session('error') }}</div>
                    @endif
                </div>

                <div class="form-group">
                    <label for="">Số điện thoại liên hệ nhận hàng <span class="text-danger">*</span></label>
                    <input class="form-control input-custom" type="text" name="phone" value="{{ old('phone', 013214654) }}" placeholder="phone" id="" required>
                </div>

                <div class="form-group">
                    <label for="">Ghi chú <span class="text-danger">*</span></label>
                    <textarea class="textarea-custom form-control" placeholder="Ghi chú" name="" id="" cols="30" rows="10"></textarea>
                </div>

                <hr>
                <div class="text-center">
                    <button type="submit" class="btn btn-danger btn-lg">Tiếp tục</button>
                </div>

            </form>
        </div>
        <div class="col-lg-2"></div>
    </div>
@endsection

@section('custom_js')
    <script>
        $('#pay').on('click', function (){

        })

        $('#online').on('click', function (){
            alert(2)
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


