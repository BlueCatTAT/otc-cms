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
        // When the query has no type parameter, set default value
        $request->query->set('type', $type);
        $customerName = $request->get('nickname', '');
        $orderList = $orderRepository->paginateWithTypeAndCustomerName($type, $customerName);
        return view('order.index', [
            'orderList' => $orderList,
            'orderTypeList' => OrderType::all(),
        ]);
    }

    public function show(Request $request)
    {
        $order = $request->attributes->get('order');

        return view('order.show', [
            'order' => $order,
        ]);
    }

    public function confirmModal(Request $request)
    {
        $order = $request->attributes->get('order');

        return view('order.modals.confirm', [
            'order' => $order,
        ]);
    }

    public function cancelModal(Request $request)
    {
        $order = $request->attributes->get('order');

        return view('order.modals.deny', [
            'order' => $order,
        ]);
    }

    public function confirm(Request $request)
    {

    }

    public function cancel(Request $request)
    {

    }
}
