<?php
/**
 * Created by PhpStorm.
 * User: mc
 * Date: 15/11/2017
 * Time: 10:19 AM
 */

namespace OtcCms\Services\Repositories\Wallet;


use OtcCms\Models\CryptoCurrencyType;
use OtcCms\Models\WalletSummary;

interface WalletRepositoryInterface
{
    /**
     * Get the wallet summary, system user(id=1) will be excluded.
     *
     * @param CryptoCurrencyType $type
     * @return WalletSummary
     */
    public function getSummary(CryptoCurrencyType $type);
}