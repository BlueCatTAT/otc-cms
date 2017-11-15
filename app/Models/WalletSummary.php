<?php
/**
 * Created by PhpStorm.
 * User: mc
 * Date: 15/11/2017
 * Time: 10:21 AM
 */

namespace OtcCms\Models;


final class WalletSummary
{
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

    private $total;
}