@extends('frontend.layout_4') @section('content')

<div class="features_items">
    <h2 class="title text-center" style="margin-top: 2px; color: orangered;">
        @if(isset($category_name)) {{ $category_name }} @elseif(isset($brand_name)) {{ $brand_name }} @elseif(isset($message_search)) {{ $message_search }} @elseif(isset($message_filter)) {{ $message_filter }}
        @elseif(isset($title_top_sale)) {{ $title_top_sale }} @else Sản phẩm mới nhất @endif
    </h2>

    <div class="" style="color: red; font-size: 17px; padding-bottom: 10px;">
        <i> @if(isset($error)){{ $error }} @endif </i>
    </div>

    @foreach($data as $rows)
        <div class="col-lg-3 col-md-6 col-sm-6">
            <div class="product-image-wrapper a">
                <div class="single-products">
                    <div class="text-center">
                        <a href="{{url('chi-tiet-san-pham/'.$rows->product_id)}}">
                            <img class="product-hover img_product" src="{{'upload/product/'.$rows->product_image}}" style="border-radius: 3px;" alt="" />
                            @if($rows->product_sale_price > 0)
                                <div class="anh_sale">
                                    <div class="phantram">
                                        <?php $phantram = (($rows->product_price - $rows->product_sale_price)/$rows->product_price)*100 ?>
                                        <b> -{{ round($phantram)}}% </b>
                                    </div>
                                </div>
                            @endif
                        </a>
                        <div class="text-danger" style="margin-top: 3px;">Mã SP: {{$rows->product_id}}</div>
                        <div style="height: 45px; margin-top: 5px;">{{$rows->product_name}}</div>
                        @if($rows->product_sale_price > 0)
                            <div style="height: 60px;">
                                <p style="color: #f40606; font-size: 17px;"><b> {{number_format($rows->product_sale_price, 0,",",".")}} đ</b></p>
                                <p class="product_price">{{number_format($rows->product_price, 0,",",".")}} đ</p>
                            </div>
                        @else
                            <div style="color: #f40606; font-size: 17px; height: 60px;">
                                <b>{{number_format($rows->product_price, 0,",",".")}} đ </b>
                            </div>
                        @endif

                        <a href="{{url('chi-tiet-san-pham/'.$rows->product_id)}}" class="btn btn-default add-to-cart">Xem chi tiết</a>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
</div>

<div class="text-center">
    {{ $data->links() }}
</div>

@if( !isset($check) )
    @include('frontend.product_khuyen_mai')
@endif
@endsection
