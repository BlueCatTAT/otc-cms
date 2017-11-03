<?php
/**
 * Created by PhpStorm.
 * User: pengchi
 * Date: 11/3/17
 * Time: 3:40 PM
 */

namespace OtcCms\Services\OtcServer;

use OtcCms\Models\Order;

interface OrderServiceInterface
{
    /**
     * @param Order $order
     * @return Result
     */
    public function confirm(Order $order);

    /**
     * @param Order $order
     * @param $comment
     * @return Result
     */
    public function cancel(Order $order, $comment);
}
