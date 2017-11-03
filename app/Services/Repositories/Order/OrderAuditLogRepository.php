<?php

namespace OtcCms\Services\Repositories\Order;

use Illuminate\Database\Eloquent\Collection;
use OtcCms\Models\OrderAuditLog;
use OtcCms\Models\StatusLog;
use OtcCms\Models\User;

class OrderAuditLogRepository implements OrderAuditLogRepositoryInterface
{

    public function create(User $user, $orderId, StatusLog $statusLog, $requestId, $isSuccessful, $comment = '')
    {
        $log = new OrderAuditLog();
        $log->order_id = $orderId;
        $log->cms_uid = $user->id;
        $log->cms_uname = $user->name;
        $log->target_status = $statusLog->getTargetStatusCode();
        $log->previous_status = $statusLog->getPreviousStatusCode();
        $log->post_status = $statusLog->getPostStatusCode();
        $log->is_successful = (int) $isSuccessful;
        $log->request_id = $requestId;
        $log->comment = $comment;
        $log->save();
        return $log;
    }

    /**
     * @param int $userId
     * @return Collection
     */
    public function getByUserId($userId)
    {
        return OrderAuditLog::where('cms_uid', $userId)
            ->orderBy('create_time', 'desc')
            ->get();
    }
}
