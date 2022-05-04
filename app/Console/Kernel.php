<?php

namespace App\Console;

use App\Console\Commands\SendBillCommand;
use App\Console\Commands\SendDebtCommand;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    protected $commands = [
        SendBillCommand::class,
        SendDebtCommand::class,
    ];

    /**
     * Define the application's command schedule.
     *
     * @param Schedule $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('send:bill')->monthlyOn(30, '07:00');
        // $schedule->command('send:debt')->monthlyOn(5, '07:00');
        $schedule->command('send:vehiclecard')->everyMinute();
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__ . '/Commands');

        require base_path('routes/console.php');
    }
}
