@extends('site.layout.main')
@section('title')
    <title>Trang chủ</title>
@endsection
@section('content')
    <style>

    </style>

    <form action="{{ route('site.sendMail') }}" method="post">
        @csrf
        <button class="btn btn-primary">Send Mail</button>
    </form>

    <div id="look-up" class="row">
        <div class="col-lg-12">
            <div style="font-size: 20px">
                Tra cứu sản phẩm mà bạn đã mua
            </div>
            <br>
            <div style="width: 50%">
                <form action="{{ route('site.submitLookUp') }}">
                    <div class="d-flex box-look-up" >
                        <input type="text" name="phone" value="{{ request('phone') }}" class="form-control" placeholder="Nhập số điện thoại mà bạn đặt hàng" checked>
                        <button  class="btn "><span class="glyphicon glyphicon-search"></span> </button>
                    </div>
                </form>
            </div>
            <hr>

                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th width="130px">Ảnh</th>
                        <th>Tên</th>
                        <th>Hiệu lực bảo hành</th>
                        <th>Ngày hết hạn</th>
                        <th>Người nhận</th>
                        <th>Nhận hàng</th>
                    </tr>
                    </thead>
                    <tbody>
                        @if(!empty($products) && sizeof($products) > 0)
                            @foreach($products as $key => $value)
                                <tr>
                                    <td>
                                        <img src="{{ $value->product_image }}" alt="" width="120px" style="object-fit: cover">
                                    </td>
                                    <td class="align-middle">{{ $value->product_name }}</td>
                                    <td class="align-middle">
                                        @if ($value->expired_time < time())
                                        <div class="label label-danger">
                                            Hết bảo hành
                                        </div>
                                        @else
                                        <div class="label label-primary">
                                            Bảo hành
                                        </div>
                                        @endif
                                    <td class="align-middle">{{ date('H:i d-m-Y', $value->expired_time ) }} </td>
                                    <td class="align-middle">{{ $value->receive }}</td>
                                    <td class="align-middle">{{ date('H:i d-m-Y', $value->date) }}</td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="6" class="text-center">Bạn chưa mua sản phẩm nào</td>
                            </tr>
                        @endif
                    </tbody>
                </table>

        </div>
    </div>

@endsection

@section('custom_css')
    <style>
        .form-control {
            height: 40px;
            border-radius: 0;
        }
        .align-middle {
            vertical-align: middle !important;
        }
        .label-primary { background: #1bc5bd !important;}
    </style>
@endsection

@section('custom_js')
    <script>
        $(document).ready(function (){
            $('[data-toggle="tooltip"]').tooltip();
        })
    </script>
@endsection
