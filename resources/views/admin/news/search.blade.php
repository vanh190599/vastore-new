@extends('admin.layout.main')
@section('title')
    Danh mục tin tức
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
                        <h5 class="text-dark font-weight-bold my-1 mr-5">Tin tức</h5>
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
                                <div class="wizard-steps p-8 p-lg-10">
                                    <form action="{{ route('admin.news.search') }}" method="get">
                                        <div class="row">
                                            <div class="col-lg-4">
                                                <div class="form-group fv-plugins-icon-container">
                                                    <label>Tên</label>
                                                    <input type="text" class="form-control form-control-solid form-control-lg" name="title" placeholder="Tên" value="{{ request('title') }}">
                                                    <div class="fv-plugins-message-container"></div>
                                                </div>
                                            </div>

                                            <div class="col-lg-4">
                                                {{--<div class="form-group fv-plugins-icon-container">
                                                    <label>Trạng thái</label>
                                                    <select type="text" class="form-control form-control-solid form-control-lg" name="status">
                                                        @if(!empty($aryStatus) && count($aryStatus) > 0 )
                                                            @foreach($aryStatus as $key => $val)
                                                                <option @if(request('status') == $key) selected @endif value="{{ $key }}">{{ $val }}</option>
                                                            @endforeach
                                                        @endif
                                                        <option value="-1" @if(request('status') == null || request('status') == -1) selected @endif == $key >Tất cả</option>
                                                    </select>
                                                    <div class="fv-plugins-message-container"></div>
                                                </div>--}}
                                            </div>

                                            <div class="col-lg-4 d-flex align-items-center justify-content-end">
                                                <a href="{{ route('admin.news.create') }}" class="btn btn-lg btn-success mr-4">
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
                                            <th scope="col">#</th>
                                            <th scope="col">Ảnh</th>
                                            <th scope="col">Tiêu đề</th>
                                            <th scope="col">Danh mục</th>
                                            <th scope="col" width="400">Mô tả ngắn</th>
                                            <th scope="col" width="100">Hoạt động</th>
                                            <th scope="col" width="150">Hành động</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @if(! empty($news))
                                            @foreach($news as $key => $value)
                                                <tr>
                                                    <td class="align-middle">{{ $key + $news->firstItem() }}</td>
                                                    <td class="align-middle"><img src="{{ $value->image }}" width="90" height="90" alt="" style="object-fit: cover"></td>
                                                    <td class="align-middle">{{ isset($value->cate->name) ? $value->cate->name : ''   }}</td>
                                                    <td class="align-middle">{{ $value->title }}</td>
                                                    <td class="align-middle">{{ $value->description }}</td>
                                                    <td class="align-middle">
                                                        <label class="switch switch-brand">
                                                            <input type="checkbox" disabled class="change-status" @if($value->status == $CGlobal::STATUS_SHOW) checked @endif>
                                                            <span class="slider round"></span>
                                                        </label>
                                                    </td>
                                                    <td class="align-middle">
                                                        <a href="{{ route('admin.news.edit', ['id' => $value->id]) }}" class="btn btn-icon btn-light btn-hover-warning btn-sm mr-2"
                                                           data-container="body" data-toggle="popover" data-placement="bottom"
                                                           data-content="Sửa" data-original-title="" title="">
                                                            <i class="la la-edit"></i>
                                                        </a>

                                                        <a href="javascript:void(0)" class="btn btn-icon btn-light btn-hover-danger btn-sm mr-2"
                                                           data-container="body" data-toggle="popover" data-placement="bottom"
                                                           data-content="Xóa" data-id="2" onclick="openDelete({{ $value->id }})"
                                                           data-original-title="" title="">
                                                            <i class="la la-trash"></i>
                                                        </a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @endif
                                        </tbody>
                                    </table>
                                </div>
                                <div>{{ $news->links() }}</div>
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
    <script>

        function openDelete(id){
            Swal.fire({
                title: 'Bạn có muốn xóa tin tức này',
                text: 'name',
                icon: "question",
                buttonsStyling: false,
                confirmButtonText: "<i class='la la-lock'></i> Đồng ý!",
                showCancelButton: true,
                cancelButtonText: "<i class='la la-window-close'></i> Hủy",
                reverseButtons: true,
                customClass: {
                    confirmButton: "btn btn-danger",
                    cancelButton: "btn btn-default"
                }
            }).then(function(result) {
                if (result.value) {
                    init.showLoader('.content')
                    confirmDelete(id)
                }
            });
        }

        function confirmDelete(id) {
            let url = BASE_URL + '/admin/news/delete'
            let data = { id }
            $.post(url, data, function(res){
                if (res.success == 1) {
                    toastr.success(res.message)
                    init.hideLoader('.content')
                    setTimeout(function(){
                        window.location.reload()
                    }, 1000);
                } else {
                    toastr.error(res.message)
                    setTimeout(function(){
                        window.location.reload()
                    }, 1000);
                }
            })
        }

    </script>
@endsection
