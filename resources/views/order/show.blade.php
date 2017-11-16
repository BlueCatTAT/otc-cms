@extends('layouts.app')

@section('content')
    <div class="container">
        <ol class="breadcrumb">
            <li><a href="{{ route('order_list') }}">订单列表</a></li>
        </ol>
        @include('mixins.post-message')
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
                        <label class="control-label col-sm-2">成交单价(CNY)</label>
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
                        <label class="control-label col-sm-2">数字货币(BTC)</label>
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
                    @if ($order->hasFinished())
                    <div class="form-group">
                        <label class="control-label col-sm-2">成交手续费</label>
                        <div class="col-sm-10">
                            <p class="form-control-static">{{ $order->fee }}</p>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-2">手续费率</label>
                        <div class="col-sm-10">
                            <p class="form-control-static">{{ $order->rate }}</p>
                        </div>
                    </div>
                    @endif
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
                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                            @if ($order->canBeConfirmed())
                            <button type="button" class="btn btn-default"
                            v-on:click="popupModalFromUrl('{{ route('order_confirm_modal', [$order->id]) }}')">完成订单</button>
                            @endif
                            @if ($order->canBeCancelled())
                            <button type="button" class="btn btn-danger"
                            v-on:click="popupModalFromUrl('{{ route('order_cancel_modal', [$order->id]) }}')">取消订单</button>
                            @endif
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="panel panel-default">
            <div class="panel-heading">操作日志</div>
            @if ($order->auditLogs)
            <table class="table">
                <thead>
                <tr>
                    <th width="25%">操作ID</th>
                    <th>操作目标</th>
                    <th>操作结果</th>
                    <th>操作成功</th>
                    <th>操作人员</th>
                    <th>操作时间</th>
                    <th>备注</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($order->auditLogs as $auditLog)
                    <tr>
                        <td>{{ $auditLog->request_id }}</td>
                        <td>{{ $auditLog->getStatusLog()->getTargetStatusText() }}</td>
                        <td>
                            {{ $auditLog->getStatusLog()->getPreviousStatusText() }} -> {{ $auditLog->getStatusLog()->getPostStatusText() }}
                        </td>
                        <td>{{ $auditLog->is_successful ? '是' : '否' }}</td>
                        <td>{{ $auditLog->cms_uname }}</td>
                        <td>{{ $auditLog->create_time }}</td>
                        <td>{{ $auditLog->comment }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            @else
                <div class="panel-body">没有操作日志</div>
            @endif
        </div>
    </div>
    <div class="modal fade" tabindex="-1" role="dialog" id="cms-modal"></div>
@endsection
