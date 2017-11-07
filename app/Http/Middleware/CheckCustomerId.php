<?php
/**
 * Created by PhpStorm.
 * User: mc
 * Date: 07/11/2017
 * Time: 9:44 AM
 */

namespace OtcCms\Http\Middleware;


use Closure;
use OtcCms\Exceptions\CustomerNotFoundException;
use OtcCms\Models\Customer;

class CheckCustomerId
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $id = $request->id;
        $customer = Customer::find($id);
        if (empty($customer)) {
            throw new CustomerNotFoundException();
        }

        $request->attributes->set('customer', $customer);
        return $next($request);
    }

}