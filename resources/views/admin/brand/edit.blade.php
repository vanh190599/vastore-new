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
                                    <form action="{{ route('admin.brand.edit', ['id' => $brand->id]) }}" class="form fv-plugins-bootstrap fv-plugins-framework" method="POST"  id="kt_form">
                                    @csrf
                                    <!--begin::Wizard Step 1-->
                                        <div class="pb-0" data-wizard-type="step-content" data-wizard-state="current">
                                            <h3 class="mb-10 font-weight-bold text-dark">Nhập thông tin thương hiệu</h3>

                                            <!--begin::Input-->
                                            <div class="form-group fv-plugins-icon-container">
                                                <label>Tên<span class="text-danger">*</span></label>
                                                <input type="text" class="form-control form-control-solid form-control-lg"
                                                       name="name" placeholder="Nhập tên thương hiệu"
                                                       value="{{ old('name', $brand->name) }}">
                                                @error('name')
                                                <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                                <div class="text-danger"></div>
                                                <span class="form-text text-muted d-none">Hãy nhập đầy đủ họ và tên</span>
                                                <div class="fv-plugins-message-container"></div></div>
                                            <!--begin::Input-->
                                            <div class="form-group">
                                                <label>Mô tả <span class="text-danger">*</span></label>
                                                <textarea name="description" value="{{ old('description', $brand->description) }}"
                                                          id="" class="form-control form-control-solid" cols="30" rows="10"
                                                          placeholder="Mô tả">{{$brand->description}}</textarea>
                                                @error('description')
                                                <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                                <span class="form-text text-muted d-none">Hãy nhập email cá nhân</span>
                                            </div>
                                            <!--end::Input-->

                                            <div class="form-group">
                                                <label>Tải ảnh <span class="text-danger">*</span></label><br>
                                                <input type="file" id="file" >
                                                <input type="hidden" name="image">
                                                <br>
                                                <br>
                                                <img id="image" src="" alt="" style="object-fit: cover; height: 30px; display: none; border: 1px solid #dddddd">
                                                @if(! empty($brand->image))
                                                     <img id="old-image" src="{{ $brand->image }}" alt="" style="object-fit: cover; height: 30px; border: 1px solid #dddddd">
                                                @endif
                                            </div>

                                            <div class="form-group">
                                                <label>Trạng thái <span class="text-danger">*</span></label><br>
                                                <select id="" class="form-control form-control-solid" name="status">
                                                    <option value="1" @if($brand->status == 1) selected @endif>Hiển thị</option>
                                                    <option value="-1" @if($brand->status == -1) selected @endif>Ẩn</option>
                                                </select>
                                            </div>

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
        $(document).ready(function (){
            $('#file').on("change", function(e){
                var file_data = e.target.files[0];
                console.log(file_data)
                //lấy ra kiểu file
                var type = file_data.type;
                //set tên cho label
                var name = file_data.name;
                //Xét kiểu file được upload
                var match = ["image/png", "image/jpg", "image/jpeg"];
                //kiểm tra kiểu file
                if (type == match[0] || type == match[1] || type == match[2] || type == match[3] || type == match[4]) {
                    //khởi tạo đối tượng form data
                    var form_data = new FormData();
                    //thêm files vào trong form data
                    form_data.append('file', file_data);
                    //sử dụng ajax post
                    $.ajax({
                        url: BASE_URL + '/admin/uploadFile',
                        cache: false,
                        contentType: false,
                        processData: false,
                        data: form_data,
                        type: 'post',
                        success: function (res) {
                            if (res.success == 1) {
                                let url = BASE_URL + '/admin/upload/'+ res.data;
                                $('#image').attr('src', url).show()
                                $('#old-image').hide()
                                $('input[name="image"]').val(url)
                                toastr.success('Upload thành công!');
                            } else {
                                toastr.error('Upload thất bại!');
                            }
                        }
                    });
                } else {
                    toastr.error('Sai định dạng file!');
                    return false;
                }
            })
        })
    </script>
@endpush
