
<header id="header"><!--header-->
    <div class="header-middle" style="background: #FE980F;">
        <div class="container">
            <div class="row" style="border-bottom: none;">
                <div class="col-md-6 col-sm-12">
                    <div class="logo pull-left" style="width: 150px">
                        <a href="{{ route('site.home.index') }}"><img src="eshoper/images/home/logo-3.png" class="logo-img" style="width: 150px; padding-top: 10px" alt="" /></a>
                    </div>
                </div>

                <div class="col-md-6 col-sm-12" style="margin-top: 10px" >
                    <!-- search -->
                    <form action="{{ route('site.list.index') }}" method="get">
                        <div class="form-group pull-right" style="display: flex">
                            <select name="brand_id" class="form-control" style="width: 190px" >
                                <option value="0" >Tất cả danh mục</option>
                                @if(!empty($data_brand) )
                                    @foreach($data_brand as $k => $v)
                                        <option @if(!is_null(request('brand_id')) && request('brand_id') == $v->id) selected @endif value="{{$v->id}}">{{$v->name}}</option>
                                    @endforeach
                                @endif
                            </select>
                            <input type="text" name="name" value="" class="form-control" placeholder="Tìm kiếm"/>
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
                            <li><a href="{{ route('site.home.index') }}" class="active">Trang chủ</a></li>
                            <li class="dropdown"><a href="#">Thương hiệu<i class="fa fa-angle-down"></i></a>
                                <ul role="menu" class="sub-menu" style="background: #FE980F">
                                    @if(!empty($data_brand))
                                        @foreach($data_brand as $key => $value)
                                            <li><a href="{{ route('site.list.index', ['brand_id'=>$value->id]) }}">{{ $value->name }}</a></li>
                                        @endforeach
                                    @endif
                                </ul>
                            </li>

                            <li class="dropdown"><a href="#">Tin tức<i class="fa fa-angle-down"></i></a>
                                <ul role="menu" class="sub-menu" style="background: #FE980F">
                                    @if(!empty($cate_news))
                                        @foreach($cate_news as $key => $value)
                                            <li><a href="{{ route('site.news.index', ['id'=>$value->id]) }}">{{ $value->name }}</a></li>
                                        @endforeach
                                    @endif
                                </ul>
                            </li>

                            <li><a href="{{url('trang-chu')}}"  class="text">Liên hệ</a></li>
                        </ul>
                    </div>
                </div>

                <div class="col-sm-6">
                    <div class="pull-right">
                        @if(Auth::guard('customers')->check())
                            <div style="display: flex; align-items: center">
                                <span>{{ auth('customers')->user()->name }}</span>&nbsp; &nbsp; &nbsp;
                                <form action="{{ route('site.logout') }}" method="post">
                                    @csrf
                                    <button class="btn btn-default">Đăng xuất</button>
                                </form>
                            </div>
                        @else
                            <a href="{{ route('site.login') }}" class="btn btn-default">Đăng nhập</a>
                        @endif
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
    <a href="{{ route('site.cart.index') }}">
        <div class="gio-hang-icon"  style="width: 70px; height: 70px; background: #546ce8; display: flex; justify-content:center; align-items: center; border-radius: 35px; position: relative; border: 1px solid white;" >
            <b style="position: absolute; color: white; padding-bottom: 35px;"> {{ Cart::count() }} </b>
            <span class="glyphicon glyphicon-shopping-cart" style="font-size: 30px; width: 40px; height: 45px; color:white; margin-top: 23px;
margin-left: 7px;"></span>
        </div>
    </a>
</div>

