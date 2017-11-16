<?php
/**
 * Created by PhpStorm.
 * User: mc
 * Date: 15/11/2017
 * Time: 10:21 AM
 */

namespace OtcCms\Models;


use Webmozart\Assert\Assert;

final class WalletSummary
{
    /**
     * @var CryptoCurrencyType
     */
    private $cryptoCurrencyType;

    /**
     * @var float
     */
    private $locked;

    /**
     * Coins available for transfer
     *
     * @var float
     */
    private $balance;

    /**
     * @var float
     */
    private $total;

    public static function create(CryptoCurrencyType $type, $locked, $balance)
    {
        Assert::greaterThanEq($locked, 0, 'Locked value must be greater than 0');
        Assert::greaterThanEq($balance, 0, 'Balance value must be greater than 0');
        $summary = new self();
        $summary->cryptoCurrencyType = $type;
        $summary->locked = $locked;
        $summary->balance = $balance;
        $summary->total = $locked + $balance;
        return $summary;
    }

    /**
     * @return float
     */
    public function getLocked()
    {
        return $this->locked;
    }

    /**
     * @return float
     */
    public function getBalance()
    {
        return $this->balance;
    }

    /**
     * @return float
     */
    public function getTotal()
    {
        return $this->total;
    }

    public function getCryptoTypeName()
    {
        return $this->cryptoCurrencyType->getKey();
    }
}