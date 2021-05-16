@extends('admin.layout.main')
@section('title')
    Danh sách sản phẩm
@endsection
@push('scripts')
    <script src="{{ asset('admin/js/page/admin_account.js') }}"></script>
@endpush
@inject('CGlobal', 'App\Library\CGlobal' )
@inject('ProductService', 'App\Services\ProductService' )
@section('content')
    <style>
        .image-product {
            object-fit: cover;
            border: 1px solid #dddddd;
            padding: 5px;
            border-radius: 5px
        }
        .tb-ct tr td {
            /*border: none*/
        }
    </style>

    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
        <!--begin::Subheader-->
        <div class="subheader py-2 py-lg-6 subheader-solid" id="kt_subheader">
            <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
                <!--begin::Info-->
                <div class="d-flex align-items-center flex-wrap mr-1">
                    <!--begin::Page Heading-->
                    <div class="d-flex align-items-baseline flex-wrap mr-5">
                        <!--begin::Page Title-->
                        <i class="flaticon-paper-plane text-primary mr-4"></i>
                        <h5 class="text-dark font-weight-bold my-1 mr-5">Tài khoản</h5>
                        <!--end::Page Title-->
                        <!--begin::Breadcrumb-->
                        <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
                            <li class="breadcrumb-item">
                                <a href="" class="text-muted">Quản trị viên</a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="" class="text-muted">Tìm kiếm</a>
                            </li>
                        </ul>
                        <!--end::Breadcrumb-->
                    </div>
                    <!--end::Page Heading-->
                </div>
                <!--end::Info-->

                <!--begin::Toolbar-->
                <div class="d-flex align-items-center">
                    <!--begin::Actions-->
                    <a href="#" class="btn btn-light-primary font-weight-bolder btn-sm">Đến trang Site</a>
                    <!--end::Actions-->
                </div>
                <!--end::Toolbar-->
            </div>
        </div>
        <!--end::Subheader-->
        <!--begin::Entry-->
        <div class="d-flex flex-column-fluid">
            <!--begin::Container-->
            <div class="container-fluid">
                <div class="card card-custom">
                    <div class="card-body p-0">
                        <!--begin::Wizard-->
                        <div class="wizard wizard-1" id="kt_wizard" data-wizard-state="first" data-wizard-clickable="false">
                            <!--begin::Wizard Nav-->
                            <div class="wizard-nav border-bottom">
                                <div class="wizard-steps p-8 p-lg-10">
                                    <form action="{{ route('admin.product.search') }}" method="get">
                                        <div class="row">
                                            <div class="col-lg-3">
                                                <div class="form-group fv-plugins-icon-container">
                                                    <label>ID</label>
                                                    <input type="text" class="form-control form-control-solid form-control-lg" name="id" placeholder="ID" value="{{ request('id') }}">
                                                    <div class="fv-plugins-message-container"></div>
                                                </div>
                                            </div>
                                            <div class="col-lg-3">
                                                <div class="form-group fv-plugins-icon-container">
                                                    <label>Tên</label>
                                                    <input type="text" class="form-control form-control-solid form-control-lg" name="name" placeholder="Tên" value="{{ request('name') }}">
                                                    <div class="fv-plugins-message-container"></div>
                                                </div>
                                            </div>
                                            <div class="col-lg-3">
                                                <div class="form-group fv-plugins-icon-container">
                                                    <label>Hãng</label>
                                                    <select name="brand" id="" class="form-control form-control-solid form-control-lg">
                                                        <option value="">Tất cả</option>
                                                        @if(isset($data_brand) && sizeof($data_brand) > 0)
                                                            @foreach($data_brand as $key => $value)
                                                                <option value="{{ $value->id }}" {{ $value->id == request('brand') ?  'selected' : '' }}>{{ $value->name }}</option>
                                                            @endforeach
                                                        @endif
                                                    </select>
                                                    <div class="fv-plugins-message-container"></div>
                                                </div>
                                            </div>

                                            {{--                                            <div class="col-lg-3">--}}
                                            {{--                                                <div class="form-group fv-plugins-icon-container">--}}
                                            {{--                                                    <label>Màu sắc</label>--}}
                                            {{--                                                    <input type="text" class="form-control form-control-solid form-control-lg" name="phone" placeholder="Màu sắc" value="{{ request('phone') }}">--}}
                                            {{--                                                    <div class="fv-plugins-message-container"></div>--}}
                                            {{--                                                </div>--}}
                                            {{--                                            </div>--}}

                                            <div class="col-lg-3">
                                                <div class="form-group fv-plugins-icon-container">
                                                    <label>Trạng thái</label>
                                                    <select type="text" class="form-control form-control-solid form-control-lg" name="is_active">
                                                        <option value="0">Tất cả</option>
                                                    </select>
                                                    <div class="fv-plugins-message-container"></div>
                                                </div>
                                            </div>

                                            <div class="col-lg-3"></div>

                                            <div class="col-lg-3">
                                                {{--                                                <div class="form-group fv-plugins-icon-container">--}}
                                                {{--                                                    <label>Màu sắc</label>--}}
                                                {{--                                                    <input type="text" class="form-control form-control-solid form-control-lg" name="phone" placeholder="Màu sắc" value="{{ request('phone') }}">--}}
                                                {{--                                                    <div class="fv-plugins-message-container"></div>--}}
                                                {{--                                                </div>--}}
                                            </div>
                                            <div class="col-lg-3">
                                                {{--                                                <div class="form-group fv-plugins-icon-container">--}}
                                                {{--                                                    <label>Màu sắc</label>--}}
                                                {{--                                                    <input type="text" class="form-control form-control-solid form-control-lg" name="phone" placeholder="Màu sắc" value="{{ request('phone') }}">--}}
                                                {{--                                                    <div class="fv-plugins-message-container"></div>--}}
                                                {{--                                                </div>--}}
                                            </div>

                                            <div class="col-lg-3 d-flex align-items-center justify-content-end">
                                                <a href="{{ route('admin.product.create') }}" class="btn btn-lg btn-success mr-4">
                                                    <i class="la la-plus-square"></i>
                                                    Create
                                                </a>
                                                <button type="reset" class="btn btn-lg btn-secondary btn-secondary--icon mr-4">
                                                    <i class="la la-close"></i>
                                                    Reset
                                                </button>
                                                <button type="submit" class="btn btn-lg btn-primary btn-primary--icon">
                                                    <i class="la la-search"></i>
                                                    Search
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <!--end::Wizard Nav-->
                            <!--begin::Wizard Body-->
                            <div class="row justify-content-center my-10 px-8 my-lg-15 px-lg-1">
                                <div class="col-xl-12 col-xxl-11">
                                    <table class="table">
                                        <thead>
                                        <tr>
                                            <th scope="col" width="5px">#</th>
                                            <th scope="col" >Thời gian</th>
                                            <th scope="col" >Hoạt động</th>
                                            <th scope="col" >Hành động</th>
                                            <th scope="col" >Người thay đổi</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @if(!empty($log))
                                            @foreach($log as $key => $value)
                                                <tr>
                                                    <td class="align-middle">
                                                        <a href="javascript:void(0)" data-show="0" class="show-content show-content-{{ $value->product_id }}" data-id="{{ $value->product_id }}">
                                                            <i class="fas fa-angle-right text-primary mr-5"></i>
                                                        </a>
                                                    </td>

                                                    <td class="align-middle">
                                                        {{ date('h:i:s d-m-Y')}}
                                                    </td>

                                                    <td class="align-middle">
                                                        @if($ProductService::DB_INSERT == $value->action)
                                                            <span class="label label-success label-pill label-inline mr-2">
                                                                {{ isset($ProductService::$aryActionDB[$value->action]) ? $ProductService::$aryActionDB[$value->action] : '' }}
                                                            </span>
                                                        @elseif($ProductService::DB_UPDATE == $value->action)
                                                            <span class="label label-warning label-pill label-inline mr-2">
                                                                {{ isset($ProductService::$aryActionDB[$value->action]) ? $ProductService::$aryActionDB[$value->action] : '' }}
                                                            </span>
                                                        @elseif($ProductService::DB_DELETE == $value->action)
                                                            <span class="label label-success label-pill label-inline mr-2">
                                                                {{ isset($ProductService::$aryActionDB[$value->action]) ? $ProductService::$aryActionDB[$value->action] : '' }}
                                                            </span>
                                                        @endif
                                                    </td>

                                                    <td class="align-middle">
                                                        {{ $value->name }}
                                                    </td>

                                                    <td class="align-middle">
                                                        {{ $value->user_name_c }}
                                                    </td>
                                                </tr>

                                                <tr class="content-{{ $value->product_id }}" style="display: none ">
                                                    <td colspan="5">
                                                        <div class="d-flex justify-content-between">
                                                            @php
                                                                $before = json_decode($value->content_before, true);
                                                                $after = json_decode($value->content_after, true);
                                                            @endphp
                                                            <table class="tb-ct" style="width: 100%; border: none" border="1">
                                                                <tr>
                                                                    <td class="font-weight-bold" style="width: 200px"></td>
                                                                    <td class="font-weight-bold" width="40%">Trước</td>
                                                                    <td class="font-weight-bold" width="40%">Sau</td>
                                                                </tr>

                                                                <tr>
                                                                    <td>Ảnh</td>
                                                                    <td>
                                                                        @if(isset($before['image']))
                                                                            <img src="{{ $before['image'] }}" alt="" class="img-thumbnail" style="width: 120px; height: 120px; object-fit: cover">
                                                                        @else
                                                                            -
                                                                        @endif
                                                                    </td>
                                                                    <td>
                                                                        @if(isset($after['image']))
                                                                            <img src="{{ $after['image'] }}" alt="" class="img-thumbnail" style="width: 120px; height: 120px; object-fit: cover">
                                                                        @else
                                                                            -
                                                                        @endif
                                                                    </td>
                                                                </tr>

                                                                <tr>
                                                                    <td>Colors</td>
                                                                    <td>
                                                                        <div class="d-flex flex-wrap">
                                                                            @if(isset($before['colors']))
                                                                                @foreach(json_decode($before['colors'], true) as $key => $value )
                                                                                    <div class="mr-2">
                                                                                        <img src="{{ isset($value['image']) ? $value['image'] : ''  }}" alt="" class="img-thumbnail" style="width: 120px; height: 120px; object-fit: cover">
                                                                                        <div class="text-center font-weight-bold mt-2">{{ isset($value['name']) ? $value['name'] : '' }}</div>
                                                                                    </div>
                                                                                @endforeach
                                                                            @endif
                                                                        </div>
                                                                    </td>

                                                                    <td>
                                                                        <div class="d-flex flex-wrap">
                                                                            @if(isset($after['colors']))
                                                                                @foreach(json_decode($after['colors'], true) as $key => $value )
                                                                                    <div class="mr-2">
                                                                                        <img src="{{ isset($value['image']) ? $value['image'] : ''  }}" alt="" class="img-thumbnail" style="width: 120px; height: 120px; object-fit: cover">
                                                                                        <div class="text-center font-weight-bold mt-2">{{ isset($value['name']) ? $value['name'] : '' }}</div>
                                                                                    </div>
                                                                                @endforeach
                                                                            @endif
                                                                        </div>
                                                                    </td>
                                                                </tr>

                                                                <tr>
                                                                    <td>Tên</td>
                                                                    <td>{{ isset($before['name']) ? $before['name'] : '-'}}</td>
                                                                    <td>{{ isset($after['name'])  ? $after['name'] : ''}}</td>
                                                                </tr>

                                                                <tr>
                                                                    <td>Giá</td>
                                                                    <td>{{ isset($before['price']) ? number_format($before['price']).' đ' : '-'}}</td>
                                                                    <td>{{ isset($after['price'])  ? number_format($after['price']).' đ' : ''}}</td>
                                                                </tr>

                                                                <tr>
                                                                    <td>Giảm giá</td>
                                                                    <td>{{ isset($before['price_discount']) ? number_format($before['price_discount']).' đ' : '-'}}</td>
                                                                    <td>{{ isset($after['price_discount'])  ? number_format($after['price_discount']).' đ' : ''}}</td>
                                                                </tr>

                                                                <tr>
                                                                    <td>Bảo hành</td>
                                                                    <td>{{ isset($before['price_discount']) ? number_format($before['price_discount']).' đ' : '-'}}</td>
                                                                    <td>{{ isset($after['price_discount'])  ? number_format($after['price_discount']).' đ' : ''}}</td>
                                                                </tr>

                                                                <tr>
                                                                    <td>Ngày ra mắt</td>
                                                                    <td>{{ isset($before['release_date']) ? date('h:i:s d-m-Y', $before['release_date']) : '-'}}</td>
                                                                    <td>{{ isset($after['release_date'])  ? date('h:i:s d-m-Y', $after['release_date']) : ''}}</td>
                                                                </tr>

                                                                <tr>
                                                                    <td>Chiều cao</td>
                                                                    <td>{{ isset($before['height']) ? $before['height'] : '-'}}</td>
                                                                    <td>{{ isset($after['height'])  ? $after['height'] : ''}}</td>
                                                                </tr>

                                                                <tr>
                                                                    <td>Chiều rộng</td>
                                                                    <td>{{ isset($before['width']) ? $before['width'] : '-'}}</td>
                                                                    <td>{{ isset($after['width'])  ? $after['width']: ''}}</td>
                                                                </tr>

                                                                <tr>
                                                                    <td>Chiều sâu</td>
                                                                    <td>{{ isset($before['depth']) ? $before['depth'] : '-'}}</td>
                                                                    <td>{{ isset($after['depth'])  ? $after['depth'] : ''}}</td>
                                                                </tr>

                                                                <tr>
                                                                    <td>Màn hình</td>
                                                                    <td>{{ isset($before['tech_screen']) ? $before['tech_screen'] : '-'}}</td>
                                                                    <td>{{ isset($after['tech_screen'])  ? $after['tech_screen'] : ''}}</td>
                                                                </tr>

                                                                <tr>
                                                                    <td>Size</td>
                                                                    <td>{{ isset($before['size']) ? $before['size'] : '-'}}</td>
                                                                    <td>{{ isset($after['size'])  ? $after['size'] : ''}}</td>
                                                                </tr>

                                                                <tr>
                                                                    <td>CPU</td>
                                                                    <td>{{ isset($before['cpu']) ? $before['cpu'] : '-'}}</td>
                                                                    <td>{{ isset($after['cpu'])  ? $after['cpu'] : ''}}</td>
                                                                </tr>

                                                                <tr>
                                                                    <td>ram</td>
                                                                    <td>{{ isset($before['ram']) ? $before['ram'] : '-'}}</td>
                                                                    <td>{{ isset($after['ram'])  ? $after['ram'] : ''}}</td>
                                                                </tr>

                                                                <tr>
                                                                    <td>rom</td>
                                                                    <td>{{ isset($before['rom']) ? $before['rom'] : '-'}}</td>
                                                                    <td>{{ isset($after['rom'])  ? $after['rom'] : ''}}</td>
                                                                </tr>

                                                                <tr>
                                                                    <td>Dung lượng pin</td>
                                                                    <td>{{ isset($before['battery_capacity']) ? $before['battery_capacity'] : '-'}}</td>
                                                                    <td>{{ isset($after['battery_capacity'])  ? $after['battery_capacity'] : ''}}</td>
                                                                </tr>

                                                                <tr>
                                                                    <td>camera trước</td></td>
                                                                    <td>{{ isset($before['camera_before']) ? $before['camera_before'] : '-'}}</td>
                                                                    <td>{{ isset($after['camera_before'])  ? $after['camera_before'] : ''}}</td>
                                                                </tr>

                                                                <tr>
                                                                    <td>camera sau</td></td>
                                                                    <td>{{ isset($before['camera_after']) ? $before['camera_after'] : '-'}}</td>
                                                                    <td>{{ isset($after['camera_after'])  ? $after['camera_after'] : ''}}</td>
                                                                </tr>

                                                                <tr>
                                                                    <td>Mô tả</td></td>
                                                                    <td>{!! isset($before['description']) ? $before['description'] : '-' !!}</td>
                                                                    <td>{!! isset($after['description'])  ? $after['description'] : '' !!}</td>
                                                                </tr>

                                                                <tr>
                                                                    <td>Đính kèm</td></td>
                                                                    <td>{!! isset($before['attach']) ? $before['attach'] : '-' !!}</td>
                                                                    <td>{!! isset($after['attach'])  ? $after['attach'] : '' !!}</td>
                                                                </tr>

                                                                <tr>
                                                                    <td>Đính kèm</td></td>
                                                                    <td>
                                                                        @if(isset($before['attach_image']))
                                                                            <img src="{{ $before['attach_image'] }}" class="img-thumbnail" alt="" style="width: 120px; width: 120px; object-fit: cover">
                                                                        @endif
                                                                    </td>
                                                                    <td>
                                                                        @if(isset($after['attach_image']))
                                                                            <img src="{{ $after['attach_image'] }}" class="img-thumbnail" alt="" style="width: 120px; width: 120px; object-fit: cover">
                                                                        @endif
                                                                    </td>
                                                                </tr>

                                                            </table>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @endif
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <div>
{{--                                {{ $products->links() }}--}}
                            </div>

                            <!--end::Wizard Body-->
                        </div>
                        <!--end::Wizard-->
                    </div>
                    <!--end::Wizard-->
                </div>
            </div>
            <!--end::Container-->
        </div>
        <!--end::Entry-->
    </div>

@endsection

@section('custom_js')
    <script>
        $(document).ready(function (){
            $('.show-content').on('click', function (){
                let id = $(this).data('id')
                let show = $(this).attr('data-show')
                if (show == 0) {
                    $('.content-'+id).show('200')
                    $(this).attr('data-show', 1)
                } else {
                    $('.content-'+id).hide('200')
                    $(this).attr('data-show', 0)
                }
            })
        })
    </script>
@endsection


