<table border="1" style="border-collapse: collapse; border: 1px solid red" cellpadding="8">
    <tr>
        <td colspan="7" style="text-align: center">Thông tin đơn hàng</td>
    </tr>
    <tr>
        <th>Mã đơn hàng</th>
        <th>Người nhận</th>
        <th>Email</th>
        <th>SDT</th>
        <th>Nơi nhận</th>
        <th>Tổng thanh toán</th>
        <th>Thời gian</th>
    </tr>
    <tr>
        <td>{{ $order->id }}</td>
        <td>{{ $order->shipping->receive ? $order->shipping->receive : '' }}</td>
        <td>{{ $order->shipping->email ? $order->shipping->email : '' }}</td>
        <td>{{ $order->shipping->phone ? $order->shipping->phone : '' }}</td>
        <td>{{ $order->shipping->address ? $order->shipping->address : '' }}</td>
        <td>{{ $order->total }} đ</td>
        <td>{{ date('h:s d/m/Y', $order->date_c) }}</td>
    </tr>
</table>
<br>
<table border="1" style="border-collapse: collapse" cellpadding="8">
    <tr>
        <td colspan="7" style="text-align: center">Chi tiết đơn hàng</td>
    </tr>
    <tr>
        <th>#</th>
        <th>Mã SP</th>
        <th>Tên SP</th>
        <th>Thương hiệu</th>
        <th>Giá</th>
        <th>Số lượng</th>
        <th>Tổng tiền</th>
    </tr>

    @if(sizeof($order->details) > 0)
        @php $i = 1 @endphp
        @foreach($order->details as $k => $v)
            <tr>
                <td>{{ $i++ }}</td>
                <td>{{ $v->product_id }}</td>
                <td>{{ $v->product_name }}</td>
                <td>{{ $v->brand_name }}</td>
                <td>{{ $v->price }}</td>
                <td>{{ $v->qty }}</td>
                <td>{{ $v->total }}</td>
            </tr>
        @endforeach
    @endif

</table>
