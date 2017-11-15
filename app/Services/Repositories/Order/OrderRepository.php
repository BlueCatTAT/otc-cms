<?php

namespace OtcCms\Services\Repositories\Order;

use DB;
use Illuminate\Contracts\Pagination\Paginator;
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
        $query = $this->getJoinQuery()
            ->where('order.type', $type)
            ->orderBy('order.create_time', 'desc');
        if (!empty($customerName)) {
            $query->where(function($query) use ($customerName) {
                $query->where('owner.nickname', 'like', "%$customerName%")
                    ->orWhere('publisher.nickname', 'like', "%$customerName%");
            });
        }
        return $query->paginate(config('view.paginator.limit'));
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

    /**
     * @param int $customerId
     * @return Paginator
     */
    public function paginateWithCustomerId($customerId)
    {
        return $this->getJoinQuery()
            ->where(function($query) use ($customerId) {
                $query->where('owner.id', $customerId)
                    ->orWhere('publisher.id', $customerId);
            })
            ->orderBy('order.create_time', 'desc')
            ->paginate(config('view.paginator.limit'));
    }

    private function getJoinQuery()
    {
        return DB::table('order')
            ->join('user as owner', 'order.uid', '=', 'owner.id')
            ->join('user as publisher', 'order.ad_uid', '=', 'publisher.id')
            ->select('order.*', 'owner.nickname as uname', 'publisher.nickname as ad_uname');
    }

    /**
     * @param $date
     * @return array
     */
    public function sumQuantityAndFeeOfFinished($date)
    {
        $dateTime = new \DateTime($date);
        $startTime = $dateTime->format('Y-m-d 00:00:00');
        $dateTime->add(new \DateInterval('P1D'));
        $endTime = $dateTime->format('Y-m-d 00:00:00');
        $record = DB::table('order')
            ->selectRaw('SUM(quantity) as quantity, SUM(fee) as fee, AVG(rate) as rate')
            ->where('finish_time', '>=', $startTime)
            ->where('finish_time', '<', $endTime)
            ->where('status', OrderStatus::DONE)
            ->first();
        return [
            'quantity' => $record->quantity ? $record->quantity : 0,
            'fee' => $record->fee ? $record->fee : 0,
            'ratio' => $record->rate ?  $record->reate : 0,
        ];
    }
}
