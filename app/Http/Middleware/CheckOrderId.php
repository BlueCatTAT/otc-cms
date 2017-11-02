<?php

namespace OtcCms\Http\Middleware;

use Closure;
use OtcCms\Exceptions\OrderNotFoundException;
use OtcCms\Models\Order;

class CheckOrderId
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
        $order = Order::find($id);
        if (empty($order)) {
            throw new OrderNotFoundException();
        }

        $request->attributes->set('order', $order);
        return $next($request);
    }
}
