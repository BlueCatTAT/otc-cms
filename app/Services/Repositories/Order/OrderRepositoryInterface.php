<?php
/**
 * Created by PhpStorm.
 * User: pengchi
 * Date: 11/2/17
 * Time: 4:41 PM
 */

namespace OtcCms\Services\Repositories\Order;

use Illuminate\Database\Eloquent\Collection;
use OtcCms\Models\Order;
use OtcCms\Models\User;

interface OrderRepositoryInterface
{

    /**
     * Search orders by type[exactly] and customerName[like]
     *
     * @param int $type
     * @param string $customerName
     * @return Collection
     */
    public function paginateWithTypeAndCustomerName($type, $customerName);

    /**
     * @param Order $order
     * @param User $user
     * @return boolean
     */
    public function confirm(Order $order, User $user);

    /**
     * @param Order $order
     * @param User $user
     * @param $comment
     * @return boolean
     */
    public function cancel(Order $order, User $user, $comment);
}
