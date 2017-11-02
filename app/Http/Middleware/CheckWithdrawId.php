<?php

namespace OtcCms\Http\Middleware;

use Closure;
use OtcCms\Exceptions\WithdrawNotFoundException;
use OtcCms\Models\Withdraw;

class CheckWithdrawId
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
        $withdraw = Withdraw::with(['auditLogs'])->find($request->id);
        if (empty($withdraw)) {
            throw new WithdrawNotFoundException();
        }
        $request->attributes->set('withdraw', $withdraw);

        return $next($request);
    }
}
