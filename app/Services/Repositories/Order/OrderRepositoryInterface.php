<?php
/**
 * Created by PhpStorm.
 * User: pengchi
 * Date: 11/2/17
 * Time: 4:41 PM
 */

namespace OtcCms\Services\Repositories\Order;

use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Database\Eloquent\Collection;
use OtcCms\Models\CryptoCurrencyType;
use OtcCms\Models\Order;
use OtcCms\Models\User;

interface OrderRepositoryInterface
{

    /**
     * Search orders by type[exactly] and customerName[like]
     *
     * @param int $type
     * @param string $customerName
     * @return Paginator
     */
    public function paginateWithTypeAndCustomerName($type, $customerName);

    /**
     * @param int $customerId
     * @return Paginator
     */
    public function paginateWithCustomerId($customerId);

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

    /**
     * @param $date
     * @param $type
     * @return array
     */
    public function sumQuantityAndFeeOfFinished($date, CryptoCurrencyType $type);
}
