<?php

namespace OtcCms\Providers;

use Illuminate\Support\ServiceProvider;
use OtcCms\Services\Repositories\Customer\CustomerRepository;
use OtcCms\Services\Repositories\Customer\CustomerRepositoryInterface;
use OtcCms\Services\Repositories\Order\OrderRepository;
use OtcCms\Services\Repositories\Order\OrderRepositoryInterface;

class RepositoryServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(OrderRepositoryInterface::class, OrderRepository::class);
        $this->app->bind(CustomerRepositoryInterface::class, CustomerRepository::class);
    }
}
