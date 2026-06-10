<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use App\Models\Rememberlist;
use Illuminate\Support\Facades\Log; // Import Log facade

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('delete-expired-rows')->everyMinute();
        $schedule->call(function(){
            try {
                Rememberlist::where('status', '=', 1)->delete();
                Log::info('Deletion successful');
            } catch (\Exception $e) {
                Log::error('Deletion failed: ' . $e->getMessage());
            }
        })->everyMinute();
    }
   

    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__.'/Commands');
        // $this->commands([
        //     Commands\DeleteExpiredRows::class,
        // ]);
        require base_path('routes/console.php');
    }
 
}
