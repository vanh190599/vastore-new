@extends('admin.layout.main')
@section('title')
    Chi tiết đơn hàng
@endsection
@push('scripts')
     <script src="{{ asset('admin/js/page/admin_account.js') }}"></script>
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
                        <h5 class="text-dark font-weight-bold my-1 mr-5">Chi tiết đơn hàng</h5>
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

                                            <div class="col-lg-4">
                                                <div class="form-group fv-plugins-icon-container">
                                                    <label>Trạng thái</label>
                                                    <select type="text" class="form-control form-control-solid form-control-lg" name="is_active">
                                                        <option value="0">Tất cả</option>
                                                        <option value="0">Đã hủy</option>
                                                        <option value="0">Đang chờ</option>
                                                    </select>
                                                    <div class="fv-plugins-message-container"></div>
                                                </div>
                                            </div>

                                            <div class="col-lg-4">
                                                {{--                                                <div class="form-group fv-plugins-icon-container">--}}
                                                {{--                                                    <label>Từ ngày</label>--}}
                                                {{--                                                    <input type="text" class="form-control form-control-solid form-control-lg" name="from" value="{{ request('from') }}">--}}
                                                {{--                                                    <div class="fv-plugins-message-container"></div>--}}
                                                {{--                                                </div>--}}
                                            </div>

                                            <div class="col-lg-4">
                                                {{--                                                <div class="form-group fv-plugins-icon-container">--}}
                                                {{--                                                    <label>Đến ngày</label>--}}
                                                {{--                                                    <input type="text" class="form-control form-control-solid form-control-lg" name="to" value="{{ request('to') }}">--}}
                                                {{--                                                    <div class="fv-plugins-message-container"></div>--}}
                                                {{--                                                </div>--}}
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
                                            <th scope="col">Ảnh</th>
                                            <th scope="col">Tên sản phẩm</th>
                                            <th scope="col">Tên thương hiệu</th>
{{--                                            <th scope="col">Giá</th>--}}
                                            <th scope="col">Số lượng</th>
                                            <th scope="col">Tổng tiền</th>
                                            <th scope="col">Hành động</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @if(! empty($details))
                                            @foreach($details as $key => $value)
                                                <tr>
                                                    <td class="align-middle">{{ $key + $details->firstItem() }}</td>
                                                    <td class="align-middle">
                                                        <img src="{{ asset('admin/upload/') }}/{{ $value->product_image }}" alt="" style="width: 150px; height: 150px; object-fit: cover">
                                                    </td>
                                                    <td class="align-middle">{{ $value->product_name }}</td>
                                                    <td class="align-middle">{{ $value->brand_name }}</td>
{{--                                                    <td class="align-middle">{{ $value->price }}</td>--}}
                                                    <td class="align-middle">{{ $value->qty }}</td>
                                                    <td class="align-middle">{{ number_format($value->total) }} đ</td>
                                                    <td class="align-middle">--</td>
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
