@extends('site.layout.main')
@section('title')
    <title>Đăng ký</title>
@endsection
@section('content')

    <style>
        .input-custom {
            height: 40px !important;
            border-radius: 0 !important;
        }
    </style>

    <div class="row">
        <div class="col-lg-3"></div>
        <div class="col-lg-6">
            <h4 class="text-center">Đăng ký tài khoản</h4>
            <form method="post" action="{{ route('site.postRegister') }}">
                @csrf
                <div class="form-group">
                    <label for="">Nhập tên <span class="text-danger">*</span> </label>
                    <input type="text" name="name" class="form-control input-custom" value="{{ old('name') }}" placeholder="Nhập tên">
                    @error('name')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="">Email <span class="text-danger">*</span></label>
                    <input type="text" name="email" class="form-control input-custom" value="{{ old('email') }}" placeholder="email">
                    @error('email')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="">Password <span class="text-danger">*</span></label>
                    <input type="password" name="password" class="form-control input-custom" value="{{ old('password') }}" placeholder="password">
                    @error('password')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="">Nhập lại password <span class="text-danger">*</span></label>
                    <input type="password" name="cf_password" class="form-control input-custom" value="{{ old('cf_password') }}" placeholder="Nhập lại password">
                    @error('cf_password')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="text-center">
                    <button type="reset" class="btn btn-default">Làm mới</button>
                    <button type="submit" class="btn btn-secondary">Đăng ký</button>
                </div>
            </form>
        </div>

        <div class="col-lg-3"></div>
    </div>
@endsection

@section('custom_js')
    <script>
        $(document).ready(function (){
            $('[data-toggle="tooltip"]').tooltip();
        })
    </script>
@endsection
