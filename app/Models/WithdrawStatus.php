<?php

namespace OtcCms\Models;

final class WithdrawStatus implements NumericCodeInterface
{

    const WITHDRAW_CREATED = 10;
    const WITHDRAW_COMMITTED = 20;
    const WITHDRAW_PENDING = 30;
    const WITHDRAW_CONFIRM = 40;
    const WITHDRAW_DENY = 50;
    const WITHDRAW_SUCCESS = 60;
    const WITHDRAW_FAIL = 70;

    protected static $statusList = [];
    private static $validStatus = [
        self::WITHDRAW_CREATED,
        self::WITHDRAW_COMMITTED,
        self::WITHDRAW_PENDING,
        self::WITHDRAW_CONFIRM,
        self::WITHDRAW_DENY,
        self::WITHDRAW_SUCCESS,
        self::WITHDRAW_FAIL,
    ];

    private $statusCode;

    private function __construct($status)
    {
        if (!in_array($status, self::$validStatus)) {
            throw new \InvalidArgumentException("Withdraw status no exist $status");
        }
        $this->statusCode = $status;
    }

    /**
     * @param int $status
     * @return self
     */
    public static function valueOf($status)
    {
        $status = (int) $status;
        if (empty(self::$statusList[$status])) {
            self::$statusList[$status] = new self($status);
        }
        return self::$statusList[$status];
    }

    /**
     * @return array
     */
    public static function getStatusList()
    {
        if (count(self::$statusList) != count(self::$validStatus)) {
            foreach (self::$validStatus as $status) {
                self::valueOf($status);
            }
        }

        return self::$statusList;
    }

    private static function sGetStatusText($status)
    {
        switch ($status) {
            case self::WITHDRAW_CREATED:
                return '新建';
            case self::WITHDRAW_COMMITTED:
                return '用户已确认';
            case self::WITHDRAW_PENDING:
                return '待审核';
            case self::WITHDRAW_CONFIRM:
                return '审核通过';
            case self::WITHDRAW_SUCCESS:
                return '提现成功';
            case self::WITHDRAW_FAIL:
                return '提现失败';
            case self::WITHDRAW_DENY:
                return '审核未通过';
            default:
                return '未知 '.$status;
        }
    }

    public function getStatusText()
    {
        return self::sGetStatusText($this->statusCode);
    }

    /**
     * @return int
     */
    public function getStatusCode()
    {
        return $this->statusCode;
    }

    /**
     * @return int
     */
    public function getCode()
    {
        return $this->getStatusCode();
    }

    /**
     * @return string
     */
    public function getText()
    {
        return $this->getStatusText();
    }
}
