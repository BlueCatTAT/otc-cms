<?php

namespace OtcCms\Services\OtcServer;

use GuzzleHttp\Client;
use Illuminate\Contracts\Logging\Log;

class ApiClient
{
    /**
     * @var Log
     */
    private $log;

    /**
     * @var Client
     */
    private $client;

    private function __construct(Log $log)
    {
        $this->client = new Client([
            'base_uri' => config('services.otc_server.host')
        ]);
        $this->log = $log;
    }

    public static function getInstance(Log $log)
    {
        return new self($log);
    }

    /**
     * @param $endpoint
     * @param array $data
     * @return ApiResponse
     */
    public function post($endpoint, array $data)
    {
        try {
            $response = $this->client->request('POST', $endpoint, [
                'json' => $data,
            ]);
        } catch (\Exception $e) {
            $this->log->error($e->getMessage(), [
                'context' => __CLASS__.':'.__METHOD__,
                'endpoint' => $endpoint,
                'data' => $data,
            ]);
            return ApiResponse::exception($e->getMessage());
        }

        if ($response->getStatusCode() != 200) {
            return ApiResponse::exception($response->getBody());
        }
        $result = @json_decode($response->getBody());
        if (empty($result)) {
            return ApiResponse::exception($response->getBody());
        }
        return ApiResponse::create($result['code'], $result['msg'], $result['data']);
    }
}
