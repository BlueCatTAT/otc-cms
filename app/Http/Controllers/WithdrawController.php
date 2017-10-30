<?php

namespace OtcCms\Http\Controllers;

use Illuminate\Http\Request;
use OtcCms\Models\Withdraw;

class WithdrawController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $withdraws = Withdraw::paginate(30);
        return view('withdraw.index', [
            'withdrawList' => $withdraws,
        ]);
    }

    public function logList()
    {
        return view('withdraw.log');
    }
}
