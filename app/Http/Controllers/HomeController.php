<?php

namespace OtcCms\Http\Controllers;

use Illuminate\Http\Request;
use OtcCms\Models\CryptoCurrencyType;
use OtcCms\Services\Repositories\Commission\CommissionRepositoryInterface;
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

    public function getCommissionList(Request $request,
        CommissionRepositoryInterface $commissionRepository)
    {
        $type = CryptoCurrencyType::BITCOIN();
        $page = $request->input('page', 1);
        $limit = $request->input('limit');
        $commissionList = $commissionRepository->paginate($type, $page, $limit);
        return response()->json($commissionList->toArray());
    }
}
