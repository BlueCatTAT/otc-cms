<?php

namespace OtcCms\Models;

use Illuminate\Database\Eloquent\Model;

final class Order extends Model
{
    const CREATED_AT = 'create_time';
    const UPDATED_AT = 'update_time';
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

    /**
     * The one who pays the order
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function owner()
    {
        return $this->hasOne(Customer::class, 'uid');
    }

    /**
     * The one who published the ad
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function publisher()
    {
        return $this->hasOne(Customer::class, 'ad_uid');
    }

}
