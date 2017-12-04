<?php

namespace OtcCms\Http\Controllers;

use Illuminate\Http\Request;
use OtcCms\Models\CryptoCurrencyType;
use OtcCms\Services\Repositories\Commission\CommissionRepositoryInterface;

class CommissionController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function getCommissionList(Request $request,
                                      CommissionRepositoryInterface $commissionRepository)
    {
        $page = (int) $request->input('page', 1);
        $limit = (int) $request->input('limit');
        $type = (int) $request->input('type', CryptoCurrencyType::BITCOIN);
        if (!CryptoCurrencyType::isValid($type)) {
            $type = CryptoCurrencyType::BITCOIN;
        }

        $commissionList = $commissionRepository->paginate(
            CryptoCurrencyType::valueOf($type),
            $page,
            $limit);
        return response()->json($commissionList->toArray());
    }
}
