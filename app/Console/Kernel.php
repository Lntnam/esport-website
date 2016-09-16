<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

/**
 * Class Kernel
 * @package App\Console
 */
class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        Commands\RunCampaigns::class,
        Commands\TestMailer::class,
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        /*
         * MailChimp campaigns
         */
        $mc_campaigns = config('settings.mc_campaigns');
        foreach ($mc_campaigns as $name => $settings) {
            if ($settings['enabled'] !== true) continue;

            $schedule->command('campaigns:run ' . $name)
                     ->dailyAt($settings['time'])
                     ->timezone(config('settings.default_timezone'));
        }
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
