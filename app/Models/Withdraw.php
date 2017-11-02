<?php

namespace OtcCms\Models;

use Illuminate\Database\Eloquent\Model;

class Withdraw extends Model
{

    const CREATED_AT = 'create_time';
    const UPDATED_AT = 'update_time';


    protected $table = 'withdraw';
    /**
     * @var WithdrawStatus
     */
    private $statusObj;

    public function getStatusText()
    {
        if (null === $this->statusObj) {
            $this->statusObj = WithdrawStatus::valueOf($this->status);
        }
        return $this->statusObj->getStatusText();
    }

    public function auditLogs()
    {
        return $this->hasMany(WithdrawAuditLog::class, 'withdraw_id')
            ->orderBy('create_time', 'desc');
    }
}
