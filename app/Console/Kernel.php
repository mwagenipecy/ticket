<?php

namespace App\Console;

use App\Jobs\EndOfDay;
use App\Jobs\ReadEmailsJob;
use Carbon\Carbon;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use App\Jobs\ProcessEmailsJob;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
      //  $schedule->job(new ReadEmailsJob)->everyTenMinutes();

        // $schedule->job(new ProcessEmailsJob())->cron('*/20 * * * *');

        $schedule->job(new ProcessEmailsJob())->everyMinute();
        
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands(): void
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
