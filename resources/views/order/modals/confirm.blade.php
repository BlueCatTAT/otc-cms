<div class="modal-dialog" role="document">
    <form action="{{ route('order_confirm', [$order->id]) }}" method="post">
        {{ csrf_field() }}
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title">确认订单</h4>
            </div>
            <div class="modal-body">
                <p>确认该笔订单吗？</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
                <button type="submit" class="btn btn-primary">确认</button>
            </div>
        </div>
    </form>
</div>
