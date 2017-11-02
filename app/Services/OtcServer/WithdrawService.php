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
     * @return bool
     */
    public function confirm(Withdraw $withdraw)
    {
        $response = $this->client->post('/admin/audit', [
            'id' => $withdraw->id,
            'status' => WithdrawStatus::WITHDRAW_CONFIRM,
        ]);

        $isSuccess = $response->isSuccessful();
        $postWithdraw = Withdraw::find($withdraw->id);
        $auditLog = WithdrawAuditLog::createInstance(
            Auth::user(),
            $postWithdraw,
            $withdraw,
            WithdrawStatus::WITHDRAW_CONFIRM,
            $isSuccess,
            $this->client->getLastRequestId());
        $auditLog->save();

        return $isSuccess;
    }

    /**
     * @param Withdraw $withdraw
     * @param string $comment
     * @return bool
     */
    public function deny(Withdraw $withdraw, $comment)
    {
        $response = $this->client->post('/admin/audit', [
            'id' => $withdraw->id,
            'status' => WithdrawStatus::WITHDRAW_DENY,
        ]);

        $isSuccess = $response->isSuccessful();
        $postWithdraw = Withdraw::find($withdraw->id);
        $auditLog = WithdrawAuditLog::createInstance(
            Auth::user(),
            $postWithdraw,
            $withdraw,
            WithdrawStatus::WITHDRAW_DENY,
            $isSuccess,
            $this->client->getLastRequestId(),
            $comment
        );
        $auditLog->save();

        return $isSuccess;
    }
}
