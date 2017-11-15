<?php
/**
 * Created by PhpStorm.
 * User: mc
 * Date: 15/11/2017
 * Time: 11:50 AM
 */

namespace OtcCms\Services\Repositories\Commission;


use Doctrine\Common\Collections\Collection;
use OtcCms\Models\CryptoCurrencyType;

interface CommissionRepositoryInterface
{
    /**
     * @param CryptoCurrencyType $type
     * @param int $page
     * @param int $limit
     * @return Collection
     */
    public function paginate(CryptoCurrencyType $type, $page, $limit);
}