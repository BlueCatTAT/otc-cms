@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">查询条件</div>
                <div class="panel-body">
                    <div class="well">
                    <form class="form-horizontal" method="get" action="{{ url()->current() }}">
                        <div class="form-group">
                            <label class="col-sm-2 control-label">订单状态</label>
                            <div class="col-sm-5 checkbox-form">
                                @foreach ($statusList as $status)
                                <div class="pretty p-default">
                                    <input type="checkbox" value="{{ $status->getStatusCode() }}"
                                    name="statusList[]"
                                    @if (in_array($status->getStatusCode(), request('statusList'))) checked @endif>
                                    <div class="state"><label>{{ $status->getStatusText() }}</label></div>
                                </div>
                                @endforeach
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
                        <th>用户ID</th>
                        <th>用户名称</th>
                        <th>数量</th>
                        <th>创建时间</th>
                        <th>审核时间</th>
                        <th>提现时间</th>
                        <th>状态</th>
                        <th>操作</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($withdrawList as $withdraw)
                        <tr>
                            <td>{{ $withdraw->uid }}</td>
                            <td>{{ $withdraw->uname }}</td>
                            <td>{{ $withdraw->amount }}</td>
                            <td>{{ $withdraw->create_time }}</td>
                            <td>
                                @if ($withdraw->audit_time)
                                {{ $withdraw->audit_time }}
                                @else
                                ----
                                @endif
                            </td>
                            <td>
                                @if ($withdraw->finish_time)
                                    {{ $withdraw->finish_time }}
                                @else
                                    ----
                                @endif
                            </td>
                            <td>{{ $withdraw->getStatusText() }}</td>
                            <td>
                                @if ($withdraw->status == \OtcCms\Models\WithdrawStatus::WITHDRAW_PENDING
                                || $withdraw->status == \OtcCms\Models\WithdrawStatus::WITHDRAW_FAIL)
                                    <button class="btn btn-default" type="button">通过</button>
                                    <button class="btn btn-default" type="button">不通过</button>
                                @endif
                                <button class="btn btn-default" type="button">查看</button>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            </div>
        </div>
        {{ $withdrawList->links() }}
    </div>
@endsection
