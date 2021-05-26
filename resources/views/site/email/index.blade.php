<div style="font-size: 16px; padding: 10px 0">
    Cảm ơn bạn đã mua sản phẩm của chúng tôi!
</div>

<table style="border-collapse: collapse" border="1" cellpadding="10">
    <thead>
        <tr>
            <th>#</th>
            <th>tên sản phẩm</th>
            <th>giá</th>
            <th>số lượng</th>
            <th>tổng</th>
        </tr>
    </thead>

    <tbody>
        @if(isset($data))
            @php $i = 1 @endphp
            @foreach($data as $key => $value)
                <tr>
                    <td>
                        {{ $i++ }}
                    </td>

                    <td>
                        {{ isset($value->name) ? $value->name : '' }}
                    </td>

                    <td>
                        {{ isset($value->price) ? number_format($value->price) : 0 }} đ
                    </td>

                    <td>
                        {{ isset($value->qty) ? $value->qty : 0 }}
                    </td>

                    <td>
                        {{ isset($value->qty) && isset($value->price) ? number_format($value->price * $value->qty) : 0  }} đ
                    </td>
                </tr>
            @endforeach
            <tr>
                <td colspan="5" style="text-align: right">
                    <b>Thành tiền: <span style="color: red"> {{ number_format(intval(preg_replace('/[^\d\.]/', '',  Cart::subtotal()))) }} đ</span></b>
                </td>
            </tr>
        @endif
    </tbody>
</table>
