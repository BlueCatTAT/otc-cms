<?php
/**
 * Created by PhpStorm.
 * User: mc
 * Date: 15/11/2017
 * Time: 3:42 PM
 */

namespace OtcCms\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * OtcCms\Models\CommissionDaily
 *
 * @property int $id
 * @property int $crypto_type
 * @property string $date
 * @property float $commission How much we charge for the service
 * @property float $total How much coins transfered
 * @property int $ratio
 * @property \Carbon\Carbon $create_time
 * @property \Carbon\Carbon $update_time
 * @method static \Illuminate\Database\Eloquent\Builder|\OtcCms\Models\CommissionDaily whereCommission($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\OtcCms\Models\CommissionDaily whereCreateTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\OtcCms\Models\CommissionDaily whereCryptoType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\OtcCms\Models\CommissionDaily whereDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\OtcCms\Models\CommissionDaily whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\OtcCms\Models\CommissionDaily whereRatio($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\OtcCms\Models\CommissionDaily whereTotal($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\OtcCms\Models\CommissionDaily whereUpdateTime($value)
 * @mixin \Eloquent
 */
class CommissionDaily extends Model
{
    const CREATED_AT = 'create_time';
    const UPDATED_AT = 'update_time';

    protected $table = 'commission_daily';

}