@extends('layouts.app')

@section('content')
    <div class="container">
        <ol class="breadcrumb">
            <li><a href="{{ route('order_list') }}">订单列表</a></li>
        </ol>
        <div class="panel panel-default">
            <div class="panel-heading">订单详情</div>
            <div class="panel-body">
                <form class="form-horizontal">
                    <div class="form-group">
                        <label class="control-label col-sm-2">订单编号</label>
                        <div class="col-sm-10">
                            <p class="form-control-static">{{ $order->sn }}</p>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-2">下单方</label>
                        <div class="col-sm-10">
                            <p class="form-control-static">{{ $order->owner->nickname }}</p>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-2">发布方</label>
                        <div class="col-sm-10">
                            <p class="form-control-static">{{ $order->publisher->nickname }}</p>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-2">订单类型</label>
                        <div class="col-sm-10">
                            <p class="form-control-static">{{ $order->getTypeText() }}</p>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-2">成交单价</label>
                        <div class="col-sm-10">
                            <p class="form-control-static">{{ $order->price }}</p>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-2">成交价(CNY)</label>
                        <div class="col-sm-10">
                            <p class="form-control-static">{{ $order->amount }}</p>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-2">比特币数量</label>
                        <div class="col-sm-10">
                            <p class="form-control-static">{{ $order->quantity }}</p>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-2">订单状态</label>
                        <div class="col-sm-10">
                            <p class="form-control-static">{{ $order->getStatusText() }}</p>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-2">创建时间</label>
                        <div class="col-sm-10">
                            <p class="form-control-static">{{ $order->create_time }}</p>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-2">更新时间</label>
                        <div class="col-sm-10">
                            <p class="form-control-static">{{ $order->update_time }}</p>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-2">付款时间</label>
                        <div class="col-sm-10">
                            <p class="form-control-static">{{ $order->payment_time }}</p>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-2">收款时间</label>
                        <div class="col-sm-10">
                            <p class="form-control-static">{{ $order->receipt_time }}</p>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-2">完成时间</label>
                        <div class="col-sm-10">
                            <p class="form-control-static">{{ $order->finish_time }}</p>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
