<?php

namespace OtcCms\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use OtcCms\Models\OrderType;
use OtcCms\Services\Repositories\Order\OrderRepositoryInterface;
use Auth;

class OrderController extends Controller
{
    //
    public function index(Request $request, OrderRepositoryInterface $orderRepository)
    {
        $type = (int) $request->get('type', OrderType::BUY);
        // When the query has no type parameter, set default value
        $request->query->set('type', $type);
        $customerName = $request->get('nickname', '');
        $sn = $request->get('sn');
        if ($sn) {
            $orderList = [ $orderRepository->findBySn($sn) ];
        } else {
            $orderList = $orderRepository->paginateWithTypeAndCustomerName($type, $customerName);
        }
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

    public function confirm(Request $request, OrderRepositoryInterface $orderRepository)
    {
        $order = $request->attributes->get('order');
        if ($orderRepository->confirm($order, Auth::user())) {
            return redirect()->back()->with('message', '订单已确认');
        }
        return redirect()->back()->withErrors('操作失败');
    }

    public function cancel(Request $request, OrderRepositoryInterface $orderRepository)
    {
        $order = $request->attributes->get('order');
        $comment = $request->input('comment');
        if (empty($comment)) {
            return redirect()->back()->withErrors('备注不能为空');
        }

        if ($orderRepository->cancel($order, Auth::user(), $comment)) {
            return redirect()->back()->with('message', '订单已取消');
        }
        return redirect()->back()->withErrors('操作失败');
    }
}
