<?php

namespace OtcCms\Services\Repositories\Customer;

use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Database\Eloquent\Collection;
use OtcCms\Models\Customer;

class CustomerRepository implements CustomerRepositoryInterface
{

    /**
     * @param string $customerName
     * @param array $columns
     * @return Collection
     */
    public function searchByName($customerName, $columns = ['*'])
    {
        return Customer::where('nickname', 'like', "%$customerName%")
            ->get();
    }

    /**
     * @param int $limit
     * @return Paginator
     */
    public function paginate($limit)
    {
        return Customer::paginate($limit);
    }

    /**
     * @param string $query
     * @return Collection
     */
    public function searchByNameOrId($query)
    {
        if (is_numeric($query)) {
            $customer = Customer::find((int) $query);
            return $customer ? collect($customer) : collect([]);
        }

        return $this->searchByName($query);
    }
}
