<?php

namespace OtcCms\Http\Controllers;

use Illuminate\Http\Request;
use OtcCms\Exceptions\WithdrawNotFoundException;
use OtcCms\Models\Withdraw;
use OtcCms\Models\WithdrawStatus;
use OtcCms\Services\OtcServer\WithdrawServiceInterface;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class WithdrawController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $statusListKey = 'statusList';
        $statusList = WithdrawStatus::getStatusList();
        if (empty($request->get($statusListKey))) {
            $request->request->set($statusListKey, [WithdrawStatus::WITHDRAW_PENDING]);
        }
        $withdraws = Withdraw::whereIn('status', $request->get($statusListKey))
                     ->orderBy('create_time', 'desc')
                     ->paginate(30, [
                         'id', 'uid', 'uname', 'amount', 'create_time', 'status'
                     ]);
        return view('withdraw.index', [
            'withdrawList' => $withdraws,
            'statusList' => $statusList,
        ]);
    }

    public function show($id)
    {
        $withdraw = Withdraw::with(['auditLogs'])->find($id);
        if (empty($withdraw)) {
            throw new WithdrawNotFoundException();
        }
        return view('withdraw.show', [
            'withdraw' => $withdraw,
        ]);
    }

    public function audit($id, Request $request, WithdrawServiceInterface $withdrawService)
    {
        $withdraw = Withdraw::with(['auditLogs'])->find($id);
        if (empty($withdraw)) {
            throw new WithdrawNotFoundException();
        }

        $status = (int) $request->input('status');
        $message = '操作失败';
        $result = false;
        if ($status === WithdrawStatus::WITHDRAW_SUCCESS) {
            if ($result = $withdrawService->confirm($withdraw->id)) {
                $message = '提币成功';
            }
        } else if ($status === WithdrawStatus::WITHDRAW_DENY) {
            if ($result = $withdrawService->deny($withdraw->id))  {
                $message = '审核成功';
            }
        }

        if ($result) {
            return redirect()->back()->with('message', $message);
        } else {
            return redirect()->back()->withErrors($message);
        }
    }

    public function auditConfirmModal($id)
    {
        $withdraw = Withdraw::with(['auditLogs'])->find($id);
        if (empty($withdraw)) {
            throw new WithdrawNotFoundException();
        }

        return view('withdraw.modals.audit-confirm', [
            'withdraw' => $withdraw,
        ]);
    }

    public function logList()
    {
        return view('withdraw.log');
    }
}
