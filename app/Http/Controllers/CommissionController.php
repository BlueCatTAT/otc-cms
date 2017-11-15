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
        $type = CryptoCurrencyType::BITCOIN();
        $page = $request->input('page', 1);
        $limit = $request->input('limit');
        $commissionList = $commissionRepository->paginate($type, $page, $limit);
        return response()->json($commissionList->toArray());
    }
}
