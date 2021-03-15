Đặt hàng thành công ,cảm ơn <b>{{ session('shipping_name') }}</b> đã tin mua sản phẩm của chúng tôi.<br>
Phương thức thanh toán: @if(session('payment_menthod')==1) Thanh toán sau khi nhận hàng @else Thanh toán qua thẻ ngân hàng @endif
<br>
<p style="font-weight: bold">Chi tiết</p>
<?php $i=1; ?>

    <table border="1" cellpadding="4" style="border-collapse: collapse">
        <tr>
            <th>STT</th>
            <th>Tên</th>
            <th>Giá bán lẻ</th>
            <th>Số lượng</th>
            <th>Tổng</th>
        </tr>
        @foreach(Cart::content() as $rows)
            <tr>
                <td style="text-align: center">{{$i++}}</td>
                <td>{{$rows->name}}</td>
                <td style="text-align: center">{{ number_format($rows->price,0,',','.') }}</td>
                <td style="text-align: center">{{ $rows->qty }}</td>
                <td style="font-weight: bold">{{ number_format($rows->qty*$rows->price,0,',','.') }} đ</td>
            </tr>
        @endforeach
        <tr>
            <td colspan="5" style="text-align: right; ">Tổng thanh toán: <b style="color: red">{{ Cart::priceTotal() }}</b> đ        </td>
        </tr>
    </table>
<br>
Mọi thắc mắc xin liên hệ Admin: <a href="https://www.facebook.com/NguyenVanAnh19051999">Mr.NguyenVanAnh</a>

