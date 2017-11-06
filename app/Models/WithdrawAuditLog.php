<?php

namespace OtcCms\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * OtcCms\Models\WithdrawAuditLog
 *
 * @property int $id
 * @property int $withdraw_id
 * @property int $cms_uid
 * @property string $cms_uname
 * @property int $previous_status
 * @property int $post_status
 * @property \Carbon\Carbon $create_time
 * @property \Carbon\Carbon $update_time
 * @property string $comment
 * @property int $is_successful 操作是否执行成功
 * @property string $request_id 向otc_server发送请求的ID，用于到日志中查错
 * @property int $target_status 操作时想要到达的状态
 * @method static \Illuminate\Database\Eloquent\Builder|\OtcCms\Models\WithdrawAuditLog whereCmsUid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\OtcCms\Models\WithdrawAuditLog whereCmsUname($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\OtcCms\Models\WithdrawAuditLog whereComment($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\OtcCms\Models\WithdrawAuditLog whereCreateTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\OtcCms\Models\WithdrawAuditLog whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\OtcCms\Models\WithdrawAuditLog whereIsSuccessful($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\OtcCms\Models\WithdrawAuditLog wherePostStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\OtcCms\Models\WithdrawAuditLog wherePreviousStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\OtcCms\Models\WithdrawAuditLog whereRequestId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\OtcCms\Models\WithdrawAuditLog whereTargetStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\OtcCms\Models\WithdrawAuditLog whereUpdateTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\OtcCms\Models\WithdrawAuditLog whereWithdrawId($value)
 * @mixin \Eloquent
 */
class WithdrawAuditLog extends Model
{
    const CREATED_AT = 'create_time';
    const UPDATED_AT = 'update_time';
    protected $table = 'withdraw_audit_logs';


    public static function createInstance(
        User $user, Withdraw $withdraw, Withdraw $previousWithdraw, $targetStatus,
        $isSuccess, $requestId, $comment = '')
    {
        $instance = new self();
        $instance->withdraw_id = $withdraw->id;
        $instance->cms_uid = $user->id;
        $instance->cms_uname = $user->name;
        $instance->previous_status = $previousWithdraw->status;
        $instance->post_status = $withdraw->status;
        $instance->target_status = $targetStatus;
        $instance->comment = $comment;
        $instance->is_successful = (int) $isSuccess;
        $instance->request_id = $requestId;
        return $instance;
    }

    public function getPreviousStatusText()
    {
        return $this->getStatusText('previous_status');
    }

    public function getPostStatusText()
    {
        return $this->getStatusText('post_status');
    }

    public function getTargetStatusText()
    {
        return $this->getStatusText('target_status');
    }

    private function getStatusText($field)
    {
        return WithdrawStatus::valueOf($this->$field)->getStatusText();
    }

    public function isSuccessfulText()
    {
        return $this->is_successful ? '是' : '否';
    }
}
