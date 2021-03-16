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
            <img src="{{ asset('admin/upload/') }}/{{$product->image}}" alt="" height="450px" style="object-fit: cover">
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

            <a href="" >
                <div class="buy-now">
                    MUA NGAY
                </div>
            </a>
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
@endsection

@section('custom_js')
    <script>
        $(document).ready(function (){
            $('[data-toggle="tooltip"]').tooltip();
        })
    </script>
@endsection
