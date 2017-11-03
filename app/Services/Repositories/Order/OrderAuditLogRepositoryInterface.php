<?php
/**
 * Created by PhpStorm.
 * User: pengchi
 * Date: 11/3/17
 * Time: 2:51 PM
 */

namespace OtcCms\Services\Repositories\Order;

use Illuminate\Database\Eloquent\Collection;
use OtcCms\Models\StatusLog;
use OtcCms\Models\User;

interface OrderAuditLogRepositoryInterface
{
    public function create(User $user, $orderId, StatusLog $statusLog, $requestId, $isSuccessful, $comment = '');

    /**
     * @param int $userId
     * @return Collection
     */
    public function getByUserId($userId);
}
