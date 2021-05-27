<div id="box-filter-2">
    <div style="display: flex; justify-content: space-between">
        {{--<div>
            <button class="btn btn-default show-modal-filter" >
                <img src="{{ asset('images/filter.png') }}" alt="" style="width: 14px">
                Bộ lọc
            </button>
        </div>--}}

{{--        <div class="dropdown">--}}
{{--            <button class="btn btn-default dropdown-toggle" type="button" data-toggle="dropdown">--}}
{{--            Sắp xếp theo--}}
{{--            <span class="caret"></span></button>--}}
{{--            <ul class="dropdown-menu">--}}
{{--                <li><a href="#">Mới nhất</a></li>--}}
{{--                <li><a href="#">Giá thấp đến cao</a></li>--}}
{{--                <li><a href="#">Giá cao đến thấp</a></li>--}}
{{--            </ul>--}}
{{--        </div>--}}
    </div>
</div>

<div class="box-brand">
    @if(isset($data_brand) && !empty($data_brand))
        @foreach($data_brand as $key => $value)
            <a href="{{ route('site.list.index', ['brand_id'=>$value->id]) }}"
               class="brand-item" @if(request('brand_id') == $value->id) style="border: 1px solid #FE980F" @endif>
                @if(!empty($value->image))
                    <img src="{{ $value->image }}" alt="">
                @else
                    {{ $value->name }}
                @endif
            </a>
        @endforeach
    @endif
</div>
<hr>

<div class="modal fade" id="modalPrice" role="dialog">
    <div class="modal-dialog modal-lg">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Bộ lọc giá</h4>
            </div>

            <div class="modal-body">

            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modalFilter" role="dialog">
    <div class="modal-dialog modal-lg">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Bộ lọc</h4>
            </div>

            <form action="">
                <div class="modal-body" style="padding-bottom: 20px">
                    <div class="box-brand">
                        @if(isset($data_brand) && !empty($data_brand))
                            @foreach($data_brand as $key => $value)
                                <a href="javascript:void(0)"
                                   class="brand-item" @if(request('brand_id') == $value->id) style="border: 1px solid #FE980F" @endif>
                                    @if(!empty($value->image))
                                        <img src="{{ $value->image }}" alt="">
                                    @else
                                        {{ $value->name }}
                                    @endif
                                </a>
                            @endforeach
                        @endif
                    </div>
                </div>

                <div style="width: 70%; justify-content: space-between; display: flex">
                    <div class="text-1"><input id="ft1" {{ request('filter') == '0-2000000' ? 'checked' : '' }} type="radio" name="filter" value="0-2000000"> <label for="ft1">Dưới 2 triệu</label> </div>
                    <div class="text-1"><input id="ft2" {{ request('filter') == '2000000-4000000' ? 'checked' : '' }} type="radio" name="filter" value="2000000-4000000"> <label for="ft2">2-4 triệu</label></div>
                    <div class="text-1"><input id="ft3" {{ request('filter') == '4000000-7000000' ? 'checked' : '' }} type="radio" name="filter" value="4000000-7000000"> <label for="ft3">4-7 triệu</label></div>
                    <div class="text-1"><input id="ft4" {{ request('filter') == '7000000-13000000' ? 'checked' : '' }} type="radio" name="filter" value="7000000-13000000"> <label for="ft4">7-13 triệu</label></div>
                    <div class="text-1"><input id="ft5" {{ request('filter') == '13000000-20000000' ? 'checked' : '' }} type="radio" name="filter" value="13000000-20000000"> <label for="ft5">13-20 triệu</label></div>
                    <div class="text-1"><input id="ft6" {{ request('filter') == '20000000-1000000000' ? 'checked' : '' }} type="radio" name="filter" value="20000000-1000000000"> <label for="ft6">trên 20 triệu</label></div>
                </div>

                @if(isset($brand_id))
                    <input type="hidden" name="brand_id" value="{{ $brand_id }}">
                @endif
            </form>

            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
            </div>
        </div>
    </div>
</div>
