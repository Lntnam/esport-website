<?php

namespace App\Console\Commands;

use App\FixtureMailer;
use App\Repositories\MailCampaignRepository;
use Carbon\Carbon;
use DrewM\MailChimp\MailChimp;
use Illuminate\Console\Command;

/**
 * Class RunCampaigns
 * @package App\Console\Commands
 */
class RunCampaigns extends Command
{
    /**
     * @var MailChimp
     */
    protected $mc;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'campaigns:run {type}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check and run MailChimp campaigns';

    /**
     * Create a new command instance.
     *
     * @param MailChimp $mc
     */
    public function __construct(MailChimp $mc)
    {
        $this->mc = $mc;

        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        // get settings
        $config = config('settings.mc_campaigns');
        $type = $this->argument('type');

        if (isset($config[$type])) {
            $settings = $config[$type];
            if ($this->validateCampaignSchedule($type, $settings)) {
                switch ($type) {
                    case 'fixtures':
                        $mailer = new FixtureMailer($settings);
                        $mailer->run();
                        break;
                }
            }
        }
    }

    /**
     * @param $type
     * @param $settings
     *
     * @return boolean
     */
    private function validateCampaignSchedule($type, $settings)
    {
        $latest = MailCampaignRepository::getLatestByType($type);
        $every = $settings['by']['every'];
        $on = $settings['by']['on'];
        $last_run = $latest->getAttribute('created_at');
        $today = Carbon::tomorrow('UTC')
                       ->subSecond(1); // at 23:59:59

        switch ($settings['by']['unit']) {
            case 'day':
                return $last_run->diffInDays($today) >= $every;
                break;
            case 'week':
                return $last_run->diffInWeeks($today) >= $every && $on == $today->format('N');
                break;
            case 'month':
                return $last_run->diffInMonths($today) >= $every && $on == $today->format('j');
                break;
            case 'year':
                return $last_run->diffInYears($today) >= $every && $on == $today->format('j n');
                break;
        }

        return true;
    }
}
