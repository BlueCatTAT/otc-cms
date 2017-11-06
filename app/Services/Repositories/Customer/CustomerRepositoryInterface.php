<?php
/**
 * Created by PhpStorm.
 * User: pengchi
 * Date: 11/2/17
 * Time: 5:20 PM
 */

namespace OtcCms\Services\Repositories\Customer;

use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Database\Eloquent\Collection;

interface CustomerRepositoryInterface
{

    /**
     * @param string $customerName
     * @param array $columns
     * @return Collection
     */
    public function searchByName($customerName, $columns = ['*']);

    /**
     * @param int $limit
     * @return Paginator
     */
    public function paginate($limit);

    /**
     * @param string $query
     * @return Collection
     */
    public function searchByNameOrId($query);
}
