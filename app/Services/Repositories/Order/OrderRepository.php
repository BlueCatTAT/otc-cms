<?php

namespace OtcCms\Services\Repositories\Order;

use function foo\func;
use Illuminate\Database\Eloquent\Collection;
use DB;
use OtcCms\Models\Customer;
use OtcCms\Models\Order;
use OtcCms\Services\Repositories\Customer\CustomerRepositoryInterface;

class OrderRepository implements OrderRepositoryInterface
{

    /**
     * @var CustomerRepositoryInterface
     */
    protected $customerRepository;

    public function __construct(CustomerRepositoryInterface $customerRepository)
    {
        $this->customerRepository = $customerRepository;
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
}
