<?php

namespace OtcCms\Models;

final class OrderType
{
    const BUY = 1;
    const SELL = 2;
    private static $texts = [
        self::BUY => '购买',
        self::SELL => '出售',
    ];

    /**
     * @var int
     */
    private $code;

    private function __construct($typeCode)
    {
        $this->code = (int) $typeCode;
    }

    public static function valueOf($typeCode)
    {
        if ($typeCode != self::BUY && $typeCode != self::SELL) {
            throw new \InvalidArgumentException("Order type $typeCode is unknown.");
        }
        return new self($typeCode);
    }

    /**
     * @return mixed
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
