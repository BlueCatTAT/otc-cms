<?php

namespace OtcCms\Http\Controllers;

use OtcCms\Models\CryptoCurrencyType;
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

    public function index(WalletRepositoryInterface $walletRepository)
    {
        $type = CryptoCurrencyType::BITCOIN();
        return view('home', [
            'walletSummary' => $walletRepository->getSummary($type),
        ]);
    }
}
