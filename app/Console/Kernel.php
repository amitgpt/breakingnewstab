<?php

namespace BreakingNEWSTab\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        Commands\NewsdataCron::class,
        Commands\YoutubeNewsCron::class,
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('inspire')
        //          ->hourly();
        $schedule->command('Newsdata:cron')
                 ->everyMinute();
        //$schedule->command('YoutubeNews:cron')
                 //->hourly(4);
        //$schedule->command('Newsdata:cron')
        //         ->cron('0 */4 * * *');
        //$schedule->command('YoutubeNews:cron')
        //         ->cron('0 */4 * * *');        
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
