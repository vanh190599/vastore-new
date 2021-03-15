<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Home | E-Shopper</title>

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
    <script src="eshoper/js/respond.min.js"></script>
    <![endif]-->
    <link rel="shortcut icon" href="eshoper/images/ico/favicon.ico">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="eshoper/images/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="eshoper/images/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="eshoper/images/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="eshoper/images/ico/apple-touch-icon-57-precomposed.png">



    <div id="fb-root"></div>
    <script async defer crossorigin="anonymous" src="https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v6.0&appId=1092111527826829&autoLogAppEvents=1"></script>


</head><!--/head-->

<body>

@include('frontend.header')

<section>
    <div class="container">
        <div class="row">
            <div class="col-sm-3">

                <div class="left-sidebar">

                    <div class="brands_products"><!--products-->
                        <h2 style="color: orangered">sản phẩm</h2>
                        <div class="">
                            <ul class="list-group" style="border-bottom: 2px solid #dddddd">
                                <li class=""><a class="list-group-item text-dark"  style="color: #111111; border-bottom: none ;border-radius: 0; padding-left: 30px  " href="{{ url('new-product') }}">Sản phẩm mới</a></li>
                                <li class=""><a class="list-group-item text-dark"  style="color: #111111; border-bottom: none ;border-radius: 0; padding-left: 30px  " href="{{ url('top-sale-product') }}">Bán chạy</a></li>
                                <li class=""><a class="list-group-item text-dark"  style="color: #111111; border-bottom: none ;border-radius: 0; padding-left: 30px  " href="{{ url('sale-product') }}">Ưu đãi, khuyến mãi</a></li>
                            </ul>
                        </div>
                    </div><!--/products-->

                    <h2 style="margin-top: 2px; color: orangered">danh mục</h2>
                    <div class="" id=""><!--category-productsr-->
                        <ul class="list-group" style="border-bottom: 2px solid #dddddd;">
                            @foreach($category as $rows)
                            <li>
                                <a class="list-group-item text-dark" style="color: #111111;border-radius: 0; border-bottom: none;padding-left: 30px; "
                                   href="{{url('danh-muc-san-pham/'.$rows->category_id)}}">
                                    {{$rows->category_name}}
                                </a>
                            </li>
                            @endforeach
                        </ul>
                    </div><!--/category-products-->

                    <div class="brands_products"><!--brands_products-->
                        <h2 style="color: orangered">Thương hiệu</h2>
                        <div class="">
                            <ul class="list-group" style="border-bottom: 2px solid #dddddd">
                                @foreach($brand as $rows)
                                <li class=""><a class="list-group-item text-dark"  style="color: #111111; border-bottom: none ;border-radius: 0; padding-left: 30px  "
                                                href="{{url('thuong-hieu-san-pham/'.$rows->brand_id)}}">{{ $rows->brand_name  }} </a></li>
                                @endforeach
                            </ul>
                        </div>
                    </div><!--/brands_products-->


                    <!--/video-->
                    <div class="video">
                        <iframe width="100%" height="180" src="https://www.youtube.com/embed/BArqMoMzsyg" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                    </div>
                    <!--end video-->

                    <!--/video-->
                    <div class="video">
                        <iframe width="100%" height="180" src="https://www.youtube.com/embed/5CSVoxc9QuI" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe></iframe>
                    </div>
                    <!--end video-->


                    <div class="shipping text-center"><!--shipping-->
                        <img src="eshoper/images/home/shipping.jpg" alt="" />
                    </div><!--/shipping-->



                </div>
            </div>

            <div class="col-sm-9 padding-right">

                <!-- content-->
                @yield('content')
                <!-- content -->

            </div>
        </div>
    </div>
</section>





<script src="eshoper/js/jquery.js"></script>
<script src="eshoper/js/bootstrap.min.js"></script>
<script src="eshoper/js/jquery.scrollUp.min.js"></script>
<script src="eshoper/js/price-range.js"></script>
<script src="eshoper/js/jquery.prettyPhoto.js"></script>
<script src="eshoper/js/main.js"></script>
</body>
</html>

