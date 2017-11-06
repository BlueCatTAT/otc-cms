<?php

namespace OtcCms\Http\Controllers;

use Illuminate\Http\Request;
use OtcCms\Services\Repositories\Customer\CustomerRepositoryInterface;

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

    }
}
