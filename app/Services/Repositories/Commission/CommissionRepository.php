<?php
/**
 * Created by PhpStorm.
 * User: mc
 * Date: 15/11/2017
 * Time: 3:41 PM
 */

namespace OtcCms\Services\Repositories\Commission;


use Doctrine\Common\Collections\Collection;
use OtcCms\Models\CommissionDaily;
use OtcCms\Models\CryptoCurrencyType;

class CommissionRepository implements CommissionRepositoryInterface
{

    /**
     * @param CryptoCurrencyType $type
     * @param int $page
     * @param int $limit
     * @return Collection
     */
    public function paginate(CryptoCurrencyType $type, $page = 1, $limit = null)
    {
        if (empty($limit)) {
            $limit = config('view.paginator.limit');
        }
        $query = new CommissionDaily();
        return $query->select(['total', 'ratio', 'commission', 'date'])
            ->where('crypto_type', $type->getValue())
            ->limit($limit)
            ->offset(($page-1)*$limit)
            ->orderBy('date', 'desc')
            ->get();
    }

    /**
     * @param CryptoCurrencyType $type
     * @return int
     */
    public function count(CryptoCurrencyType $type)
    {
        $query = new CommissionDaily();
        return $query
            ->where('crypto_type', $type->getValue())
            ->count();
    }
}