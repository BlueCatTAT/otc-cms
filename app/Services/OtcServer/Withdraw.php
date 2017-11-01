<?php

namespace OtcCms\Services\OtcServer;

use OtcCms\Models\WithdrawStatus;

class Withdraw implements WithdrawInterface
{

    private $client;

    public function __construct(ApiClient $client)
    {
        $this->client = $client;
    }

    /**
     * @param int $withdrawId
     * @return bool
     */
    public function confirm($withdrawId)
    {
        $response = $this->client->post('/admin/audit', [
            'id' => $withdrawId,
            'status' => WithdrawStatus::WITHDRAW_SUCCESS,
        ]);

        return $response->fails();
    }

    /**
     * @param int $withdrawId
     * @return bool
     */
    public function deny($withdrawId)
    {
        $response = $this->client->post('/admin/audit', [
            'id' => $withdrawId,
            'status' => WithdrawStatus::WITHDRAW_DENY,
        ]);

        return $response->fails();
    }
}
