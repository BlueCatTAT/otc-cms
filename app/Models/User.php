<?php

namespace OtcCms\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Zizaco\Entrust\Traits\EntrustUserTrait;

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
