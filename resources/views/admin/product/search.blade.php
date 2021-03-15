@extends('admin.layout.main')
@section('title')
    Danh sách sản phẩm
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
                                                    <input type="text" class="form-control form-control-solid form-control-lg" name="email" placeholder="Hãng" value="{{ request('email') }}">
                                                    <div class="fv-plugins-message-container"></div>
                                                </div>
                                            </div>
                                            <div class="col-lg-3">
                                                <div class="form-group fv-plugins-icon-container">
                                                    <label>Màu sắc</label>
                                                    <input type="text" class="form-control form-control-solid form-control-lg" name="phone" placeholder="Màu sắc" value="{{ request('phone') }}">
                                                    <div class="fv-plugins-message-container"></div>
                                                </div>
                                            </div>
                                            <div class="col-lg-3">
                                                <div class="form-group fv-plugins-icon-container">
                                                    <label>Trạng thái</label>
                                                    <select type="text" class="form-control form-control-solid form-control-lg" name="is_active">
                                                        <option value="0">Tất cả</option>
                                                    </select>
                                                    <div class="fv-plugins-message-container"></div>
                                                </div>
                                            </div>
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
                                            <th scope="col">ID</th>
                                            <th scope="col">Ảnh</th>
                                            <th scope="col">Tên</th>
                                            <th scope="col">Hãng</th>
                                            <th scope="col">Mô tả</th>
                                            <th scope="col">Màu sắc</th>
                                            <th scope="col">Giá</th>
                                            <th scope="col">Hành động</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @if(!empty($admins))
                                            @foreach($admins as $key => $value)
                                                <tr>
                                                    <td class="align-middle"> {{ $value->id }} </td>
                                                    <td><img src="{{ asset('admin/upload/admin-account') }}/{{$value->avatar}}" width="50px" height="50px" alt="" style="object-fit: cover"></td>
                                                    <td class="align-middle">{{ $value->name }}</td>
                                                    <td class="align-middle">{{ $value->email }}</td>
                                                    <td class="align-middle">{{ $value->phone }}</td>
                                                    <td class="align-middle">
                                                        @if($value->is_active == $CGlobal::STATUS_ACTIVE)
                                                            <span class="label label-success label-pill label-inline mr-2">
                                                                    {{ $aryStatus[$value->is_active] }}
                                                                </span>
                                                        @elseif($value->is_active == $CGlobal::STATUS_BLOCK)
                                                            <span class="label label-danger label-pill label-inline mr-2">
                                                                    {{ $aryStatus[$value->is_active] }}
                                                                </span>
                                                        @endif
                                                    </td>
                                                    <td></td>
                                                    <td class="align-middle">
                                                        @if($value->is_active == $CGlobal::STATUS_BLOCK)
                                                            <a href="javascript:void(0)" class="btn btn-icon btn-light btn-hover-primary btn-sm mr-2"
                                                               data-container="body"
                                                               data-toggle="popover"
                                                               data-placement="bottom"
                                                               data-content="kích hoạt"
                                                               data-id="{{ $value->id }}"
                                                               data-click='openChangeStatus'>
                                                                <i class="la la-key"></i>
                                                            </a>
                                                        @elseif($value->is_active == $CGlobal::STATUS_ACTIVE)
                                                            <a href="javascript:void(0)" class="btn btn-icon btn-light btn-hover-danger btn-sm mr-2"
                                                               data-container="body"
                                                               data-toggle="popover"
                                                               data-placement="bottom"
                                                               data-content="Khóa"
                                                               data-id="{{ $value->id }}"
                                                               data-click='openChangeStatus'>
                                                                <i class="la la-lock"></i>
                                                            </a>
                                                        @endif

                                                        <a href="javascript:void(0)" class="btn btn-icon btn-light btn-hover-warning btn-sm mr-2"
                                                           data-container="body"
                                                           data-toggle="popover"
                                                           data-placement="bottom"
                                                           data-content="Sửa">
                                                            <i class="la la-edit"></i>
                                                        </a>


                                                        <a href="javascript:void(0)" class="btn btn-icon btn-light btn-hover-danger btn-sm mr-2"
                                                           data-container="body"
                                                           data-toggle="popover"
                                                           data-placement="bottom"
                                                           data-content="Xóa"
                                                           data-email="{{ $value->email }}"
                                                           data-id="{{ $value->id }}"
                                                           data-click="openDelete">
                                                            <i class="la la-trash"></i>
                                                        </a>
                                                    </td>
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
