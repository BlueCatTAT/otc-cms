<?php
/**
 * Created by PhpStorm.
 * User: mc
 * Date: 07/11/2017
 * Time: 11:08 AM
 */

namespace OtcCms\Models;


use Illuminate\Database\Eloquent\Model;

/**
 * OtcCms\Models\Advertisement
 *
 * @property int $id ad id
 * @property int $uid
 * @property string|null $uname
 * @property int $type 1-buying; 2-selling;
 * @property float $price unit: CNY
 * @property int|null $token_type 1-BTC; 2-Other;
 * @property float $min_limit_CNY unit: CNY
 * @property float $min_limit_Token unit: BTC or Other
 * @property float $max_limit_CNY unit: CNY
 * @property float $max_limit_Token unit: BTC or Other
 * @property string|null $ad_msg 广告留言
 * @property int|null $status 发布状态：1-有效；0-无效（已下架或已取消）；
 * @property \Carbon\Carbon $update_time
 * @property \Carbon\Carbon $create_time
 * @method static \Illuminate\Database\Eloquent\Builder|\OtcCms\Models\Advertisement whereAdMsg($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\OtcCms\Models\Advertisement whereCreateTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\OtcCms\Models\Advertisement whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\OtcCms\Models\Advertisement whereMaxLimitCNY($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\OtcCms\Models\Advertisement whereMaxLimitToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\OtcCms\Models\Advertisement whereMinLimitCNY($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\OtcCms\Models\Advertisement whereMinLimitToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\OtcCms\Models\Advertisement wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\OtcCms\Models\Advertisement whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\OtcCms\Models\Advertisement whereTokenType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\OtcCms\Models\Advertisement whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\OtcCms\Models\Advertisement whereUid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\OtcCms\Models\Advertisement whereUname($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\OtcCms\Models\Advertisement whereUpdateTime($value)
 * @mixin \Eloquent
 */
class Advertisement extends Model
{
    const CREATED_AT = 'create_time';
    const UPDATED_AT = 'update_time';

    protected $table = 'ad';

    /**
     * @var AdvertisementType
     */
    private $typeObj;

    /**
     * @var AdvertisementStatus
     */
    private $statusObj;

    public function getTypeText()
    {
        return $this->getTypeObj()->getText();
    }

    public function getStatusText()
    {
        return $this->getStatusObj()->getText();
    }

    private function getTypeObj()
    {
        if (null === $this->typeObj) {
            $this->typeObj = AdvertisementType::valueOf($this->type);
        }
        return $this->typeObj;
    }

    private function getStatusObj()
    {
        if (null === $this->statusObj) {
            $this->statusObj = AdvertisementStatus::valueOf($this->status);
        }
        return $this->statusObj;
    }
}