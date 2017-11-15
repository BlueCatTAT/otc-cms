<?php
/**
 * Created by PhpStorm.
 * User: mc
 * Date: 15/11/2017
 * Time: 10:19 AM
 */

namespace OtcCms\Services\Repositories\Wallet;


interface WalletRepositoryInterface
{
    /**
     * Get the wallet summary, system user(id=1) will be excluded.
     *
     * @return WalletSummary
     */
    public function getSummary(CryptoCurrencyType $type);
}