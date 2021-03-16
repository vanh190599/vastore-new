@extends('admin.layout.main')
@section('title')
    Danh sách quản trị viên
@endsection
@push('scripts')
    <script src="{{ asset('admin/js/page/admin_account.js') }}"></script>
@endpush
@inject('CGlobal', 'App\Library\CGlobal' )
@section('content')
    <script src="https://cdn.ckeditor.com/4.16.0/full/ckeditor.js"></script>
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
                        <h5 class="text-dark font-weight-bold my-1 mr-5">Sản phẩm</h5>
                        <!--end::Page Title-->
                        <!--begin::Breadcrumb-->
                        <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
                            <li class="breadcrumb-item">
                                <a href="" class="text-muted">Tạo</a>
                            </li>
{{--                            <li class="breadcrumb-item">--}}
{{--                                <a href="" class="text-muted">Tìm kiếm</a>--}}
{{--                            </li>--}}
                        </ul>
                        <!--end::Breadcrumb-->
                    </div>
                    <!--end::Page Heading-->
                </div>
                <!--end::Info-->

                <!--begin::Toolbar-->
                <div class="d-flex align-items-center">
                    <!--begin::Actions-->

                    <button type="reset" class="btn btn-secondary mr-4">
                        Reset
                    </button>
                    <button form="kt_form" type="submit" class="btn btn-primary">
                        Submit
                    </button>

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
                                <div class="wizard-steps p-8 p-lg-10 d-flex juce">

                                </div>
                            </div>
                            <!--end::Wizard Nav-->
                            <!--begin::Wizard Body-->
                            <div class="row justify-content-center my-10 px-8 my-lg-15 px-lg-10">
                                <div class="col-xl-12 col-xxl-11">
                                    <!--begin::Wizard Form-->
                                    <form action="{{ route('admin.product.create') }}" class="form fv-plugins-bootstrap fv-plugins-framework" method="POST"  id="kt_form">
                                    @csrf
                                    <!--begin::Wizard Step 1-->
                                        <div class="pb-0" data-wizard-type="step-content" data-wizard-state="current">
                                            <h3 class="mb-10 font-weight-bold text-dark">Nhập thông tin cho sản phẩm</h3>
                                            <div class="form-group fv-plugins-icon-container">
                                                <label>Tên sản phẩm <span class="text-danger">*</span></label>

                                                <input type="text" class="form-control form-control-solid form-control-lg"
                                                       name="name" placeholder="Nhập tên sản phẩm"
                                                       value="{{ old('name') }}">
                                                @error('name')
                                                <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                                <div class="text-danger"></div>
                                                <span class="form-text text-muted d-none">Hãy nhập đầy đủ họ và tên</span>
                                                <div class="fv-plugins-message-container"></div>
                                            </div>

                                            <div class="form-group">
                                                <label>Hãng sản xuất <span class="text-danger">*</span></label>
                                                <select name="brand" class="form-control form-control-solid form-control-lg">
                                                    @if(sizeof($brands) > 0)
                                                        @foreach($brands as $key => $value)
                                                            <option value="{{ $key }}">{{ $value }}</option>
                                                        @endforeach
                                                    @endif
                                                </select>
                                            </div>

                                            <div class="form-group fv-plugins-icon-container">
                                                <label>Giá <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control form-control-solid form-control-lg"
                                                       name="price" placeholder="Nhập giá"
                                                       value="{{ old('price') }}">
                                                @error('price')
                                                <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                                <div class="text-danger"></div>
                                                <div class="fv-plugins-message-container"></div>
                                            </div>

                                            <div class="form-group fv-plugins-icon-container">
                                                <label>Giá sau khi giảm <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control form-control-solid form-control-lg"
                                                       name="price_discount" placeholder="Giá sau khi giảm"
                                                       value="{{ old('price_discount') }}">
                                                @error('price_discount')
                                                <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                                <div class="text-danger"></div>
                                                <div class="fv-plugins-message-container"></div>
                                            </div>

                                            <div class="form-group fv-plugins-icon-container">
                                                <label>Bảo hành <span class="text-danger">*</span></label>
                                                <div class="d-flex">
                                                    <input type="text" class="form-control form-control-solid form-control-lg"
                                                           name="unit_num" placeholder=""
                                                           value="{{ old('unit_num') }}" style="width: 250px">

                                                    <div style="width: 10px"></div>
                                                    <select name="unit_label" id="" class="form-control form-control-solid form-control-lg" style="width: 150px">
                                                        @if(count($aryLabel) > 0)
                                                            @foreach($aryLabel as $k => $v)
                                                                <option value="{{ $k }}">{{ $v }}</option>
                                                            @endforeach
                                                        @endif
                                                    </select>
                                                </div>
                                                @error('unit_num')
                                                <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                                <div class="text-danger"></div>
                                                <div class="fv-plugins-message-container"></div>
                                            </div>

                                            <div class="d-flex justify-content-between" >
                                                <div class="form-group fv-plugins-icon-container" style="width: 48%">
                                                    <label>Ngày ra mắt <span class="text-danger">*</span></label>
                                                    <div class="d-flex">
                                                        <input name="release_date" data-provide="datepicker"
                                                               class="form-control form-control-solid form-control-lg">
                                                    </div>
                                                    @error('release_date')
                                                    <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                                    <div class="text-danger"></div>
                                                    <div class="fv-plugins-message-container"></div>
                                                </div>

                                                <div class="form-group fv-plugins-icon-container" style="width: 48%">
                                                    <label>Xuất xứ <span class="text-danger">*</span></label>
                                                    <input type="text" class="form-control form-control-solid form-control-lg"
                                                           name="origin" placeholder="Xuất xứ"
                                                           value="{{ old('origin') }}" >
                                                    @error('origin')
                                                    <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                                    <div class="text-danger"></div>
                                                    <div class="fv-plugins-message-container"></div>
                                                </div>
                                            </div>

                                            <div class="d-flex justify-content-between" >
                                                <div class="form-group fv-plugins-icon-container" style="width: 48%">
                                                    <label>Chiều cao <span class="text-danger">*</span></label>
                                                    <div class="d-flex">
                                                        <input name="height" class="form-control
                                                        form-control-solid form-control-lg" placeholder="Nhập chiều cao"
                                                        value="{{ old('height') }}" >
                                                    </div>
                                                    @error('width')
                                                    <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                                    <div class="text-danger"></div>
                                                    <div class="fv-plugins-message-container"></div>
                                                </div>

                                                <div class="form-group fv-plugins-icon-container" style="width: 48%">
                                                    <label>Chiều rộng <span class="text-danger">*</span></label>
                                                    <input type="text" class="form-control form-control-solid form-control-lg"
                                                           name="width" placeholder="Nhập chiều rộng"
                                                           value="{{ old('width') }}" >
                                                    @error('width')
                                                    <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                                    <div class="text-danger"></div>
                                                    <div class="fv-plugins-message-container"></div>
                                                </div>
                                            </div>

                                            <div  class="d-flex justify-content-between" >
                                                <div class="form-group fv-plugins-icon-container" style="width: 48%">
                                                    <label>Độ dày <span class="text-danger">*</span></label>
                                                    <input type="text" class="form-control form-control-solid form-control-lg"
                                                           name="depth" placeholder="Nhập độ dày"
                                                           value="{{ old('depth') }}" >
                                                    @error('depth')
                                                    <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                                    <div class="text-danger"></div>
                                                    <div class="fv-plugins-message-container"></div>
                                                </div>

                                                <div class="form-group fv-plugins-icon-container" style="width: 48%">
                                                    <label>Chất liệu <span class="text-danger">*</span></label>
                                                    <input type="material" class="form-control form-control-solid form-control-lg"
                                                           placeholder="Nhập chất liệu"
                                                           value="{{ old('material') }}" >
                                                    @error('material')
                                                    <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                                    <div class="text-danger"></div>
                                                    <div class="fv-plugins-message-container"></div>
                                                </div>
                                            </div>

                                            <div class="d-flex justify-content-between" >
                                                <div class="form-group fv-plugins-icon-container" style="width: 48%">
                                                    <label>Công nghệ màn hình <span class="text-danger">*</span></label>
                                                    <div class="d-flex">
                                                        <input name="tech_screen" value="{{ old('tech_screen') }}"
                                                               class="form-control form-control-solid form-control-lg"
                                                               placeholder="Nhập công nghệ màn hình"
                                                        >
                                                    </div>
                                                    @error('tech_screen')
                                                    <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                                    <div class="text-danger"></div>
                                                    <div class="fv-plugins-message-container"></div>
                                                </div>

                                                <div class="form-group fv-plugins-icon-container" style="width: 48%">
                                                    <label>Kích thước <span class="text-danger">*</span></label>
                                                    <input type="text" class="form-control form-control-solid form-control-lg"
                                                           name="size" placeholder="Nhập kích thước (ví dụ: )"
                                                           value="{{ old('size') }}" >
                                                    @error('size')
                                                    <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                                    <div class="text-danger"></div>
                                                    <div class="fv-plugins-message-container"></div>
                                                </div>
                                            </div>

                                            <div class="d-flex justify-content-between" >
                                                <div class="form-group fv-plugins-icon-container" style="width: 48%">
                                                    <label>CPU <span class="text-danger">*</span></label>
                                                    <div class="d-flex">
                                                        <input name="cpu" value="{{ old('cpu') }}" class="form-control form-control-solid form-control-lg"
                                                        placeholder="cpu">
                                                    </div>
                                                    @error('cpu')
                                                    <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                                    <div class="text-danger"></div>
                                                    <div class="fv-plugins-message-container"></div>
                                                </div>

                                                <div class="form-group fv-plugins-icon-container" style="width: 48%">
                                                    <label>Ram <span class="text-danger">*</span></label>
                                                    <input type="text" class="form-control form-control-solid form-control-lg"
                                                           name="ram" placeholder="ram"
                                                           value="{{ old('ram') }}" >
                                                    @error('ram')
                                                    <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                                    <div class="text-danger"></div>
                                                    <div class="fv-plugins-message-container"></div>
                                                </div>
                                            </div>

                                            <div class="d-flex justify-content-between" >
                                                <div class="form-group fv-plugins-icon-container" style="width: 48%">
                                                    <label>Bộ nhớ trong <span class="text-danger">*</span></label>
                                                    <div class="d-flex">
                                                        <input name="rom" value="{{ old('rom') }}" class="form-control form-control-solid form-control-lg"
                                                        placeholder="bộ nhớ trong">
                                                    </div>
                                                    @error('rom')
                                                    <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                                    <div class="text-danger"></div>
                                                    <div class="fv-plugins-message-container"></div>
                                                </div>

                                                <div class="form-group fv-plugins-icon-container" style="width: 48%">
                                                    <label>Dung lượng pin <span class="text-danger">*</span></label>
                                                    <input type="text" class="form-control form-control-solid form-control-lg"
                                                           name="battery_capacity" placeholder=""
                                                           value="{{ old('battery_capacity') }}" >
                                                    @error('battery_capacity')
                                                    <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                                    <div class="text-danger"></div>
                                                    <div class="fv-plugins-message-container"></div>
                                                </div>
                                            </div>

                                            <div class="d-flex justify-content-between" >
                                                <div class="form-group fv-plugins-icon-container" style="width: 48%">
                                                    <label>Camera trước <span class="text-danger">*</span></label>
                                                    <div class="d-flex">
                                                        <input name="camera_before" value="{{ old('camera_before') }}"
                                                               class="form-control form-control-solid form-control-lg"
                                                               placeholder="camera trước"
                                                        >
                                                    </div>
                                                    @error('camera_before')
                                                    <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                                    <div class="text-danger"></div>
                                                    <div class="fv-plugins-message-container"></div>
                                                </div>

                                                <div class="form-group fv-plugins-icon-container" style="width: 48%">
                                                    <label>camera sau <span class="text-danger">*</span></label>
                                                    <input type="text" class="form-control form-control-solid form-control-lg"
                                                           name="camera_after" placeholder="camera sau"
                                                           value="{{ old('camera_after') }}" >
                                                    @error('camera_after')
                                                    <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                                    <div class="text-danger"></div>
                                                    <div class="fv-plugins-message-container"></div>
                                                </div>
                                            </div>

                                            <div class="form-group fv-plugins-icon-container">
                                                <label>Chi tiết <span class="text-danger">*</span></label>
                                                <textarea name="description" id="description" class="form-control form-control-solid form-control-lg"
                                                          cols="30" rows="10">{{ old('description') }}</textarea>
                                                <script>
                                                    CKEDITOR.replace('description');
                                                </script>
                                                @error('description')
                                                <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                                <div class="text-danger"></div>
                                                <div class="fv-plugins-message-container"></div>
                                            </div>

                                            <!-- ảnh đại diện -->
                                            <div class="form-group fv-plugins-icon-container">
                                                <label>Chọn ảnh<span class="text-danger">*</span></label><br>
                                                <input type="file" class="upload-file"
                                                       onchange="handleImage(this.files, 1)" >
                                                <div class="text-danger"></div>
                                                <span class="form-text text-muted d-none"></span>
                                                <div class="fv-plugins-message-container"></div></div>
                                            <input type="hidden" name="image" value="" >
                                            <div id="image" class="img @if(empty(old('image'))) d-none @endif">
                                                <img src="{{ old('image') }}" width="200px" height="200px" alt="" style="object-fit: cover">
                                            </div>
                                            <!-- end ảnh đại diện -->

                                            <!-- ảnh đính kèm -->
                                            <div class="form-group fv-plugins-icon-container">
                                                <label>Chọn ảnh phụ kiện đính kèm<span class="text-danger">*</span></label><br>
                                                <input type="file" class="upload-file"
                                                       onchange="handleImage(this.files, 2)" >
                                                <div class="text-danger"></div>
                                                <div class="fv-plugins-message-container"></div></div>
                                            <input type="hidden" name="attach_image" value="" >
                                            <div id="attach-image" class="img @if(empty(old('attach_image'))) d-none @endif">
                                                <img src="{{ old('attach_image') }}"
                                                     width="200px" height="200px" alt="" style="object-fit: cover">
                                            </div>
                                           <!-- end ảnh đính kèm -->

                                            <div class="form-group fv-plugins-icon-container">
                                                <label>Phụ kiện đính kèm <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control form-control-solid form-control-lg"
                                                       name="attach" placeholder="Phụ kiện"
                                                       value="{{ old('attach') }}">
                                                @error('attach')
                                                <div class="text-danger">{{ $message }}</div>
                                                @enderror
                                                <div class="fv-plugins-message-container"></div>
                                            </div>
                                            <br>
                                            <!--begin::Wizard Actions-->
{{--                                            <div class="d-flex justify-content-center border-top  pt-5">--}}
{{--                                                <div class="text-center">--}}
{{--                                                    <button type="reset" class="btn btn-secondary mr-4">--}}
{{--                                                        Reset--}}
{{--                                                    </button>--}}
{{--                                                    <button type="submit" class="btn btn-primary">--}}
{{--                                                        Submit--}}
{{--                                                    </button>--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
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

    <script src="{{ asset('assets/admin/assets/js/jquery.js') }}"></script>
    <script>
        function handleImage(files, up) {
                var file_data = files[0];
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
                                let url = '{{ asset('admin/upload/') }}' +'/'+ res.data;
                                //alert(type)
                                if (up == 1) {
                                    $('#image').removeClass('d-none')
                                    $('#image').find('img').attr('src', url)
                                    $("input[name='image']").val(res.data)
                                    toastr.success('Upload thành công!');
                                }
                                if (up == 2) {
                                    $('#attach-image').removeClass('d-none')
                                    $('#attach-image').find('img').attr('src', url)
                                    $("input[name='attach_image']").val(res.data)
                                    toastr.success('Upload thành công!');
                                }
                            } else {
                                toastr.error('Upload thất bại!');
                            }
                        }
                    });
                } else {
                    toastr.error('Sai định dạng file!');
                    return false;
                }
            }
    </script>
@endsection

@section('custom_js')
    <script>
        $('.datepicker').datepicker();
    </script>
@endsection
