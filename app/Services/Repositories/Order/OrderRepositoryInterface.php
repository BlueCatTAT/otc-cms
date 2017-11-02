<?php
/**
 * Created by PhpStorm.
 * User: pengchi
 * Date: 11/2/17
 * Time: 4:41 PM
 */

namespace OtcCms\Services\Repositories\Order;

use Illuminate\Database\Eloquent\Collection;

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
}
