<?php

namespace OtcCms\Models;

use Illuminate\Database\Eloquent\Model;

class Withdraw extends Model
{

    const CREATED_AT = 'create_time';
    const UPDATED_AT = 'update_time';

    const WITHDRAW_PENDING = 10;
    const WITHDRAW_DENY = 0;
    const WITHDRAW_SUCCESS = 30;
    const WITHDRAW_FAIL = 40;

    protected $table = 'withdraw';

    public function getStatusText()
    {
        switch ($this->status) {
            case self::WITHDRAW_PENDING:
                return '待审核';
            case self::WITHDRAW_SUCCESS:
                return '提现成功';
            case self::WITHDRAW_FAIL:
                return '提现失败';
            case self::WITHDRAW_DENY:
                return '审核未通过';
            default:
                return '未知 '.$this->status;
        }
    }
}
