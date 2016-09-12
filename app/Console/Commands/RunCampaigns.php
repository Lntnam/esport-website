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
        $config = \Config::get('settings.mc_campaigns');
        $type = $this->argument('type');

        if (!isset($config[$type]))
            return;
        $settings = $config[$type];
        if (!$this->_mc_schedule_constrain($type, $settings))
            return;

        switch ($type) {
            case 'fixtures':
                $mailer = new FixtureMailer($settings);
                $mailer->run();
                break;
        }
    }

    /**
     * @param $type
     * @param $settings
     *
     * @return boolean
     */
    private function _mc_schedule_constrain($type, $settings)
    {
        $latest = MailCampaignRepository::getLatestByType($type);
        $every = $settings['by']['every'];
        $on = $settings['by']['on'];
        $last_run = $latest->getAttribute('created_at');
        $today = Carbon::tomorrow('UTC')->subSecond(1); // at 23:59:59

        switch ($settings['by']['unit']) {
            case 'day':
                return $last_run->diffInDays($today) >= $every;
                break;
            case 'week':
                break;
            case 'month':
                break;
            case 'year':
                break;
        }
        return true;
    }
}
