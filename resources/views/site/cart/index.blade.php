@extends('site.layout.main')
@section('title')
    <title>Giỏ hàng</title>
@endsection
@section('content')
    <style>
        .title-text {
            color: orangered;
            font-weight: 700;
            font-size: 18px;
        }
    </style>

    <p class="text-center title-text">GIỎ HÀNG CỦA BẠN</p>
    @if(session()->has('error'))
        <div class="mb-5" style="margin:10px 0 10px 0; font-size: 15px; color: red">{{ session('error') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
        <tr>
            <th>#</th>
            <th>Ảnh</th>
            <th>Tên sản phẩm</th>
            <th>Giá</th>
            <th>Số lượng</th>
            <th>Tổng</th>
            <th>Hành động</th>
        </tr>
        </thead>

        <tbody>
        @if(!empty($data))
            @php $stt = 1 @endphp
            @foreach($data as $key => $value)
            <tr>
                <td>{{ $stt++ }}</td>
                <td><img src="{{$value->model->image}}" alt="" width="100px" height="100px" style="object-fit: cover"></td>
                <td>{{ $value->name }}</td>
                <td>{{ number_format($value->price) }} đ </td>
                <td>
                    <form action="{{ route('site.cart.update') }}" method="post">
                        @csrf
                        <div style="display: flex" >
                            <input type="number" min="1"  class="form-control" name="qty_update" value="{{ $value->qty }}" style="width: 80px;"> &nbsp;
                            <button class="btn btn-default">Cập nhật</button>
                            <input type="hidden" name="rowID" value="{{$key}}">
                            <input type="hidden" name="id" value="{{$value->id}}">
                        </div>
                    </form>
                </td>
                <td>{{ number_format($value->price * $value->qty)  }} đ </td>
                <td>
                    <form action="{{ route('site.cart.delete') }}" method="post">
                        @csrf
                        <input type="hidden" name="rowID" value="{{ $key }}">
                        <button type="submit" class="btn btn-default">Xóa</button>
                    </form>
                </td>
            </tr>
            @endforeach
        @endif
            <tr>
                <td colspan="7" class="text-right">
                    <span style="font-size: 20px">Thành tiền: <span class="text-danger">{{  Cart::subtotal() }} đ</span>  </span>
                </td>
            </tr>
        </tbody>
    </table>
    @if(! empty($data))
        <div class="text-center">
            <a href="{{ route('site.cart.shipping') }}" class="btn btn-lg btn-danger">ĐẶT HÀNG</a>
        </div>
    @endif
@endsection

@section('custom_js')
    <script>
        $(document).ready(function (){
            $('[data-toggle="tooltip"]').tooltip();
        })
    </script>
@endsection
