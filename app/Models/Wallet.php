<?php
/**
 * Created by PhpStorm.
 * User: mc
 * Date: 07/11/2017
 * Time: 10:26 AM
 */

namespace OtcCms\Models;


use Illuminate\Database\Eloquent\Model;

/**
 * OtcCms\Models\Wallet
 *
 * @property int $id
 * @property int $uid
 * @property string|null $uname
 * @property float|null $total 总额（Token [BTC等]）
 * @property float|null $locked 锁定/冻结数量（Token）
 * @property float|null $balance 有效余额（Token）
 * @property float|null $sent 累计已转出（Token）
 * @property float|null $received 累计已收到（Token）
 * @property float $recharge 累计充值
 * @property float $withdraw 累计提现
 * @property \Carbon\Carbon $update_time
 * @property \Carbon\Carbon $create_time
 * @method static \Illuminate\Database\Eloquent\Builder|\OtcCms\Models\Wallet whereBalance($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\OtcCms\Models\Wallet whereCreateTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\OtcCms\Models\Wallet whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\OtcCms\Models\Wallet whereLocked($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\OtcCms\Models\Wallet whereReceived($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\OtcCms\Models\Wallet whereRecharge($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\OtcCms\Models\Wallet whereSent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\OtcCms\Models\Wallet whereTotal($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\OtcCms\Models\Wallet whereUid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\OtcCms\Models\Wallet whereUname($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\OtcCms\Models\Wallet whereUpdateTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\OtcCms\Models\Wallet whereWithdraw($value)
 * @mixin \Eloquent
 * @property int $token_type 1-BTC; 2-ETH; 3-Other.
 * @method static \Illuminate\Database\Eloquent\Builder|\OtcCms\Models\Wallet whereTokenType($value)
 */
class Wallet extends Model
{
    const CREATED_AT = 'create_time';
    const UPDATED_AT = 'update_time';

    protected $table = 'wallet';
}