<?php

namespace OtcCms\Http\Controllers;

use Illuminate\Http\Request;
use OtcCms\Models\Withdraw;
use OtcCms\Models\WithdrawStatus;

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
                         'uid', 'uname', 'amount', 'create_time', 'status'
                     ]);
        return view('withdraw.index', [
            'withdrawList' => $withdraws,
            'statusList' => $statusList,
        ]);
    }

    public function logList()
    {
        return view('withdraw.log');
    }
}
