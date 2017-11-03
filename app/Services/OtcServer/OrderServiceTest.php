<?php

namespace OtcCms\Services\OtcServer;

use OtcCms\Models\Order;
use OtcCms\Models\OrderStatus;

class OrderServiceTest implements OrderServiceInterface
{

    /**
     * @param Order $order
     * @return Result
     */
    public function confirm(Order $order)
    {
        $order->status = OrderStatus::DONE;
        $order->save();
        $requestId = md5(uniqid('', true));
        $response = ApiResponse::create(0, '');
        return new Result($requestId,$response);
    }

    /**
     * @param Order $order
     * @param $comment
     * @return Result
     */
    public function cancel(Order $order, $comment)
    {
        $order->status = OrderStatus::CANCELED;
        $order->save();
        $requestId = md5(uniqid('', true));
        $response = ApiResponse::create(0, '');
        return new Result($requestId, $response);
    }
}
