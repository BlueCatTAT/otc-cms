<?php
/**
 * Created by PhpStorm.
 * User: mc
 * Date: 15/11/2017
 * Time: 10:37 AM
 */

namespace OtcCms\Services\Repositories\Wallet;


use OtcCms\Models\CryptoCurrencyType;
use OtcCms\Models\Customer;
use OtcCms\Models\Wallet;
use OtcCms\Models\WalletSummary;

class WalletRepository implements WalletRepositoryInterface
{

    /**
     * Get the wallet summary, system user(id=1) will be excluded.
     *
     * @param CryptoCurrencyType $type
     * @return WalletSummary
     */
    public function getSummary(CryptoCurrencyType $type)
    {
        $sql = "SUM(locked) AS locked, SUM(balance) AS balance";
        $query = new Wallet();
        $result = $query->selectRaw($sql)
            ->where('uid', '<>', Customer::SYS_USER_ID)
            ->where('token_type', $type->getValue())
            ->first();
        $locked = $result['locked'] ?: 0.0;
        $balance = $result['balance'] ?: 0.0;
        $summary = WalletSummary::create($type, $locked, $balance);
        return $summary;
    }
}