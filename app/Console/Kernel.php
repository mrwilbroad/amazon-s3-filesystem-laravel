<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Illuminate\Support\Facades\DB;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
        // $schedule->command('inspire')->hourly();

        // to prune all expired task from the db
        $schedule->command('sanctum:prune-expired --hours=720')
        ->daily()
        ->sendOutputTo('output.log');
        $schedule->call(function(){
            DB::table('tasks')->where("id","<",10)->delete();
        })->everyMinute()
          ->sendOutputTo('output.log');
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
