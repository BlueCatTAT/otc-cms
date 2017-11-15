<?php
/**
 * Created by PhpStorm.
 * User: mc
 * Date: 15/11/2017
 * Time: 11:54 AM
 */

namespace OtcCms\Services\Repositories\Commission;


use Doctrine\Common\Collections\Collection;
use OtcCms\Models\CryptoCurrencyType;

class CommissionRepositoryArray implements CommissionRepositoryInterface
{

    /**
     * @param CryptoCurrencyType $type
     * @param int $page
     * @param int $limit
     * @return Collection
     */
    public function paginate(CryptoCurrencyType $type, $page, $limit)
    {
        return collect([
            [
                'id' => 1,
                'crypto_type' => $type->getValue(),
                'date' => date('Y-m-d'),
                'commission' => 0.1,
                'total' => 100,
                'ratio' => (0.1/100)*100000,
            ],
            [
                'id' => 2,
                'crypto_type' => $type->getValue(),
                'date' => date('Y-m-d', strtotime('-1 day')),
                'commission' => 0.05,
                'total' => 99,
                'ratio' => (0.05/99)*100000,
            ],
            [
                'id' => 3,
                'crypto_type' => $type->getValue(),
                'date' => date('Y-m-d', strtotime('-2 days')),
                'commission' => 0.2,
                'total' => 300,
                'ratio' => (0.2/300)*100000,
            ]
        ]);
    }
}