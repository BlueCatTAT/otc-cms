<?php

namespace OtcCms\Http\Controllers;

use Illuminate\Http\Request;
use OtcCms\Models\Withdraw;
use OtcCms\Models\WithdrawAuditLog;
use OtcCms\Models\WithdrawStatus;
use OtcCms\Services\OtcServer\WithdrawServiceInterface;
use OtcCms\Services\Repositories\Withdraw\WithdrawRepositoryInterface;
use Symfony\Component\Routing\Exception\MissingMandatoryParametersException;
use Auth;


class WithdrawController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $statusListKey = 'statusList';
        $statusList = [
            WithdrawStatus::valueOf(WithdrawStatus::WITHDRAW_PENDING),
            WithdrawStatus::valueOf(WithdrawStatus::WITHDRAW_SUCCESS),
            WithdrawStatus::valueOf(WithdrawStatus::WITHDRAW_FAIL),
            WithdrawStatus::valueOf(WithdrawStatus::WITHDRAW_DENY),
        ];
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

    public function show(Request $request)
    {
        $withdraw = $request->get('withdraw');
        return view('withdraw.show', [
            'withdraw' => $withdraw,
        ]);
    }

    public function confirm(Request $request, WithdrawRepositoryInterface $withdrawService)
    {
        $withdraw = $request->get('withdraw');


        if ($withdrawService->confirm($withdraw)) {
            return redirect()->back()->with('message', '提币成功');
        }
        return redirect()->back()->withErrors('提币失败');
    }

    public function deny(Request $request, WithdrawRepositoryInterface $withdrawRepository)
    {
        $withdraw = $request->get('withdraw');

        $comment = $request->input('comment');
        if (empty($comment)) {
            throw new MissingMandatoryParametersException('Comment cannot be empty');
        }


        if ($withdrawRepository->deny($withdraw, $comment)) {
            return redirect()->back()->with('message', '操作成功');
        }
        return redirect()->back()->withErrors('操作失败');
    }

    public function auditConfirmModal(Request $request)
    {
        $withdraw = $request->get('withdraw');

        return view('withdraw.modals.audit-confirm', [
            'withdraw' => $withdraw,
        ]);
    }

    public function auditDenyModal(Request $request)
    {
        $withdraw = $request->get('withdraw');

        return view('withdraw.modals.audit-deny', [
            'withdraw' => $withdraw,
        ]);
    }

    public function logList()
    {
        return view('withdraw.log');
    }
}
