@extends('site.layout.main')
@section('title')
    <title>Trang chủ</title>
@endsection

@section('brand')
    @include('site.home.brand')
@endsection

@section('content')
    <style>
        .config img {
            width: 17px !important;
        }
        .owl-stage-outer {
            border: 1px solid #dddddd;
            border-radius: 6px;
            padding-bottom: 10px;
        }
    </style>
    <div id="site-home">
        @if (count($top_sale) > 0)
        <div style="text-align: center ;color: orangered; font-size: 18px; font-weight: 700; margin-top: 20px">SẢN PHẨM BÁN CHẠY</div>
            <br>
        <div class="owl-carousel">
            @foreach($top_sale as $key => $value)
                <div class="col-lg-4 col-md-6 col-sm-6 ">
                    <a href="{{ route('site.detail.index', [Str::slug($value->name), $value->id])}}" data-toggle="tooltip" title="{{ $value->name }}">
                        <div class="item-custom">
                            <div class="image">
                                <img class="image-product" src="{{$value->image}}" alt="{{ $value->name }}"
                                     title="{{ $value->name }}"
                                     height="214">
                            </div>
                            <div class="info">
                            @if($value->price_discount > 0) <!-- giảm giá -->
                                <div class="discount">
                                    <div class="val">Giảm
                                        {{  number_format($value->price - $value->price_discount) }} đ
                                    </div>
                                </div>
                            @else  <!-- không giảm giá -->
                                <div style="height: 24px"></div>
                                @endif

                                <div class="name">{{ $value->name }}</div>

                                <div class="price">
                                @if($value->price_discount > 0) <!-- giảm giá -->
                                    <div class="price-discount">
                                        {{ number_format($value->price_discount).' đ'}}
                                    </div>
                                    <div class="price-root">
                                        {{ number_format($value->price) }} đ
                                    </div>
                                @else  <!-- không giảm giá -->
                                    <div class="price-discount">{{ number_format($value->price).' đ'}}</div>
                                    <div class="price-root"></div>
                                    @endif
                                </div>

                                <div class="box-config">
                                    <div class="config">
                                        <div style="margin-right: 10px; display: flex; align-items: center; height: 24px">
                                            <img src="{{ asset('eshoper/images/cpu.png') }}" width="18px" height="18px" alt="">&nbsp;
                                            <span>{{ $value->cpu }}</span>
                                        </div>

                                        <div style="margin-right: 10px; display: flex; align-items: center; height: 24px">
                                            <img src="{{ asset('eshoper/images/screen.png') }}" width="18px" height="18px" alt="">
                                            <span>{{ $value->size }}</span>
                                        </div>

                                        <div style="margin-right: 10px; display: flex; align-items: center; height: 24px">
                                            <img src="{{ asset('eshoper/images/ram.png') }}" width="18px" height="18px" alt="">&nbsp;
                                            <span>{{ $value->ram }}</span>
                                        </div>

                                        <div style="margin-right: 10px; display: flex; align-items: center; height: 24px">
                                            <img src="{{ asset('eshoper/images/storage.png') }}" width="18px" height="18px" alt="">&nbsp;
                                            <span>{{ $value->ram }}</span>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
        @endif

        <br>
        <p style="text-align: center ;color: orangered; font-size: 18px; font-weight: 700;">SẢN PHẨM MỚI</p>
        <hr>
        @if(! empty($products))
            <div class="row">
                @foreach($products as $key => $value)
                    <div class="col-lg-4 col-md-6 col-sm-6 ">
                        <a href="{{ route('site.detail.index', [Str::slug($value->name), $value->id])}}" data-toggle="tooltip" title="{{ $value->name }}">
                            <div class="item-custom">
                                <div class="image">
                                    <img class="image-product" src="{{$value->image}}" alt="{{ $value->name }}"
                                         title="{{ $value->name }}"
                                         height="214">
                                </div>
                                <div class="info">
                                @if($value->price_discount > 0) <!-- giảm giá -->
                                    <div class="discount">
                                        <div class="val">Giảm
                                            {{  number_format($value->price - $value->price_discount) }} đ
                                        </div>
                                    </div>
                                @else  <!-- không giảm giá -->
                                    <div style="height: 24px"></div>
                                    @endif

                                    <div class="name">{{ $value->name }}</div>

                                    <div class="price">
                                    @if($value->price_discount > 0) <!-- giảm giá -->
                                        <div class="price-discount">
                                            {{ number_format($value->price).' đ'}}
                                        </div>
                                        <div class="price-root">
                                            {{ number_format($value->price) }} đ
                                        </div>
                                    @else  <!-- không giảm giá -->
                                        <div class="price-discount">{{ number_format($value->price).' đ'}}</div>
                                        <div class="price-root"></div>
                                        @endif
                                    </div>

                                    <div class="box-config">
                                        <div class="config">
                                            <div style="margin-right: 10px; display: flex; align-items: center; height: 24px">
                                                <img src="{{ asset('eshoper/images/cpu.png') }}" width="18px" height="18px" alt="">&nbsp;
                                                <span>{{ $value->cpu }}</span>
                                            </div>

                                            <div style="margin-right: 10px; display: flex; align-items: center; height: 24px">
                                                <img src="{{ asset('eshoper/images/screen.png') }}" width="18px" height="18px" alt="">
                                                <span>{{ $value->size }}</span>
                                            </div>

                                            <div style="margin-right: 10px; display: flex; align-items: center; height: 24px">
                                                <img src="{{ asset('eshoper/images/ram.png') }}" width="18px" height="18px" alt="">&nbsp;
                                                <span>{{ $value->ram }}</span>
                                            </div>

                                            <div style="margin-right: 10px; display: flex; align-items: center; height: 24px">
                                                <img src="{{ asset('eshoper/images/storage.png') }}" width="18px" height="18px" alt="">&nbsp;
                                                <span>{{ $value->ram }}</span>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
            <div class="text-center" style="margin-top: 20px"> {{ $products->render() }}</div>
        @endif

        <hr>
        <div style="text-align: center ;color: orangered; font-size: 18px; font-weight: 700; margin-top: 20px">SẢN PHẨM KHUYẾN MÃI</div>
        @if(! empty($discounts))
            <div class="row">
                @foreach($discounts as $key => $value)
                    <div class="col-lg-4 col-md-6 col-sm-6 ">
                        <a href="{{ route('site.detail.index', [Str::slug($value->name), $value->id])}}" data-toggle="tooltip" title="{{ $value->name }}">
                            <div class="item-custom">
                                <div class="image">
                                    <img class="image-product" src="{{$value->image}}" alt="{{ $value->name }}"
                                         title="{{ $value->name }}"
                                         height="214">
                                </div>
                                <div class="info">
                                @if($value->price_discount > 0) <!-- giảm giá -->
                                    <div class="discount">
                                        <div class="val">Giảm
                                            {{  number_format($value->price - $value->price_discount) }} đ
                                        </div>
                                    </div>
                                @else  <!-- không giảm giá -->
                                    <div style="height: 24px"></div>
                                    @endif

                                    <div class="name">{{ $value->name }}</div>

                                    <div class="price">
                                    @if($value->price_discount > 0) <!-- giảm giá -->
                                        <div class="price-discount">
                                            {{ number_format($value->price).' đ'}}
                                        </div>
                                        <div class="price-root">
                                            {{ number_format($value->price) }} đ
                                        </div>
                                    @else  <!-- không giảm giá -->
                                        <div class="price-discount">{{ number_format($value->price).' đ'}}</div>
                                        <div class="price-root"></div>
                                        @endif
                                    </div>

                                    <div class="box-config">
                                        <div class="config">
                                            <div style="margin-right: 10px; display: flex; align-items: center; height: 24px">
                                                <img src="{{ asset('eshoper/images/cpu.png') }}" width="18px" height="18px" alt="">&nbsp;
                                                <span>{{ $value->cpu }}</span>
                                            </div>

                                            <div style="margin-right: 10px; display: flex; align-items: center; height: 24px">
                                                <img src="{{ asset('eshoper/images/screen.png') }}" width="18px" height="18px" alt="">
                                                <span>{{ $value->size }}</span>
                                            </div>

                                            <div style="margin-right: 10px; display: flex; align-items: center; height: 24px">
                                                <img src="{{ asset('eshoper/images/ram.png') }}" width="18px" height="18px" alt="">&nbsp;
                                                <span>{{ $value->ram }}</span>
                                            </div>

                                            <div style="margin-right: 10px; display: flex; align-items: center; height: 24px">
                                                <img src="{{ asset('eshoper/images/storage.png') }}" width="18px" height="18px" alt="">&nbsp;
                                                <span>{{ $value->ram }}</span>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
