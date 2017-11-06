<?php

namespace OtcCms\Models;

use Zizaco\Entrust\EntrustRole;

/**
 * OtcCms\Models\Role
 *
 * @property int $id
 * @property string $name
 * @property string|null $display_name
 * @property string|null $description
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\OtcCms\Models\Permission[] $perms
 * @property-read \Illuminate\Database\Eloquent\Collection|\OtcCms\Models\User[] $users
 * @method static \Illuminate\Database\Eloquent\Builder|\OtcCms\Models\Role whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\OtcCms\Models\Role whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\OtcCms\Models\Role whereDisplayName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\OtcCms\Models\Role whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\OtcCms\Models\Role whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\OtcCms\Models\Role whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Role extends EntrustRole
{

}
