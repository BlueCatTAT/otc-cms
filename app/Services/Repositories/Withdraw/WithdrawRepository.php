<?php
/**
 * Created by PhpStorm.
 * User: mc
 * Date: 06/11/2017
 * Time: 3:07 PM
 */

namespace OtcCms\Services\Repositories\Withdraw;

use OtcCms\Models\StatusLog;
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

    private $query;

    public function __construct(WithdrawServiceInterface $withdrawService)
    {
        $this->withdrawService = $withdrawService;
        $this->query = new Withdraw();
    }

    /**
     * @param Withdraw $withdraw
     * @return boolean
     */
    public function confirm(Withdraw $withdraw)
    {
        $result = $this->withdrawService->confirm($withdraw);
        $isSuccess = $result->getResponse()->isSuccessful();
        $postWithdraw = $this->query->find($withdraw->id);
        $auditLog = WithdrawAuditLog::createInstance(
            Auth::user(),
            $postWithdraw,
            StatusLog::createInstance(
                WithdrawStatus::valueOf(WithdrawStatus::WITHDRAW_CONFIRM),
                $withdraw->getStatusObj(),
                $postWithdraw->getStatusObj()
            ),
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
        $postWithdraw = $this->query->find($withdraw->id);
        $auditLog = WithdrawAuditLog::createInstance(
            Auth::user(),
            $withdraw,
            StatusLog::createInstance(
                WithdrawStatus::valueOf(WithdrawStatus::WITHDRAW_DENY),
                $withdraw->getStatusObj(),
                $postWithdraw->getStatusObj()
            ),
            $isSuccess,
            $result->getRequestId(),
            $comment
        );
        $auditLog->save();
        return $isSuccess;
    }
}