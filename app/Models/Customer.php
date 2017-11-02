<?php

namespace OtcCms\Models;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    const CREATED_AT = 'create_time';
    const UPDATED_AT = 'update_time';
    protected $table = 'user';
}
