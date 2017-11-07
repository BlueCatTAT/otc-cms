<?php
/**
 * Created by PhpStorm.
 * User: mc
 * Date: 07/11/2017
 * Time: 11:27 AM
 */

namespace OtcCms\Models;


final class AdvertisementType implements NumericCodeInterface
{

    const BUY = 1;
    const SELL = 2;

    private static $texts = [
        self::BUY => '购买',
        self::SELL => '出售',
    ];

    private static $instances = [];

    /**
     * @var int
     */
    private $code;

    private function __construct($code)
    {
        $this->code = $code;
    }

    public static function valueOf($code)
    {
        if (!isset(self::$texts[$code])) {
            throw new \InvalidArgumentException("Advertisement type $code is unknown.");
        }
        if (!isset(self::$instances[$code])) {
            self::$instances[$code] = new self($code);
        }
        return self::$instances[$code];
    }

    /**
     * @return int
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * @return string
     */
    public function getText()
    {
        return self::$texts[$this->code];
    }
}