<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Popplestones\Quickbooks\Console\Commands\QbAccountImport;
use Popplestones\Quickbooks\Console\Commands\QbAdjustmentImport;
use Popplestones\Quickbooks\Console\Commands\QbCustomerImport;
use Popplestones\Quickbooks\Console\Commands\QbInvoiceImport;
use Popplestones\Quickbooks\Console\Commands\QbItemImport;
use Popplestones\Quickbooks\Console\Commands\QbPaymentImport;
use Popplestones\Quickbooks\Console\Commands\QbTermImport;

class Kernel extends ConsoleKernel
{
    protected $commands = [
        QbAccountImport::class,
        QbTermImport::class,
        QbCustomerImport::class,
        QbItemImport::class,
        QbInvoiceImport::class,
        QbAdjustmentImport::class,
        QbPaymentImport::class
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->command('horizon:snapshot')->everyFiveMinutes();
        $schedule->command('telescope:prune --hours=48')->daily();
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
