<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use App\Models\ActivityLog;

class Kernel extends ConsoleKernel {

    // #SET CRONS
    protected function schedule(Schedule $schedule) {

        // #CLEAN OLD BACKUPS
        $schedule->command('backup:clean')
                ->dailyAt('03:00');

        // #MAKE NEW BACKUPS
        $schedule->command('backup:run --only-db')
                ->dailyAt('03:00');

        // #DELETE USER ACTIVITY LOG
        $schedule->call(function () {
            $days = config('cms.activity_log_expire');
            $date = date('Y-m-d H:i:s', strtotime("-$days days"));
            ActivityLog::where('updated_at', '<', $date)->delete();
        })->dailyAt('03:00');

        // #CHECK HEALTH
        $schedule->command('health:panel')
                ->hourly();
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands() {
        $this->load(__DIR__ . '/Commands');

        require base_path('routes/console.php');
    }

}
