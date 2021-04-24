@extends('site.layout.main')
@section('title')
    <title>Trang chủ</title>
@endsection

@section('filter')

@endsection

@section('content')
    <div id="site-home">
        <div class="row" id="box-filter">
            <div style="width: 10%; margin-right: 20px" class="text-1">Chọn mức giá: </div>

            <form id="filter" action="{{ route('site.list.index', ['brand_id' => request('brand_id')]) }}" style="width: 100%;">
                <div style="width: 70%; justify-content: space-between; display: flex">
                    <div class="text-1"><input id="ft1" type="radio" name="filter" value="0-2000000"> <label for="ft1">Dưới 2 triệu</label> </div>
                    <div class="text-1"><input id="ft2" type="radio" name="filter" value="2000000-4000000"> <label for="ft2">2-4 triệu</label></div>
                    <div class="text-1"><input id="ft3" type="radio" name="filter" value="4000000-7000000"> <label for="ft3">4-7 triệu</label></div>
                    <div class="text-1"><input id="ft4" type="radio" name="filter" value="7000000-13000000"> <label for="ft4">7-13 triệu</label></div>
                    <div class="text-1"><input id="ft5" type="radio" name="filter" value="13000000-20000000"> <label for="ft5">13-20 triệu</label></div>
                    <div class="text-1"><input id="ft6" type="radio" name="filter" value="20000000-1000000000"> <label for="ft6">trên 20 triệu</label></div>
                </div>
            </form>

        </div>

        @if(!empty($products) && count($products) > 0)
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
        @else
            <div class="text-center text-muted">Không có dữ liệu</div>
        @endif
    </div>
@endsection

@section('custom_js')

<script>
    $('input[name="filter"]').on('click', function (){
        $('#filter').submit();
    })
</script>

@endsection
