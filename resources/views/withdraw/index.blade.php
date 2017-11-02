@extends('layouts.app')

@section('content')
    <div class="container">
        <ol class="breadcrumb">
            <li class="active">提现申请</li>
        </ol>
        @if ($errors->any())
            <div class="alert alert-danger" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times</span>
                </button>
                {{ $errors->first() }}
            </div>
        @endif
        @if ($message = session('message'))
            <div class="alert alert-success" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times</span>
                </button>
                {{ $message }}
            </div>
        @endif
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
                                {{ $withdraw->audit_time or '----' }}
                            </td>
                            <td>
                                {{ $withdraw->finish_time or '----' }}
                            </td>
                            <td>
                                <span class="label
                                    @if($withdraw->status == \OtcCms\Models\WithdrawStatus::WITHDRAW_PENDING)
                                        label-default
                                    @elseif($withdraw->status == \OtcCms\Models\WithdrawStatus::WITHDRAW_FAIL)
                                        label-danger
                                    @elseif($withdraw->status == \OtcCms\Models\WithdrawStatus::WITHDRAW_SUCCESS)
                                        label-success
                                    @else
                                        label-warning
                                @endif
                                ">
                                    {{ $withdraw->getStatusText() }}
                                </span>
                            </td>
                            <td>
                                @if ($withdraw->status == \OtcCms\Models\WithdrawStatus::WITHDRAW_PENDING)
                                    <span class="glyphicon glyphicon-ok audit-confirm-btn text-success"
                                    data-content-url="{{ route('withdraw_audit_confirm_modal', [$withdraw->id]) }}"></span>
                                    <span class="glyphicon glyphicon-remove audit-confirm-btn text-danger"
                                    data-content-url="{{ route('withdraw_audit_deny_modal', [$withdraw->id]) }}"></span>
                                @elseif ($withdraw->status == \OtcCms\Models\WithdrawStatus::WITHDRAW_FAIL)
                                    <span class="glyphicon glyphicon-repeat audit-confirm-btn"
                                    data-content-url="{{ route('withdraw_audit_confirm_modal', [$withdraw->id]) }}"></span>
                                    ></span>
                                @endif
                                <a href="{{route('withdraw_detail', [$withdraw->id])}}" class="glyphicon glyphicon-eye-open"></a>
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

    {{-- Modal --}}
    <div class="modal fade" id="audit-modal" tabindex="-1" role="dialog"></div>
@endsection

@section('scripts')
    <script src="{{ asset('js/withdraw/index.js') }}"></script>
@endsection
