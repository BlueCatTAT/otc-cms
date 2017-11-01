<?php

namespace OtcCms\Providers;

use function foo\func;
use Illuminate\Support\ServiceProvider;
use OtcCms\Services\OtcServer\ApiClient;
use OtcCms\Services\OtcServer\Withdraw;
use OtcCms\Services\OtcServer\WithdrawInterface;

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
        $this->app->instance(
            'otc.apiclient',
            ApiClient::getInstance($this->app->make('log')));

        $this->app->bind(
            WithdrawInterface::class,
            Withdraw::class
        );
    }
}
