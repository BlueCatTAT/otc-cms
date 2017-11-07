<?php
/**
 * Created by PhpStorm.
 * User: mc
 * Date: 07/11/2017
 * Time: 11:27 AM
 */

namespace OtcCms\Models;


class AdvertisementStatus implements NumericCodeInterface
{
    const VALID = 1;
    const INVALID = 0;

    private static $texts = [
        self::VALID => '有效',
        self::INVALID => '无效',
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
            throw new \InvalidArgumentException("Advertisement status $code is unknown.");
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