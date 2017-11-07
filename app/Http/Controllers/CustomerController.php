<?php

namespace OtcCms\Http\Controllers;

use Illuminate\Http\Request;
use OtcCms\Services\Repositories\Customer\CustomerRepositoryInterface;
use OtcCms\Services\Repositories\Order\OrderRepositoryInterface;

class CustomerController extends Controller
{
    public function index(Request $request, CustomerRepositoryInterface $customerRepository)
    {
        $query = $request->input('query');
        if (empty($query)) {
            $customerList = $customerRepository->paginate(30);
        } else {
            $customerList = $customerRepository->searchByNameOrId($query);
        }

        return view('customer.index', [
            'customerList' => $customerList,
        ]);
    }

    public function show(Request $request)
    {
        $customer = $request->get('customer');
        return view('customer.show', [
            'customer' => $customer,
        ]);
    }

    public function orderList(Request $request, OrderRepositoryInterface $orderRepository)
    {
        $customer = $request->get('customer');
        $orderList = $orderRepository->paginateWithCustomerId($customer->id);
        return view('customer.order-list', [
            'customer' => $customer,
            'orderList' => $orderList,
        ]);
    }

    public function adList(Request $request)
    {
        $customer = $request->get('customer');
        return view('customer.ad-list', [
            'customer' => $customer,
        ]);
    }

    public function withdrawList(Request $request)
    {
        $customer = $request->get('customer');
        return view('customer.withdraw-list', [
            'customer' => $customer,
        ]);
    }
}
