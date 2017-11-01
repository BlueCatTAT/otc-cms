<?php

namespace OtcCms\Http\Controllers;

use Illuminate\Http\Request;
use OtcCms\Exceptions\WithdrawNotFoundException;
use OtcCms\Models\Withdraw;
use OtcCms\Models\WithdrawStatus;
use OtcCms\Services\OtcServer\WithdrawInterface;
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

    public function audit($id, Request $request, WithdrawInterface $withdrawService)
    {
        $withdraw = Withdraw::with(['auditLogs'])->find($id);
        if (empty($withdraw)) {
            throw new WithdrawNotFoundException();
        }

        $status = $request->input('status');
        if ($status === WithdrawStatus::WITHDRAW_SUCCESS) {
            $withdrawService->confirm($withdraw->id);
        } else if ($status === WithdrawStatus::WITHDRAW_DENY) {
            $withdrawService->deny($withdraw->id);
        }

        return redirect()->back();
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
