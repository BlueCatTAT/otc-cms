<?php

namespace OtcCms\Models;

use Illuminate\Database\Eloquent\Model;

final /**
 * OtcCms\Models\Order
 *
 * @property int $id order id
 * @property string $sn order sn
 * @property int $uid 下单者 uid;
 * @property string|null $uname 下单者 uname;
 * @property int|null $type 订单类型：1-buying; 2-selling;
 * @property int|null $ad_id 所对应的发布（广告）id;
 * @property int|null $ad_uid 所对应的发布（广告）uid;
 * @property float|null $price 成交单价；
 * @property float|null $amount 订单金额，单位：CNY;
 * @property float|null $quantity 比特币数量：单位：BTC;
 * @property int|null $status 订单状态：0-已取消；10-待付款；20-已付款；30-已收款；40-已完成。
 * @property \Carbon\Carbon $update_time
 * @property \Carbon\Carbon $create_time 下单时间
 * @property string|null $payment_time 付款时间
 * @property string|null $receipt_time 收款时间
 * @property string|null $finish_time 完成时间
 * @property-read \Illuminate\Database\Eloquent\Collection|\OtcCms\Models\OrderAuditLog[] $auditLogs
 * @property-read \OtcCms\Models\Customer $owner
 * @property-read \OtcCms\Models\Customer $publisher
 * @method static \Illuminate\Database\Eloquent\Builder|\OtcCms\Models\Order whereAdId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\OtcCms\Models\Order whereAdUid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\OtcCms\Models\Order whereAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\OtcCms\Models\Order whereCreateTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\OtcCms\Models\Order whereFinishTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\OtcCms\Models\Order whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\OtcCms\Models\Order wherePaymentTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\OtcCms\Models\Order wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\OtcCms\Models\Order whereQuantity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\OtcCms\Models\Order whereReceiptTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\OtcCms\Models\Order whereSn($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\OtcCms\Models\Order whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\OtcCms\Models\Order whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\OtcCms\Models\Order whereUid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\OtcCms\Models\Order whereUname($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\OtcCms\Models\Order whereUpdateTime($value)
 * @mixin \Eloquent
 * @property string $ad_uname
 * @method static \Illuminate\Database\Eloquent\Builder|\OtcCms\Models\Order whereAdUname($value)
 */
class Order extends Model
{
    const CREATED_AT = 'create_time';
    const UPDATED_AT = 'update_time';
    /**
     * @var OrderStatus
     */
    protected $statusObj;
    /**
     * @var OrderType
     */
    private $typeObj;

    protected $table = 'order';

    public function getTypeText()
    {
        return $this->getTypeObj()->getText();
    }

    public function getTypeObj()
    {
        if (null === $this->typeObj) {
            $this->typeObj = OrderType::valueOf($this->type);
        }
        return $this->typeObj;
    }

    public function getStatusText()
    {
        return $this->getStatusObj()->getText();
    }

    /**
     * The one who pays the order
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function owner()
    {
        return $this->hasOne(Customer::class, 'id', 'uid');
    }

    /**
     * The one who published the ad
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function publisher()
    {
        return $this->hasOne(Customer::class, 'id', 'ad_uid');
    }

    public function auditLogs()
    {
        return $this->hasMany(OrderAuditLog::class, 'order_id', 'id');
    }

    public function canBeCancelled()
    {
        return $this->status == OrderStatus::WAITING_FOR_PAYMENT
            || $this->status == OrderStatus::PAID;
    }

    public function canBeConfirmed()
    {
        return $this->status == OrderStatus::PAID
            || $this->status == OrderStatus::PAYMENT_RECEIVED;
    }

    /**
     * @return OrderStatus
     */
    public function getStatusObj()
    {
        if (null === $this->statusObj) {
            $this->statusObj = OrderStatus::valueOf($this->status);
        }
        return $this->statusObj;
    }

}
