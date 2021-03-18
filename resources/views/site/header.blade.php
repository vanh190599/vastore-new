
<header id="header"><!--header-->
    <div class="header-middle" style="background: #FE980F;">
        <div class="container">
            <div class="row" style="border-bottom: none;">
                <div class="col-md-6 col-sm-12">
                    <div class="logo pull-left" style="width: 150px">
                        <a href=""><img src="eshoper/images/home/logo-3.png" class="logo-img" style="width: 150px; padding-top: 10px" alt="" /></a>
                    </div>
                </div>

                <div class="col-md-6 col-sm-12" style="margin-top: 10px" >
                    <!-- search -->
                        <form action="{{ url('tim-kiem-san-pham') }}" method="get">
                            <div class="form-group pull-right" style="display: flex">
                                <input type="text" name="key" value="" class="form-control" placeholder="Tìm kiếm"/>
                                <button  class="btn" style="color: orangered; margin-left: 5px"><span>Tìm kiếm </span><span class="glyphicon glyphicon-search"></span></button>
                            </div>
                        </form>
                    <!-- search -->
                </div>

            </div>
        </div>
    </div><!--/header-middle-->

    <div class="header-bottom" style="padding: 10px"><!--header-bottom-->
        <div class="container">
            <div class="row">
                <div class="col-sm-6">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                    </div>
                    <div class="mainmenu pull-left">
                        <ul class="nav navbar-nav collapse navbar-collapse" style="margin-top: 8px;">
                            <li><a href="{{url('trang-chu')}}" class="active">Trang chủ1</a></li>
                            <li class="dropdown"><a href="#">Sản phẩm<i class="fa fa-angle-down"></i></a>
                                <ul role="menu" class="sub-menu" style="background: #FE980F">
                                    <li><a href="{{ url('new-product') }}">Sản phẩm mới nhất</a></li>
                                    <li><a href="{{ url('top-sale-product') }}">Sản phẩm bán chạy</a></li>
                                    <li><a href="{{ url('sale-product') }}">Sản phẩm khuyến mãi</a></li>
                                </ul>
                            </li>
                            <li><a href="{{url('trang-chu')}}"  class="text">Giới thiệu</a></li>
                            <li><a href="{{url('news')}}"  class="text">Tin tức</a></li>
                            <li><a href="{{url('trang-chu')}}"  class="text">Liên hệ</a></li>
                        </ul>
                    </div>
                </div>

                <div class="col-sm-6">
                    <div class="shop-menu pull-right" style="margin-bottom: 5px">
                        <ul class="nav navbar-nav">
                            <li><a href="{{ url('show-login') }}"  style="background: none; color: black;"><i class="fa fa-crosshairs"></i> Thanh toán</a></li>
                            <li><a href="{{ url('show-cart') }}"  style="background: none;color: black; "><i class="fa fa-shopping-cart"></i> Giỏ hàng (0) </a></li>
                            <li style="">
                                   ok
                            </li>
                            <li>

                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div><!--/header-bottom-->
</header><!--/header-->

<style>
    .gio-hang1:hover .gio-hang-icon{
        background: orangered !important;
        transition: 0.9s;
    }
</style>

<div style="position: fixed; right: 20px; top: 20px; z-index: 10" class="gio-hang1">
    <a href="{{ url('show-cart') }}">
        <div class="gio-hang-icon"  style="width: 70px; height: 70px; background: #546ce8; display: flex; justify-content:center; align-items: center; border-radius: 35px; position: relative; border: 1px solid white;" >
            <b style="position: absolute; color: white; padding-bottom: 35px;">0</b>
            <span class="glyphicon glyphicon-shopping-cart" style="font-size: 30px; width: 40px; height: 45px; color:white; margin-top: 23px;
margin-left: 7px;"></span>
        </div>
    </a>
</div>

