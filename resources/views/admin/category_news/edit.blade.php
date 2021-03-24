@extends('admin.layout.main')
@section('title')
    Danh sách quản trị viên
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
                        <h5 class="text-dark font-weight-bold my-1 mr-5">Thương hiệu</h5>
                        <!--end::Page Title-->
                        <!--begin::Breadcrumb-->
                        <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
                            <li class="breadcrumb-item">
                                <a href="" class="text-muted">Sửa</a>
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

                                </div>
                            </div>
                            <!--end::Wizard Nav-->
                            <!--begin::Wizard Body-->
                            <div class="row justify-content-center my-10 px-8 my-lg-15 px-lg-10">
                                <div class="col-xl-12 col-xxl-7">
                                    <!--begin::Wizard Form-->
                                    <form action="{{ route('admin.categoryNews.edit', ['id' => $cate->id]) }}" class="form fv-plugins-bootstrap fv-plugins-framework" method="POST"  id="kt_form">
                                    @csrf
                                    <!--begin::Wizard Step 1-->
                                        <div class="pb-0" data-wizard-type="step-content" data-wizard-state="current">
                                            <h3 class="mb-10 font-weight-bold text-dark">Sửa thông tin danh mục tin tức</h3>

                                            <!--begin::Input-->
                                            <div class="form-group fv-plugins-icon-container">
                                                <label>Tên<span class="text-danger">*</span></label>
                                                <input type="text" class="form-control form-control-solid form-control-lg"
                                                       name="name" placeholder="Nhập tên thương hiệu"
                                                       value="{{ old('name', $cate->name) }}">
                                                @error('name')
                                                <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                                <div class="text-danger"></div>
                                                <span class="form-text text-muted d-none">Hãy nhập đầy đủ họ và tên</span>
                                                <div class="fv-plugins-message-container"></div></div>
                                            <!--begin::Input-->
                                            <div class="form-group">
                                                <label>Mô tả <span class="text-danger">*</span></label>
                                                <textarea name="description" value="{{ old('description', $cate->description) }}"
                                                          id="" class="form-control form-control-solid" cols="30" rows="10"
                                                          placeholder="Mô tả">{{$cate->description}}</textarea>
                                                @error('description')
                                                <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                                <span class="form-text text-muted d-none">Hãy nhập email cá nhân</span>
                                            </div>

                                            <div class="form-group">
                                                <select name="status" class="form-control" id="">
                                                    @if(!empty($aryStatus))
                                                        @foreach($aryStatus as $key => $value)
                                                            <option value="{{ $key }}" @if(old('status', $cate->status) == $key)) selected @endif>{{ $value }}</option>
                                                        @endforeach
                                                    @endif
                                                </select>
                                            </div>

                                            <!--end::Input-->
                                            <!--begin::Wizard Actions-->
                                            <div class="d-flex justify-content-center border-top  pt-5">
                                                <div class="text-center">
                                                    <button type="reset" class="btn btn-secondary mr-4">
                                                        Reset
                                                    </button>
                                                    <button type="submit" class="btn btn-primary">
                                                        Submit
                                                    </button>
                                                </div>
                                            </div>
                                        </div>

                                        <!--end::Wizard Actions-->
                                    </form>
                                    <!--end::Wizard Form-->
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

@push('scripts')
    <script>






    </script>
@endpush
