@extends('site.layout.main')
@section('title')
    <title>Đăng ký</title>
@endsection
@section('content')
    <div class="row">
        <div class="col-lg-3"></div>
        <div class="col-lg-6">
            <h4 class="text-center"> Đăng nhập</h4>
            <form method="post" action="{{ route('site.postRegister') }}">
                @csrf
                <div class="form-group">
                    <label for="">Nhập tên</label>
                    <input type="text" name="name" class="form-control" value="{{ old('name') }}" placeholder="Nhập tên">
                    @error('name')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="">Email</label>
                    <input type="text" name="email" class="form-control" value="{{ old('email') }}" placeholder="email">
                    @error('email')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="">Password</label>
                    <input type="password" name="password" class="form-control" value="{{ old('password') }}" placeholder="password">
                    @error('password')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="">Nhập lại password</label>
                    <input type="password" name="cf_password" class="form-control" value="{{ old('cf_password') }}" placeholder="Nhập lại password">
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
