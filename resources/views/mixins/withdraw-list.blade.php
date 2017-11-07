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
                        label-warning
                    @elseif($withdraw->status == \OtcCms\Models\WithdrawStatus::WITHDRAW_FAIL)
                        label-danger
                    @elseif($withdraw->status == \OtcCms\Models\WithdrawStatus::WITHDRAW_SUCCESS)
                        label-success
                    @else
                        label-primary
                @endif">
                    {{ $withdraw->getStatusText() }}
                </span>
            </td>
            <td>
                @if ($withdraw->status == \OtcCms\Models\WithdrawStatus::WITHDRAW_PENDING)
                    <span class="glyphicon glyphicon-ok text-success"
                          v-on:click="popupModalFromUrl('{{ route('withdraw_audit_confirm_modal', [$withdraw->id]) }}')"></span>
                    <span class="glyphicon glyphicon-remove text-danger"
                          v-on:click="popupModalFromUrl('{{ route('withdraw_audit_deny_modal', [$withdraw->id]) }}')"></span>
                @elseif ($withdraw->status == \OtcCms\Models\WithdrawStatus::WITHDRAW_FAIL)
                    <span class="glyphicon glyphicon-repeat" v-on:click="popupModalFromUrl('{{ route('withdraw_audit_confirm_modal', [$withdraw->id]) }}')"></span>
                @endif
                <a href="{{route('withdraw_detail', [$withdraw->id])}}" class="glyphicon glyphicon-eye-open"></a>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>

{{-- Modal --}}
<div class="modal fade" id="cms-modal" tabindex="-1" role="dialog"></div>
