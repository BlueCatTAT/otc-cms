<?php
/**
 * Created by PhpStorm.
 * User: mc
 * Date: 06/11/2017
 * Time: 3:07 PM
 */

namespace OtcCms\Services\Repositories\Withdraw;

use OtcCms\Models\Withdraw;
use OtcCms\Models\WithdrawAuditLog;
use OtcCms\Models\WithdrawStatus;
use OtcCms\Services\OtcServer\WithdrawServiceInterface;
use Auth;

class WithdrawRepository implements WithdrawRepositoryInterface
{

    /**
     * @var WithdrawServiceInterface
     */
    private $withdrawService;

    public function __construct(WithdrawServiceInterface $withdrawService)
    {
        $this->withdrawService = $withdrawService;
    }

    /**
     * @param Withdraw $withdraw
     * @return boolean
     */
    public function confirm(Withdraw $withdraw)
    {
        $result = $this->withdrawService->confirm($withdraw);
        $isSuccess = $result->getResponse()->isSuccessful();
        $postWithdraw = Withdraw::find($withdraw->id);
        $auditLog = WithdrawAuditLog::createInstance(
            Auth::user(),
            $postWithdraw,
            $withdraw,
            WithdrawStatus::WITHDRAW_CONFIRM,
            $isSuccess,
            $result->getRequestId());
        $auditLog->save();
        return $isSuccess;
    }

    /**
     * @param Withdraw $withdraw
     * @param $comment
     * @return boolean
     */
    public function deny(Withdraw $withdraw, $comment)
    {
        $result = $this->withdrawService->deny($withdraw, $comment);
        $isSuccess = $result->getResponse()->isSuccessful();
        $postWithdraw = Withdraw::find($withdraw->id);
        $auditLog = WithdrawAuditLog::createInstance(
            Auth::user(),
            $postWithdraw,
            $withdraw,
            WithdrawStatus::WITHDRAW_DENY,
            $isSuccess,
            $result->getRequestId(),
            $comment
        );
        $auditLog->save();
        return $isSuccess;
    }
}