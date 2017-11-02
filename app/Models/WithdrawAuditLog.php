<?php

namespace OtcCms\Models;

use Illuminate\Database\Eloquent\Model;

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
