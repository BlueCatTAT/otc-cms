<?php

namespace OtcCms\Models;

final class OrderStatus
{
    const CANCELED = 0;
    const WAITING_FOR_PAYMENT = 10;
    const PAID = 20;
    const PAYMENT_RECEIVED = 30;
    const DONE = 40;

    private static $statusList = [
        self::CANCELED => '已取消',
        self::WAITING_FOR_PAYMENT => '待付款',
        self::PAID => '已付款',
        self::PAYMENT_RECEIVED => '已收款',
        self::DONE => '已完成',
    ];

    private static $statusObjectList = [];

    private $code;

    private function __construct($code)
    {
        $this->code = $code;
    }

    /**
     * @param int $code
     * @throws \InvalidArgumentException
     * @return self
     */
    public static function valueOf($code)
    {
        if (empty(self::$statusList[$code])) {
            throw new \InvalidArgumentException("Order status $code is unknown");
        }

        if (empty(self::$statusObjectList[$code])) {
            self::$statusObjectList[$code] = new self($code);
        }
        return self::$statusObjectList[$code];
    }

    public function getText()
    {
        return self::$statusList[$this->code];
    }

    /**
     * @return int
     */
    public function getCode()
    {
        return $this->code;
    }
}
