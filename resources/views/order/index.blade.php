@extends('layouts.app')

@section('content')
    <div class="container">
        <ol class="breadcrumb">
            <li class="active">订单管理</li>
        </ol>
        <div class="panel panel-default">
            <div class="panel-heading">查询条件</div>
            <div class="panel-body">
                <div class="well">
                    <form action="{{route('order_list')}}" method="get" class="form-horizontal">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label class="control-label col-sm-2">用户昵称</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" name="nickname" value="{{request('nickname')}}">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-10">
                                <button type="submit" class="btn btn-default">提交</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <table class="table">
                <thead>
                <tr>
                    <th>创建时间</th>
                    <th>出售方</th>
                    <th>购买方</th>
                    <th>交易金额</th>
                    <th>币种数量</th>
                    <th>状态</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($orderList as $order)
                    <tr>
                        <td>{{$order->create_time}}</td>
                        <td>{{$order->ad_uname}}</td>
                        <td>{{$order->uname}}</td>
                        <td>{{$order->amount}}</td>
                        <td>{{$order->quantity}}</td>
                        <td>{{ \OtcCms\Models\OrderStatus::valueOf($order->status)->getText() }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            {{ $orderList->links() }}
        </div>
    </div>
@endsection
