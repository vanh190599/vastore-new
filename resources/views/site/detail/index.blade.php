@extends('site.layout.main')
@section('title')
    <title> {{ $product->name ? $product->name : '' }} </title>
@endsection
@section('content')
<style>
    .bg-gray-custom { background: #f3f4f7}
</style>
<div id="site-detail">
    <div class="row">
        <div class="col-lg-5">
            <div class="one-time">
                @if(!empty($product->colors))
                    @foreach(json_decode($product->colors) as $k => $v)
                        <img src="{{$v->image}}" alt="" height="450px" style="object-fit: cover">
                    @endforeach
                        <img src="{{$product->image}}" alt="" height="450px" style="object-fit: cover">
                @else
                    <img src="{{$product->image}}" alt="" height="450px" style="object-fit: cover">
                @endif
            </div>
        </div>
        <div class="col-lg-7">
            <p class="name">{{ $product->name }}</p>
            @if($product->price_discount > 0)
                <div>
                    <span class="price">{{ number_format($product->price) }} đ</span>
                    <span class="price-discount"> <strike>{{ number_format($product->price_discount) }} đ</strike> </span>
                </div>
            @else
                <span class="price">{{ number_format($product->price) }}</span>
            @endif
            <p style="font-size: 16px; margin-top: 7px">
                Gọi <span class="text-danger">1800-6601</span>  để được tư vấn mua hàng (Miễn phí)
            </p>
            <p style="font-size: 16px; margin-top: 7px">
                <span>Bảo hành: </span>
                <span>{{ \App\Library\CGlobal::showTime($product->unit_num, $product->unit_label) }}</span>
            </p>

            <p style="font-size: 16px; margin-top: 7px">
                <span>Phụ kiện đi kèm:</span>
                <span>
                    <a href="#">{{ $product->attach }}</a>
                </span>
            </p>

            @if(!empty($product->colors))
                <p style="font-size: 16px; margin-top: 7px">
                    <span>Màu:</span>
                    <span>
                        @foreach(json_decode($product->colors) as $k => $v)
                            {{ $k!=0 ? '-' : '' }} <a class="open-modal-image" href="javascript:void(0)" data-url="{{ $v->image }}">{{ $v->name }}</a>
                        @endforeach
                    </span>
                </p>
            @endif

            <p style="font-size: 16px; margin-top: 7px">
                <span>Trạng thái:</span>
                <span>
                   {{ $product->qty > 0 ? 'Còn hàng' : 'Hết hàng' }}
                </span>
            </p>

            <p style="font-size: 16px; margin-top: 7px">
                <span>Kho hàng:</span>
                <span>
                   {{ $product->qty > 0 ? $product->qty : 'Hết hàng' }}
                </span>
            </p>

            <div class="uu-dai">
                <ul>
                    <li>
                        <div class="ud-item">
                            <img src="{{ asset('eshoper/images/tick.png') }}" alt="">
                            Tặng Bảo hành 2 năm chính hãng áp dụng đến 31/03
                        </div>
                    </li>
                    <li>
                        <div class="ud-item">
                            <img src="{{ asset('eshoper/images/tick.png') }}" alt="">
                            Tặng PMH 200.000đ mua Củ sạc nhanh 20W
                        </div>
                    </li>
                    <li>
                        <div class="ud-item">
                            <img src="{{ asset('eshoper/images/tick.png') }}" alt="">
                            Tặng Bảo hành 2 năm chính hãng áp dụng đến 31/03
                        </div>
                    </li>
                    <li>
                        <div class="ud-item">
                            <img src="{{ asset('eshoper/images/tick.png') }}" alt="">
                            Thu cũ đổi mới - Trợ giá ngay 15%
                        </div>
                    </li>
                    <li>
                        <div class="ud-item">
                            <img src="{{ asset('eshoper/images/tick.png') }}" alt="">
                            Tặng gói iCloud 50GB miễn phí 3 tháng
                        </div>
                    </li>
                </ul>
            </div>

            <form id="MyForm" name="MyForm" action="{{ route('site.cart.addCart') }}" method="post">
                @csrf
                @if($product->qty > 0)
                    <input type="hidden" name="id" value="{{ $product->id }}" id="">
                    <a href="javascript: submit()"  type="">
                        <div class="buy-now">
                            MUA NGAY
                        </div>
                    </a>
                @else
                    <a type="">
                        <div class="buy-now" style="cursor: not-allowed">
                            SẢN PHẨM KHÔNG CÓ SẴN
                        </div>
                    </a>
                @endif
            </form>

        </div>
    </div>
    <hr>
    <div>
        <div class="config">
            <div class="cf-item">
                <img src="{{ asset('eshoper/images/screen.png') }}" alt="">
                {{ $product->size }}
            </div>

            <div class="cf-item">
                <img src="{{ asset('eshoper/images/cam.png') }}" alt="">
                {{ $product->camera_after }}
            </div>

            <div class="cf-item">
                <img src="{{ asset('eshoper/images/selfie.png') }}" alt="">
                {{ $product->camera_before }}
            </div>

            <div class="cf-item" >
                <img src="{{ asset('eshoper/images/cpu.png') }}" alt="">
                {{ $product->cpu }}
            </div>

            <div class="cf-item">
                <img src="{{ asset('eshoper/images/rom.png') }}" alt="">
                {{ $product->rom }} GB
            </div>
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="col-lg-8 description" >
            {!! $product->description !!}
        </div>
        <div class="col-lg-4">
            <table class="table table-bordered">
                <tbody>
                <tr class="bg-gray-custom"><td>Màn hình</td><td>{{ $product->size }}</td></tr>
                <tr><td>Camera sau</td><td>{{ $product->camera_after }}</td></tr>
                <tr class="bg-gray-custom"><td>Camera trước</td><td>{{ $product->camera_before }}</td></tr>
                <tr><td>RAM</td><td>{{ $product->ram }}</td></tr>
                <tr class="bg-gray-custom"><td>Bộ nhớ</td><td>{{ $product->rom }}</td></tr>
                <tr><td>CPU</td><td>{{ $product->cpu }}</td></tr>
                <tr class="bg-gray-custom"><td>Dung lượng pin</td><td>{{ $product->battery_capacity }}</td></tr>
                <tr><td>Xuất xứ</td><td>{{ $product->origin }}</td></tr>
                <tr class="bg-gray-custom"><td>Thời gian </td><td>{{ date('d/m/Y', $product->release_date) }}</td></tr>

                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal -->
<div id="modalImage" class="modal fade" role="dialog" style="overflow: hidden">
    <div class="modal-dialog modal-dialog-centered">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-body text-center">
                <img src="" alt="" height="450px" width="450px" style="object-fit: cover">
            </div>
        </div>

    </div>
</div>

<style>
    .modal {
        text-align: center;
        padding: 0!important;
    }

    .modal:before {
        content: '';
        display: inline-block;
        height: 100%;
        vertical-align: middle;
        margin-right: -4px;
    }

    .modal-dialog {
        display: inline-block;
        text-align: left;
        vertical-align: middle;
    }
</style>

<script type='text/javascript'>
    function submit()
    {
        document.forms["MyForm"].submit();
    }
</script>

@endsection

@section('custom_css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.css"
          integrity="sha512-yHknP1/AwR+yx26cB1y0cjvQUMvEa2PFzt1c9LlS4pRQ5NOTZFWbhBig+X9G9eYW/8m0/4OXNx8pxJ6z57x0dw=="
          crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick-theme.min.css"
          integrity="sha512-17EgCFERpgZKcm0j0fEq1YCJuyAWdz9KUtv1EjVuaOz8pDnh/0nZxmU6BBXwaaxqoi9PQXnRWqlcDB027hgv9A==" crossorigin="anonymous" />

    <style>
        .slick-dots li {
            margin: 0 50px !important;
        }
        .slick-dots li button:before {
            display: none !important;
        }
        .slick-active button img {
            padding: 3px;
            border: 1px solid #288ad6;
        }
        .slick-dots {
            position: absolute;
            bottom: -90px;
            display: block;
            width: 100%;
            padding: 0;
            margin: 0;
            list-style: none;
            text-align: center;
            left: -81px;
        }
    </style>
@endsection

@section('custom_js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js"
            integrity="sha512-XtmMtDEcNz2j7ekrtHvOVR4iwwaD6o/FUJe6+Zq+HgcCsk3kj4uSQQR8weQ2QVj1o0Pk6PwYLohm206ZzNfubg=="
            crossorigin="anonymous"></script>

    <script>
        $(document).ready(function (){
            $('[data-toggle="tooltip"]').tooltip();
            $('.open-modal-image').on('click', function (){
                let src = $(this).data('url')
                $('#modalImage').find('img').attr('src', src)
                $('#modalImage').modal('show')
            })

            $('.one-time').slick({
                dots: true,
                infinite: true,
                speed: 300,
                slidesToShow: 1,
                adaptiveHeight: true
            })

            let li = $('.slick-dots').find('li')
            console.log(li.length)
            if (li.length > 0) {
                let colors = @json($product->colors);
                colors = JSON.parse(colors)
                console.log(colors)
                let a = @json($product->image);
                $.each(li, function (key, value) {
                    $(value).find('button').html(
                        `
                         <img src="`+colors[key]['image']+`" alt="" width="90px" height="90px">
                        `
                    )

                    $(value).append(
                        `
                        <div style="width: 90px; text-align: center; position: absolute; bottom: -99px;">`+colors[key]['name']+`</div>
                        `
                    )
                })
            }
        })

    </script>
@endsection
