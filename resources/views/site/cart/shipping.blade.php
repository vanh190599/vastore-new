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

    <p class="text-center title-text">Điền thông tin nhận hàng</p>
    <div class="container-fluid">
        <div class="col-lg-3"></div>
        <div class="col-lg-6">
            <form action="{{ route('site.cart.postShipping') }}" method="post">
                @csrf
                <div class="form-group">
                    <label for="">Địa chỉ <span class="text-muted">*</span></label>
                    <input class="form-control input-custom" type="text" name="address" value="{{ old('address', 'Ha Noi' ) }}" placeholder="nhập địa chỉ" id="" required>
                </div>

                <div class="form-group">
                    <label for="">Tên người nhận <span class="text-muted">*</span></label>
                    <input class="form-control input-custom" type="text" name="receive" value="{{ old('required', auth('customers')->user()->name) }}" placeholder="tên người nhận" id="" required>
                </div>

                <div class="form-group">
                    <label for="">Email <span class="text-muted">*</span></label>
                    <input class="form-control input-custom" type="text" name="email" value="{{ old('email', auth('customers')->user()->email) }}" placeholder="email" id="" required>
                    @if(session()->has('error'))
                            <div class="text-danger">{{ session('error') }}</div>
                    @endif
                </div>

                <div class="form-group">
                    <label for="">SDT <span class="text-muted">*</span></label>
                    <input class="form-control input-custom" type="text" name="phone" value="{{ old('phone', 013214654) }}" placeholder="phone" id="" required>
                </div>
                <div class="text-center">
                    <button type="reset" class="btn btn-default">Làm mới</button>
                    <button type="submit" class="btn btn-danger">Đặt hàng</button>
                </div>
            </form>
        </div>
        <div class="col-lg-3"></div>
    </div>

@endsection

@section('custom_css')
    <style>
        .input-custom {
            height: 40px;
            border-radius: none;
        }
    </style>
@endsection

@section('custom_js')
    <script>
        $(document).ready(function (){
            $('[data-toggle="tooltip"]').tooltip();
        })
    </script>
@endsection
