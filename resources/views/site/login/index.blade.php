@extends('site.layout.main')
@section('title')
    <title>Trang chủ</title>
@endsection
@section('content')
    <style>

    </style>

    <div class="row">
        <div class="col-lg-3"></div>
        <div class="col-lg-6">
            <h4 class="text-center"> Đăng nhập</h4>

            <form method="post" action="{{ route('site.postLogin') }}">
                @csrf
                <div class="form-group">
                    <input type="text" name="email" class="form-control" placeholder="email">
                </div>
                <div class="form-group">
                    <input type="password" name="password" class="form-control" placeholder="password">
                </div>
                @if(session()->has('error_login'))
                    <div class="text-danger mb-5" style="margin-bottom: 10px">{{ session('error_login') }}</div>
                @endif
                <div class="text-center">
                    <a href="{{ route('site.register') }}" class="btn btn-default">Đăng ký</a>
                    <button type="submit" class="btn btn-secondary">Đăng nhập</button>
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
