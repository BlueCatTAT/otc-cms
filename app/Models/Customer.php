<?php

namespace OtcCms\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * OtcCms\Models\Customer
 *
 * @property int $id user id
 * @property string|null $name user login name
 * @property string|null $avatar
 * @property string|null $nickname
 * @property string|null $realname
 * @property int|null $realname_verified 0-not verified; 1-verified
 * @property string|null $ID_number 身份证号码
 * @property string $mobile
 * @property string|null $sn 设备号唯一标记
 * @property string|null $imei 设备号唯一标记
 * @property string|null $email
 * @property string|null $password login password
 * @property string|null $password_pay payment password
 * @property \Carbon\Carbon|null $update_time
 * @property string|null $update_time_pwd Update time of password
 * @property \Carbon\Carbon $create_time
 * @property mixed $advertisements
 * @property mixed $wallet
 * @property mixed $withdraws
 * @method static \Illuminate\Database\Eloquent\Builder|\OtcCms\Models\Customer whereAvatar($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\OtcCms\Models\Customer whereCreateTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\OtcCms\Models\Customer whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\OtcCms\Models\Customer whereIDNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\OtcCms\Models\Customer whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\OtcCms\Models\Customer whereImei($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\OtcCms\Models\Customer whereMobile($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\OtcCms\Models\Customer whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\OtcCms\Models\Customer whereNickname($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\OtcCms\Models\Customer wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\OtcCms\Models\Customer wherePasswordPay($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\OtcCms\Models\Customer whereRealname($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\OtcCms\Models\Customer whereRealnameVerified($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\OtcCms\Models\Customer whereSn($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\OtcCms\Models\Customer whereUpdateTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\OtcCms\Models\Customer whereUpdateTimePwd($value)
 * @mixin \Eloquent
 */
class Customer extends Model
{
    const CREATED_AT = 'create_time';
    const UPDATED_AT = 'update_time';
    const SYS_USER_ID = 1;
    protected $table = 'user';

    public function wallet()
    {
        return $this->hasOne(Wallet::class, 'uid', 'id');
    }

    public function advertisements()
    {
        return $this->hasMany(Advertisement::class, 'uid', 'id');
    }

    public function withdraws()
    {
        return $this->hasMany(Withdraw::class, 'uid', 'id');
    }
}
