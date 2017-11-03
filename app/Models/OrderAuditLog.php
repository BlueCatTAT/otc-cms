<?php

namespace OtcCms\Models;

use Illuminate\Database\Eloquent\Model;

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
