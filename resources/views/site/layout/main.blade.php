<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    @yield('title')

    <base href="{{asset('')}}">
    <link rel="stylesheet" href="eshoper/css/style.css">
    <link href="eshoper/css/bootstrap.min.css" rel="stylesheet">
    <link href="eshoper/css/font-awesome.min.css" rel="stylesheet">
    <link href="eshoper/css/prettyPhoto.css" rel="stylesheet">
    <link href="eshoper/css/price-range.css" rel="stylesheet">
    <link href="eshoper/css/animate.css" rel="stylesheet">
    <link href="eshoper/css/main.css" rel="stylesheet">
    <link href="eshoper/css/responsive.css" rel="stylesheet">
    <!--[if lt IE 9]>
    <script src="eshoper/js/html5shiv.js"></script>
    <script src="eshoper/js/resnews_imagepond.min.js"></script>
    <![endif]-->
    <link rel="shortcut icon" href="{{ asset('eshoper/images/logo.jpg') }}">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="eshoper/images/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="eshoper/images/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="eshoper/images/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="eshoper/images/ico/apple-touch-icon-57-precomposed.png">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    <link rel="stylesheet" href="{{ asset('lib/carousel/carousel.css') }}">
    <link rel="stylesheet" href="{{ asset('lib/carousel/them.css') }}">
{{--    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" integrity="sha512-tS3S5qG0BlhnQROyJXvNjeEM4UpMXHrQfTGmbQ1gKmelCxlSEBUaxhRBj/EFTzpbP4RVSrpEikbmdJobCvhE3g==" crossorigin="anonymous" />--}}
{{--    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.css" integrity="sha512-OTcub78R3msOCtY3Tc6FzeDJ8N9qvQn1Ph49ou13xgA9VsH9+LRxoFU6EqLhW4+PKRfU+/HReXmSZXHEkpYoOA==" crossorigin="anonymous" />--}}
</head><!--/head-->

<body>

<style>
    @media (min-width: 1388px){
        .container-fluid {
            max-width: 1388px;
        }
    }

    #myCarousel .active {
        margin-left: -98px !important;
    }

</style>

@include('site.layout.header')

@yield('slide')

<div style="width: 100%; margin-top: 30px">
    <div class="container-fluid" s style="margin: auto">
        <div class="row">
            <div class="col-sm-3">
                <div class="left-sidebar">
                    <div class="brands_products"><!--products-->
                        <h2 style="color: orangered">Thương hiệu</h2>
                        <div class="">
                            <ul class="list-group" style="border-bottom: 2px solid #dddddd">
                                @if(!empty($data_brand))
                                    @foreach($data_brand as $k => $v)
                                        <li class="">
                                            <a class="list-group-item text-dark" style="color: #111111; border-bottom: none ;border-radius: 0; padding-left: 30px"
                                               href="{{ route('site.list.index', ['brand_id'=>$v->id]) }}">
                                                {{ $v->name }}</a>
                                        </li>
                                    @endforeach
                                @endif
                            </ul>
                        </div>
                    </div><!--/products-->

                    <div class="brands_products"><!--products-->
                        <h2 style="color: orangered">SẢN PHẨM</h2>
                        <div class="">
                            <ul class="list-group" style="border-bottom: 2px solid #dddddd">
                                <li class="">
                                    <a class="list-group-item text-dark" style="color: #111111; border-bottom: none ;border-radius: 0; padding-left: 30px"
                                       href="{{ route('site.list.index', ['type'=>1]) }}">
                                        Mới nhất</a>
                                    <a class="list-group-item text-dark" style="color: #111111; border-bottom: none ;border-radius: 0; padding-left: 30px"
                                       href="{{ route('site.list.index', ['type'=>2]) }}">
                                        Bán chạy</a>
                                    <a class="list-group-item text-dark" style="color: #111111; border-bottom: none ;border-radius: 0; padding-left: 30px"
                                       href="{{ route('site.list.index', ['type'=>3]) }}">
                                        Khuyến mãi</a>
                                </li>
                            </ul>
                        </div>
                    </div><!--/products-->

                   {{-- <div class="brands_products"><!--products-->
                        <h2 style="color: orangered">Danh mục</h2>
                        <div class="">
                            <ul class="list-group" style="border-bottom: 2px solid #dddddd">
                                <li class=""><a class="list-group-item text-dark"  style="color: #111111; border-bottom: none ;border-radius: 0; padding-left: 30px  " href="">Sản phẩm mới</a></li>
                                <li class=""><a class="list-group-item text-dark"  style="color: #111111; border-bottom: none ;border-radius: 0; padding-left: 30px  " href="">Bán chạy</a></li>
                                <li class=""><a class="list-group-item text-dark"  style="color: #111111; border-bottom: none ;border-radius: 0; padding-left: 30px  " href="">Ưu đãi, khuyến mãi</a></li>
                            </ul>
                        </div>
                    </div><!--/products-->

                    <div class="brands_products"><!--products-->
                        <h2 style="color: orangered">sản phẩm</h2>
                        <div class="">
                            <ul class="list-group" style="border-bottom: 2px solid #dddddd">
                                <li class=""><a class="list-group-item text-dark"  style="color: #111111; border-bottom: none ;border-radius: 0; padding-left: 30px  " href="">Sản phẩm mới</a></li>
                                <li class=""><a class="list-group-item text-dark"  style="color: #111111; border-bottom: none ;border-radius: 0; padding-left: 30px  " href="">Bán chạy</a></li>
                                <li class=""><a class="list-group-item text-dark"  style="color: #111111; border-bottom: none ;border-radius: 0; padding-left: 30px  " href="">Ưu đãi, khuyến mãi</a></li>
                            </ul>
                        </div>
                    </div><!--/products-->--}}
                </div><!--/products-->

                <iframe width="100%" height="auto" src="https://www.youtube.com/embed/aQCdueuaiwE" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>

                <iframe width="100%" height="auto" src="https://www.youtube.com/embed/JPB4mb3nnCY" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>

                <div class="shipping text-center"><!--shipping-->
                    <img src="eshoper/images/home/shipping.jpg" alt="" />
                </div><!--/shipping-->

            </div>
            <div class="col-sm-9 padding-right">
                <!-- content-->
            @yield('content')
            <!-- content -->
            </div>
        </div>
    </div>
</div>


</div>


@include('site.layout.footer')



<script src="eshoper/js/jquery.js"></script>
<script src="eshoper/js/bootstrap.min.js"></script>
<script src="eshoper/js/jquery.scrollUp.min.js"></script>
<script src="eshoper/js/price-range.js"></script>
<script src="eshoper/js/jquery.prettyPhoto.js"></script>
<script src="eshoper/js/main.js"></script>

{{--<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.js" integrity="sha512-gY25nC63ddE0LcLPhxUJGFxa2GoIyA5FLym4UJqHDEMHjp8RET6Zn/SHo1sltt3WuVtqfyxECP38/daUc/WVEA==" crossorigin="anonymous"></script>--}}

<script src="{{ asset('lib/carousel/carousel.js') }}"></script>

@yield('custom_js')

</body>
</html>

