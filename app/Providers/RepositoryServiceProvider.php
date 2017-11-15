<?php

namespace OtcCms\Providers;

use Illuminate\Support\ServiceProvider;
use OtcCms\Services\Repositories\Commission\CommissionRepository;
use OtcCms\Services\Repositories\Commission\CommissionRepositoryInterface;
use OtcCms\Services\Repositories\Customer\CustomerRepository;
use OtcCms\Services\Repositories\Customer\CustomerRepositoryInterface;
use OtcCms\Services\Repositories\Order\OrderAuditLogRepository;
use OtcCms\Services\Repositories\Order\OrderAuditLogRepositoryInterface;
use OtcCms\Services\Repositories\Order\OrderRepository;
use OtcCms\Services\Repositories\Order\OrderRepositoryInterface;
use OtcCms\Services\Repositories\Wallet\WalletRepository;
use OtcCms\Services\Repositories\Wallet\WalletRepositoryInterface;
use OtcCms\Services\Repositories\Withdraw\WithdrawRepository;
use OtcCms\Services\Repositories\Withdraw\WithdrawRepositoryInterface;

class RepositoryServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(
            OrderRepositoryInterface::class,
            OrderRepository::class);
        $this->app->bind(
            CustomerRepositoryInterface::class,
            CustomerRepository::class);
        $this->app->bind(
            OrderAuditLogRepositoryInterface::class,
            OrderAuditLogRepository::class);
        $this->app->bind(
            WithdrawRepositoryInterface::class,
            WithdrawRepository::class);
        $this->app->bind(
            WalletRepositoryInterface::class,
            WalletRepository::class);
        $this->app->bind(
            CommissionRepositoryInterface::class,
            CommissionRepository::class);
    }
}
