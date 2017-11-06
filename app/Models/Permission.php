<?php

namespace OtcCms\Models;

use Zizaco\Entrust\EntrustPermission;

/**
 * OtcCms\Models\Permission
 *
 * @property int $id
 * @property string $name
 * @property string|null $display_name
 * @property string|null $description
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\OtcCms\Models\Role[] $roles
 * @method static \Illuminate\Database\Eloquent\Builder|\OtcCms\Models\Permission whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\OtcCms\Models\Permission whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\OtcCms\Models\Permission whereDisplayName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\OtcCms\Models\Permission whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\OtcCms\Models\Permission whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\OtcCms\Models\Permission whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Permission extends EntrustPermission
{

}
