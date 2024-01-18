<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use App\Jobs\SaveExchangeRateAPIToDB;

class Kernel extends ConsoleKernel
{

    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
        // $schedule->command('inspire')->hourly();
        // $schedule->command('app:get-exchange-rate-a-p-i')->everyMinute();
        
        $schedule->job(new SaveExchangeRateAPIToDB, 'exchangerates', env('QUEUE_CONNECTION', 'database'))->dailyAt(env('SCHEDULER_QUEUE_TIME'));
    }

    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
