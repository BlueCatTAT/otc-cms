<?php

namespace OtcCms\Services\Repositories\Customer;

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
        return Customer::where('name', 'like', "%$customerName%")
            ->get();
    }
}
