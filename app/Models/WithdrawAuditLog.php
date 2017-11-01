<?php

namespace OtcCms\Models;

use Illuminate\Database\Eloquent\Model;

class WithdrawAuditLog extends Model
{
    protected $table = 'withdraw_audit_logs';

    public function getPreviousStatusText()
    {
        return WithdrawStatus::valueOf($this->previous_status)->getStatusText();
    }

    public function getPostStatusText()
    {
        return WithdrawStatus::valueOf($this->post_status)->getStatusText();
    }
}
