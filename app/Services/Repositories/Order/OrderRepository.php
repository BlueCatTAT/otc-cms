<?php

namespace OtcCms\Services\Repositories\Order;

use DB;
use OtcCms\Models\Order;
use OtcCms\Models\OrderStatus;
use OtcCms\Models\StatusLog;
use OtcCms\Models\User;
use OtcCms\Services\OtcServer\OrderServiceInterface as OtcServerOrderServiceInterface;

class OrderRepository implements OrderRepositoryInterface
{

    /**
     * @var OtcServerOrderServiceInterface
     */
    protected $orderService;
    /**
     * @var OrderAuditLogRepositoryInterface
     */
    protected $auditLogRepository;

    public function __construct(OtcServerOrderServiceInterface $orderService,
    OrderAuditLogRepositoryInterface $auditLogRepository)
    {
        $this->orderService = $orderService;
        $this->auditLogRepository = $auditLogRepository;
    }

    /**
     * Search orders by type[exactly] and customerName[like]
     *
     * @param int $type
     * @param string $customerName
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function paginateWithTypeAndCustomerName($type, $customerName)
    {
        $query = DB::table('order')
            ->join('user as owner', 'order.uid', '=', 'owner.id')
            ->join('user as publisher', 'order.ad_uid', '=', 'publisher.id')
            ->select('order.*', 'owner.nickname as uname', 'publisher.nickname as ad_uname')
            ->where('order.type', $type)
            ->orderBy('order.create_time', 'desc');
        if (!empty($customerName)) {
            $query->where(function($query) use ($customerName) {
                $query->where('owner.nickname', 'like', "%$customerName%")
                    ->orWhere('publisher.nickname', 'like', "%$customerName%");
            });
        }
        return $query->paginate(30);
    }

    /**
     * @param Order $order
     * @param User $user
     * @return boolean
     */
    public function confirm(Order $order, User $user)
    {
        $previousStatus = $order->getStatusObj();
        $result = $this->orderService->confirm($order);
        $response = $result->getResponse();
        $postOrder = Order::find($order->id);
        $statusLog = StatusLog::createInstance(
            OrderStatus::valueOf(OrderStatus::DONE),
            $previousStatus,
            $postOrder->getStatusObj()
        );
        $this->auditLogRepository->create($user, $order->id, $statusLog, $result->getRequestId(), $response->isSuccessful());
        return $response->isSuccessful();
    }

    /**
     * @param Order $order
     * @param User $user
     * @param $comment
     * @return boolean
     */
    public function cancel(Order $order, User $user, $comment)
    {
        $previousStatus = $order->getStatusObj();
        $result = $this->orderService->cancel($order, $comment);
        $response = $result->getResponse();
        $postOrder = Order::find($order->id);
        $statusLog = StatusLog::createInstance(
            OrderStatus::valueOf(OrderStatus::CANCELED),
            $previousStatus,
            $postOrder->getStatusObj()
        );
        $this->auditLogRepository->create($user, $order->id, $statusLog, $result->getRequestId(), $response->isSuccessful(), $comment);
        return $response->isSuccessful();
    }
}
