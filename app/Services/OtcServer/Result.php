<?php

namespace OtcCms\Services\OtcServer;

final class Result
{
    /**
     * @var string
     */
    private $requestId;

    /**
     * @var ApiResponse
     */
    private $response;

    public function __construct($requestId, ApiResponse $response)
    {
        $this->requestId = $requestId;
        $this->response = $response;
    }

    /**
     * @return ApiResponse
     */
    public function getResponse()
    {
        return $this->response;
    }

    /**
     * @return string
     */
    public function getRequestId()
    {
        return $this->requestId;
    }


}
