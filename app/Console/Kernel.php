<?php

namespace OtcCms\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use OtcCms\Console\Commands\AttachRole;
use OtcCms\Console\Commands\CommissionDailyCommand;
use OtcCms\Console\Commands\CreateUser;
use OtcCms\Console\Commands\InitRoles;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        //
        CreateUser::class,
        InitRoles::class,
        AttachRole::class,
        CommissionDailyCommand::class,
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->command('commission:daily')->daily();
    }

    /**
     * Register the Closure based commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        require base_path('routes/console.php');
    }
}
