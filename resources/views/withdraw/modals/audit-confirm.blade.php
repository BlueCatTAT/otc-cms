<div class="modal-dialog" role="document">
    <form action="{{ route('withdraw_audit_confirm', [$withdraw->id]) }}" method="post">
        {{ csrf_field() }}
        <input type="hidden" value="{{\OtcCms\Models\WithdrawStatus::WITHDRAW_SUCCESS}}" name="status">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title">确认提币</h4>
            </div>
            <div class="modal-body">
                <p>将从用户<span >{{$withdraw->uid}}</span>的账号中转出<strong>{{$withdraw->amount}}</strong>个比特币</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
                <button type="submit" class="btn btn-primary">确认</button>
            </div>
        </div>
    </form>
</div>
