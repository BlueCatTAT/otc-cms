<?php

namespace OtcCms\Services\OtcServer;

use OtcCms\Models\Withdraw;
use OtcCms\Models\WithdrawAuditLog;
use OtcCms\Models\WithdrawStatus;
use Auth;

class WithdrawService implements WithdrawServiceInterface
{

    private $client;

    public function __construct(ApiClient $client)
    {
        $this->client = $client;
    }

    /**
     * @param Withdraw $withdraw
     * @return Result
     */
    public function confirm(Withdraw $withdraw)
    {
        if ($withdraw->status == WithdrawStatus::WITHDRAW_PENDING) {
            $response = $this->client->post('/admin/audit', [
                'id' => $withdraw->id,
                'status' => WithdrawStatus::WITHDRAW_CONFIRM,
            ]);
        } else if ($withdraw->status == WithdrawStatus::WITHDRAW_CONFIRM) {
            $response = $this->client->post('/admin/withdraw', [
                'id' => $withdraw->id,
            ]);
        } else {
            $response = ApiResponse::exception("Can't confirm withdraw of status {$withdraw->status}");
        }

        return Result::create($this->client->getLastRequestId(), $response);
    }

    /**
     * @param Withdraw $withdraw
     * @param string $comment
     * @return Result
     */
    public function deny(Withdraw $withdraw, $comment)
    {
        $response = $this->client->post('/admin/audit', [
            'id' => $withdraw->id,
            'status' => WithdrawStatus::WITHDRAW_DENY,
        ]);

        return Result::create($this->client->getLastRequestId(), $response);
    }
}
