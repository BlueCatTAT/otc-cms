<?php

namespace OtcCms\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * OtcCms\Models\Withdraw
 *
 * @property int $id
 * @property int $uid user id.
 * @property string|null $uname user name.
 * @property string $bitcoin_address Target user's address.
 * @property float $amount
 * @property string|null $comment
 * @property int|null $status 10-待确认(新建)；20-用户已确认；30-审核中；40-审核成功；50-审核未通过；60-提现成功.
 * @property string|null $txid Bitcoin-> sendtoaddress returns the transaction ID <txid> if successful.
 * @property int|null $confirmations Number of confirmations of the transaction.
 * @property int|null $time Time associated with the transaction.
 * @property string|null $details An array of objects containing:[account, address, category, amount, fee].
 * @property string|null $account
 * @property string|null $address
 * @property string|null $category
 * @property float|null $fee
 * @property \Carbon\Carbon $update_time
 * @property \Carbon\Carbon $create_time
 * @property string|null $confirm_time 用户确认时间
 * @property string|null $audit_time 审核成功时间
 * @property string|null $finish_time 提现成功时间
 * @property-read \Illuminate\Database\Eloquent\Collection|\OtcCms\Models\WithdrawAuditLog[] $auditLogs
 * @method static \Illuminate\Database\Eloquent\Builder|\OtcCms\Models\Withdraw whereAccount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\OtcCms\Models\Withdraw whereAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\OtcCms\Models\Withdraw whereAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\OtcCms\Models\Withdraw whereAuditTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\OtcCms\Models\Withdraw whereBitcoinAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\OtcCms\Models\Withdraw whereCategory($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\OtcCms\Models\Withdraw whereComment($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\OtcCms\Models\Withdraw whereConfirmTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\OtcCms\Models\Withdraw whereConfirmations($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\OtcCms\Models\Withdraw whereCreateTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\OtcCms\Models\Withdraw whereDetails($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\OtcCms\Models\Withdraw whereFee($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\OtcCms\Models\Withdraw whereFinishTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\OtcCms\Models\Withdraw whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\OtcCms\Models\Withdraw whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\OtcCms\Models\Withdraw whereTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\OtcCms\Models\Withdraw whereTxid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\OtcCms\Models\Withdraw whereUid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\OtcCms\Models\Withdraw whereUname($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\OtcCms\Models\Withdraw whereUpdateTime($value)
 * @mixin \Eloquent
 * @property int $token_type 1-BTC; 2-ETH; 3-BCH; 4-Other.
 * @property float $fee_mine 提现矿工费(公链实收)
 * @method static \Illuminate\Database\Eloquent\Builder|\OtcCms\Models\Withdraw whereFeeMine($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\OtcCms\Models\Withdraw whereTokenType($value)
 */
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
        return $this->getStatusObj()->getStatusText();
    }

    public function auditLogs()
    {
        return $this->hasMany(WithdrawAuditLog::class, 'withdraw_id')
            ->orderBy('create_time', 'desc');
    }

    public function getStatusObj()
    {
        if (null === $this->statusObj) {
            $this->statusObj = WithdrawStatus::valueOf($this->status);
        }
        return $this->statusObj;
    }
}
