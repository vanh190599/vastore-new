<div class="recommended_items">
    <!--features_items-->
    <h2 class="title text-center" style="margin-top: 2px; color: orangered;">Sản phẩm khuyến mãi</h2>

    @if(!empty($sale_product))
        @foreach($sale_product as $rows)
            <div class="col-lg-3 col-md-6 col-sm-6 ">
                <div class="product-image-wrapper a">
                    <div class="single-products test">
                        <div class="text-center">
                            <a href="{{url('chi-tiet-san-pham/'.$rows->product_id)}}">
                                <img class="product-hover img_product" src="{{'upload/product/'.$rows->product_image}}" alt="" />
                                <div class="anh_sale">
                                    <div class="phantram">
                                        <?php $phantram = (($rows->product_price - $rows->product_sale_price)/$rows->product_price)*100 ?>
                                        <b> -{{ round($phantram)}}% </b>
                                    </div>
                                </div>
                            </a>
                            <div class="text-danger" style="margin-top: 6px;">Mã SP: {{$rows->product_id}}</div>
                            <a  href="{{url('chi-tiet-san-pham/'.$rows->product_id)}}">
                                <div style="height: 45px; font-size: 16px; text-transform: uppercase;">{{$rows->product_name}}</div>
                            </a>
                            <div style="height: 40px;">
                                <p style="color: #f40606; font-size: 17px;"><b> {{number_format($rows->product_sale_price, 0,",",".")}} đ</b></p>
                                <p class="product_price">{{number_format($rows->product_price, 0,",",".")}} đ</p>
                            </div>

                            <div style="color: #666666; height: 25px; margin-top: 6px;">
                                <p style="line-height: 12px;"></p>
                            </div>
                            <a href="{{url('chi-tiet-san-pham/'.$rows->product_id)}}" class="btn btn-default add-to-cart">Xem chi tiết</a>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    @endif



</div>
