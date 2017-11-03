<?php

namespace OtcCms\Models;

use Illuminate\Database\Eloquent\Model;

final class Order extends Model
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
        if (null === $this->typeObj) {
            $this->typeObj = OrderType::valueOf($this->type);
        }
        return $this->typeObj->getText();
    }

    public function getStatusText()
    {
        if (null === $this->statusObj) {
            $this->statusObj = OrderStatus::valueOf($this->status);
        }
        return $this->statusObj->getText();
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

}