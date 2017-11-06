<?php
/**
 * Created by PhpStorm.
 * User: mc
 * Date: 06/11/2017
 * Time: 5:49 PM
 */

namespace OtcCms\Services\OtcServer;


use OtcCms\Models\Order;
use OtcCms\Models\OrderStatus;

class OrderService implements OrderServiceInterface
{

    /**
     * @var ApiClient
     */
    private $client;

    public function __construct(ApiClient $client)
    {
        $this->client = $client;
    }

    /**
     * @param Order $order
     * @return Result
     */
    public function confirm(Order $order)
    {
        $response = $this->client->post('/admin/updateOrder', [
            'id' => $order->id,
            'status' => OrderStatus::PAYMENT_RECEIVED,
        ]);

        return Result::create($this->client->getLastRequestId(), $response);
    }

    /**
     * @param Order $order
     * @param $comment
     * @return Result
     */
    public function cancel(Order $order, $comment)
    {
        $response = $this->client->post('/admin/updateOrder', [
            'id' => $order->id,
            'status' => OrderStatus::CANCELED,
        ]);

        return Result::create($this->client->getLastRequestId(), $response);
    }
}