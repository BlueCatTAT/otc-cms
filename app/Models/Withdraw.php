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

}
