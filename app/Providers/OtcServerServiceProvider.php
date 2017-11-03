<?php

namespace OtcCms\Providers;

use function foo\func;
use Illuminate\Support\ServiceProvider;
use OtcCms\Services\OtcServer\ApiClient;
use OtcCms\Services\OtcServer\OrderServiceInterface;
use OtcCms\Services\OtcServer\WithdrawService;
use OtcCms\Services\OtcServer\WithdrawServiceInterface;

class OtcServerServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            WithdrawServiceInterface::class,
            WithdrawService::class
        );
        $this->app->bind(
            OrderServiceInterface::class,
            config('services.otc_server.OrderService')
        );
    }
}
