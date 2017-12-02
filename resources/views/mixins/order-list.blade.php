<table class="table">
    <thead>
    <tr>
        <th>创建时间</th>
        <th>出售方</th>
        <th>购买方</th>
        <th>交易金额</th>
        <th>币种数量</th>
        <th>状态</th>
        <th>操作</th>
    </tr>
    </thead>
    <tbody>
    @foreach ($orderList as $order)
        <tr>
            <td>{{$order->create_time}}</td>
            <td>{{$order->ad_uname}}</td>
            <td>{{$order->uname}}</td>
            <td>{{$order->amount}}</td>
            <td>
                @cryptoicon($order->ad_token_type){{$order->quantity}}
            </td>
            <td>{{ \OtcCms\Models\OrderStatus::valueOf($order->status)->getText() }}</td>
            <td>
                <a href="{{ route('order_detail', [$order->id]) }}"
                   class="glyphicon glyphicon-eye-open"></a>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
{{ $orderList->links() }}
