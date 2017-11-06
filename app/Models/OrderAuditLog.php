<?php

namespace OtcCms\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * OtcCms\Models\OrderAuditLog
 *
 * @property int $id
 * @property int $order_id
 * @property int $cms_uid
 * @property string $cms_uname
 * @property string $request_id 向otc server发送请求的id
 * @property int $target_status 操作时选择的状态
 * @property int $previous_status 操作前的状态
 * @property int $post_status 操作后实际的状态
 * @property int $is_successful
 * @property string $comment
 * @property \Carbon\Carbon $create_time
 * @property \Carbon\Carbon $update_time
 * @method static \Illuminate\Database\Eloquent\Builder|\OtcCms\Models\OrderAuditLog whereCmsUid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\OtcCms\Models\OrderAuditLog whereCmsUname($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\OtcCms\Models\OrderAuditLog whereComment($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\OtcCms\Models\OrderAuditLog whereCreateTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\OtcCms\Models\OrderAuditLog whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\OtcCms\Models\OrderAuditLog whereIsSuccessful($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\OtcCms\Models\OrderAuditLog whereOrderId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\OtcCms\Models\OrderAuditLog wherePostStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\OtcCms\Models\OrderAuditLog wherePreviousStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\OtcCms\Models\OrderAuditLog whereRequestId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\OtcCms\Models\OrderAuditLog whereTargetStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\OtcCms\Models\OrderAuditLog whereUpdateTime($value)
 * @mixin \Eloquent
 */
class OrderAuditLog extends Model
{
    const CREATED_AT = 'create_time';
    const UPDATED_AT = 'update_time';

    /**
     * @var StatusLog
     */
    private $statusLog;

    public function getStatusLog()
    {
        if (null === $this->statusLog
        && $this->id) {
            $this->statusLog = StatusLog::createInstance(
                OrderStatus::valueOf($this->target_status),
                OrderStatus::valueOf($this->previous_status),
                OrderStatus::valueOf($this->post_status)
            );
        }
        return $this->statusLog;
    }
}
