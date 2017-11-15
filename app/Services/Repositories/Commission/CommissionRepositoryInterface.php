<?php
/**
 * Created by PhpStorm.
 * User: mc
 * Date: 15/11/2017
 * Time: 11:50 AM
 */

namespace OtcCms\Services\Repositories\Commission;


use Doctrine\Common\Collections\Collection;
use OtcCms\Models\CommissionDaily;
use OtcCms\Models\CryptoCurrencyType;

interface CommissionRepositoryInterface
{
    /**
     * @param CryptoCurrencyType $type
     * @param int $page
     * @param int $limit
     * @return Collection
     */
    public function paginate(CryptoCurrencyType $type, $page = 1, $limit = null);

    /**
     * @param CryptoCurrencyType $type
     * @return int
     */
    public function count(CryptoCurrencyType $type);

    /**
     * @param string $date YYYY-MM-DD
     * @param CryptoCurrencyType $type
     * @return CommissionDaily
     */
    public function calculate($date, CryptoCurrencyType $type);

    /**
     * @return float
     */
    public function getCurrentCommissionRatio();
}