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

    public function index(WalletRepositoryInterface $walletRepository,
                          CommissionRepositoryInterface $commissionRepository,
                          Request $request)
    {
        $type = (int) $request->query->get('type', CryptoCurrencyType::BITCOIN);
        if (!CryptoCurrencyType::isValid($type)) {
            $type = CryptoCurrencyType::BITCOIN;
        }
        $type = CryptoCurrencyType::valueOf($type);
        $request->query->set('type', $type->getValue());

        $limit = config('view.paginator.limit');
        $commissionDaily = $commissionRepository->calculate(date('Y-m-d'), $type);
        return view('home', [
            'walletSummary' => $walletRepository->getSummary($type),
            'commissionPageCount' => ceil($commissionRepository->count($type)/$limit),
            'commissionToday' => $commissionDaily,
            'currentCommissionRatio' => $commissionRepository->getCurrentCommissionRatio(),
        ]);
    }
}
