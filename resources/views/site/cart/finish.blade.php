@extends('site.layout.main')
@section('title')
    <title>Giỏ hàng</title>
@endsection
@section('content')
    <style>
        .title-text {

            font-weight: 700;
            font-size: 18px;
        }
    </style>


        <h2 style="color: orangered; text-align: center">
            Đặt hàng thành công, Cảm ơn bạn đã tin mua sản phẩm của chúng tôi,<br> vui lòng kiểm tra Email của bạn!
        </h2>


@endsection

@section('custom_js')
    <script>
        $(document).ready(function (){
            $('[data-toggle="tooltip"]').tooltip();
        })
    </script>
@endsection
