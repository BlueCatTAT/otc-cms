<?php

namespace OtcCms\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Zizaco\Entrust\Traits\EntrustUserTrait;

/**
 * OtcCms\Models\User
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property string $password
 * @property string|null $remember_token
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read \Illuminate\Database\Eloquent\Collection|\OtcCms\Models\Role[] $roles
 * @method static \Illuminate\Database\Eloquent\Builder|\OtcCms\Models\User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\OtcCms\Models\User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\OtcCms\Models\User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\OtcCms\Models\User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\OtcCms\Models\User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\OtcCms\Models\User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\OtcCms\Models\User whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class User extends Authenticatable
{
    use Notifiable;
    use Validatable;
    use EntrustUserTrait;

    public $table = 'cms_users';

    private $rules = [
        'name' => 'required|string|max:255',
        'email' => 'required|email|max:255|unique:cms_users',
        'password' => 'required|string|min:6',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * @var Role
     */
    private $role;

    public function getRole()
    {
        if (null === $this->role) {
            $this->role = $this->roles->first();
        }
        return $this->role;
    }
}
