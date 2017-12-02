<?php
/**
 * Created by PhpStorm.
 * User: mc
 * Date: 15/11/2017
 * Time: 10:33 AM
 */

namespace OtcCms\Models;


use MyCLabs\Enum\Enum;

/**
 * Class CryptoCurrencyType
 * @package OtcCms\Models
 *
 * @method static \OtcCms\Models\CryptoCurrencyType BITCOIN()
 * @method static \OtcCms\Models\CryptoCurrencyType ETHEREUM()
 */
class CryptoCurrencyType extends Enum
{
    const BITCOIN = 1;
    const ETHEREUM = 2;

    public static function valueOf($type)
    {
        if ($type == self::BITCOIN) {
            return self::BITCOIN();
        } elseif ($type == self::ETHEREUM) {
            return self::ETHEREUM();
        }
        throw new \InvalidArgumentException("Unknown crypt type {$type}");
    }
}