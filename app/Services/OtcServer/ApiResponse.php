<?php

namespace OtcCms\Services\OtcServer;

final class ApiResponse
{
    const API_EXCEPTION = 999999;

    private $code = 0;
    private $message = '';
    private $data = [];

    private function __construct($code, $message, $data)
    {
        $this->code = $code;
        $this->message = $message;
        $this->data = $data;
    }

    public static function create($code, $message, $data = [])
    {
        return new self($code, $message, $data);
    }

    public static function exception($message)
    {
        return self::create(self::API_EXCEPTION, $message);
    }

    /**
     * @return bool
     */
    public function fails()
    {
        return $this->code !== 0;
    }

    /**
     * @return string
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * @return array
     */
    public function getData()
    {
        return $this->data;
    }
}
