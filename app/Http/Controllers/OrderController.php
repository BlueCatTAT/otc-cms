<?php

namespace OtcCms\Http\Controllers;

use Illuminate\Http\Request;
use OtcCms\Models\Order;
use OtcCms\Models\OrderType;
use OtcCms\Services\Repositories\Order\OrderRepositoryInterface;

class OrderController extends Controller
{
    //
    public function index(Request $request, OrderRepositoryInterface $orderRepository)
    {
        $type = (int) $request->get('type', OrderType::BUY);
        $customerName = $request->get('nickname', '');
        $orderList = $orderRepository->paginateWithTypeAndCustomerName($type, $customerName);
        return view('order.index', [
            'orderList' => $orderList,
        ]);
    }

    public function show()
    {

    }
}