@endsection

@section('slide')
    <div class="">
        <div id="myCarousel" class="carousel slide" data-ride="carousel">
            <!-- Indicators -->
            <ol class="carousel-indicators">
                <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                <li data-target="#myCarousel" data-slide-to="1"></li>
                <li data-target="#myCarousel" data-slide-to="2"></li>
            </ol>

            <!-- Wrapper for slides -->
            <div class="carousel-inner">
                <div class="item active">
                    <img src="https://hbmedia.com.vn/wp-content/uploads/2019/09/Banner_2.jpg" alt="Los Angeles" style="width:100%;">
                </div>
                <div class="item">
                    <img src="https://hbmedia.com.vn/wp-content/uploads/2019/09/Banner_2.jpg" alt="Los Angeles" style="width:100%;">
                </div>
                <div class="item">
                    <img src="https://hbmedia.com.vn/wp-content/uploads/2019/09/Banner_2.jpg" alt="Los Angeles" style="width:100%;">
                </div>
            </div>

            <!-- Left and right controls -->
            <a class="left carousel-control" href="#myCarousel" data-slide="prev">
                <span class="glyphicon glyphicon-chevron-left"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="right carousel-control" href="#myCarousel" data-slide="next">
                <span class="glyphicon glyphicon-chevron-right"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
    </div>
    <hr>
@endsection

@section('custom_js')
    <script>
        $(document).ready(function (){
            // $('[data-toggle="tooltip"]').tooltip();
            $(".owl-carousel").owlCarousel();
        })
    </script>
@endsection
