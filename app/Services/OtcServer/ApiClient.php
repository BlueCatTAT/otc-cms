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

    public function __construct(Log $log)
    {
        $this->client = new Client([
            'base_uri' => config('services.otc_server.host')
        ]);
        $this->log = $log;
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

        $body = $response->getBody();
        $this->log->info($body, [
            'context' => 'ApiClient response body',
            'endpoint' => $endpoint,
            'data' => $data,
        ]);

        if ($response->getStatusCode() != 200) {
            return ApiResponse::exception($body);
        }
        $result = @json_decode($body, true);
        if (empty($result) || empty($result['code'])) {
            return ApiResponse::exception($body);
        }

        return ApiResponse::create(
            $result['code'],
            isset($result['msg']) ? $result['msg'] : '',
            isset($result['data']) ? $result['data']: []
        );
    }
}
