<?php

namespace OtcCms\Http\Controllers;

use Illuminate\Http\Request;
use OtcCms\Services\Repositories\Wallet\WalletRepositoryInterface;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(WalletRepositoryInterface $walletRepository)
    {
        return view('home', [
            'walletSummary' => $walletRepository->getSummary(),
        ]);
    }
}
