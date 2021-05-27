@extends('admin.layout.main')
@section('title')
    Danh sách đơn hàng
@endsection
@push('scripts')
    {{--    <script src="{{ asset('admin/js/page/admin_account.js') }}"></script>--}}
@endpush
@inject('CGlobal', 'App\Library\CGlobal' )

@section('content')
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
                        <h5 class="text-dark font-weight-bold my-1 mr-5">Đơn hàng</h5>
                        <!--end::Page Title-->
                        <!--begin::Breadcrumb-->
                        <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
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
            <div class="container">
                <div class="card card-custom">
                    <div class="card-body p-0">
                        <!--begin::Wizard-->
                        <div class="wizard wizard-1" id="kt_wizard" data-wizard-state="first" data-wizard-clickable="false">
                            <!--begin::Wizard Nav-->
                            <div class="wizard-nav border-bottom">
                                <div class="wizard-steps p-8 p-lg-12">
                                    <form action="{{ route('admin.order.search') }}" method="get">
                                        <div class="row">
                                            <div class="col-lg-4">
                                                <div class="form-group fv-plugins-icon-container">
                                                    <label>Mã đơn hàng</label>
                                                    <input type="text" class="form-control form-control-solid form-control-lg" name="id" placeholder="Mã đơn" value="{{ request('id') }}">
                                                    <div class="fv-plugins-message-container"></div>
                                                </div>
                                            </div>

                                            <div class="col-lg-4">
                                                <div class="form-group fv-plugins-icon-container">
                                                    <label>Tên người đặt hàng</label>
                                                    <input type="text" class="form-control form-control-solid form-control-lg" name="user_name_c" placeholder="Tên người đặt hàng" value="{{ request('user_name_c') }}">
                                                    <div class="fv-plugins-message-container"></div>
                                                </div>
                                            </div>


                                            <div class="col-lg-4 d-flex align-items-center justify-content-end">
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
                                            <th scope="col">#</th>
                                            <th scope="col">Mã đơn hàng</th>
                                            <th scope="col">Người đặt hàng</th>
                                            <th scope="col">Sản phẩm</th>
                                            <th scope="col">Tổng tiền</th>
{{--                                            <th scope="col">time</th>--}}
                                            <th scope="col">method</th>
                                            <th scope="col">Xem chi tiết</th>
                                            <th scope="col">Xuất hóa đơn</th>
{{--                                            <th scope="col">Hành động</th>--}}
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @if(! empty($orders))
                                            @foreach($orders as $key => $value)
                                                <tr>
                                                    <td class="align-middle">{{ $key + $orders->firstItem() }}</td>
                                                    <td class="align-middle">{{ $value->id }}</td>
                                                    <td class="align-middle">{{ $value->user_name_c }}</td>
                                                    <td class="align-middle">
                                                        @if(sizeof($value->details) > 0)
                                                            @foreach($value->details as $k => $detail)
                                                               <span class="d-block">{{ $k + 1 }}. {{ $detail->product_name }} (x{{ $detail->qty }})</span>
                                                            @endforeach
                                                        @endif
                                                    </td>

                                                    <td>{{ $value->total }} đ</td>

{{--                                                    <td>{{ date( 'h:i:s d-m-Y',$value->date_c) }}</td>--}}

                                                    <td>
                                                        @if($value->type_payment == 1) Tiền mặt
                                                        @elseif($value->type_payment == 2)
                                                            Chuyển khoản
                                                        @else
                                                            -
                                                        @endif
                                                    </td>

                                                    <td class="align-middle">
                                                        <a href="{{ route('admin.order.detail', ['order_id'=>$value->id]) }}" class="btn btn-sm btn-outline-primary">Chi tiết</a>
                                                    </td>

                                                    <td class="align-middle">
                                                        <a href="javascript:void(0)" class="btn btn-sm btn-outline-primary">Xem</a>
                                                        <a href="{{ route('admin.export.order', [$value->id]) }}" class="btn btn-sm btn-outline-warning">Xuất hóa đơn</a>
                                                    </td>

{{--                                                    <td class="align-middle">--}}
{{--                                                        <a href="{{ route('admin.brand.edit', ['id' => $value->id]) }}" class="btn btn-icon btn-light btn-hover-warning btn-sm mr-2"--}}
{{--                                                           data-container="body" data-toggle="popover" data-placement="bottom"--}}
{{--                                                           data-content="Sửa" data-original-title="" title="">--}}
{{--                                                            <i class="la la-edit"></i>--}}
{{--                                                        </a>--}}

{{--                                                        <a href="javascript:void(0)" class="btn btn-icon btn-light btn-hover-danger btn-sm mr-2"--}}
{{--                                                           data-container="body" data-toggle="popover" data-placement="bottom"--}}
{{--                                                           data-content="Xóa" data-id="2" onclick="openDelete({{ $value->id }}, {{ $value->name }})"--}}
{{--                                                           data-original-title="" title="">--}}
{{--                                                            <i class="la la-trash"></i>--}}
{{--                                                        </a>--}}
{{--                                                    </td>--}}
                                                </tr>
                                            @endforeach
                                        @endif
                                        </tbody>
                                    </table>
                                </div>
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

@section('scripts')

@endsection
