<?php

namespace App\Console\Commands;

use App\Repositories;
use Carbon\Carbon;
use Illuminate\Console\Command;
use MailChimp;
use Setting;

/**
 * Trigger predefined MailChimp campaigns to start sending email
 *
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
                        $this->runFixtures($settings);
                        break;
                }
            } else {
                Repositories\MailCampaignRepository::writeSimpleLog(sprintf('[%s] Schedule constraint not met. Skipping.', $type));
            }
        }
    }

    /**
     * @param $settings
     *
     * @return mixed
     */
    protected function runFixtures($settings)
    {
        $data = $this->validateFixtureCampaignData();
        if (empty($data)) {
            Repositories\MailCampaignRepository::writeSimpleLog('[fixtures] No matches to send. Skipping.');

            return;
        }

        foreach ($settings['campaign_id'] as $locale => $id) {
            /** @var $locale string */
            /** @var $id string */
            $html = view(sprintf('campaigns.%s.fixtures', $locale))
                ->with('matches', $data)
                ->render();

            // Replicate campaign
            $campaign = MailChimp::post(sprintf('campaigns/%s/actions/replicate', $id));
            if (!empty($campaign) && empty($campaign['id'])) {
                Repositories\MailCampaignRepository::writeSimpleLog('[fixtures] Error replicating campaign: ' . $campaign['title']);

                return;
            }

            // Change campaign title
            $title = $campaign['settings']['title'];
            $title = substr($title, 0, strlen($title) - 10) . ' #' . Carbon::today(config('settings.default_timezone'))
                                                                           ->format('Ymj');

            $campaign['settings']['title'] = $title;
            $campaign = MailChimp::patch(sprintf('campaigns/%s', $campaign['id']), $campaign);
            if (!empty($campaign) && empty($campaign['id'])) {
                Repositories\MailCampaignRepository::writeSimpleLog('[fixtures] Error changing campaign title: ' . $campaign['title']);

                return;
            }

            // Set content
            $response = MailChimp::put(sprintf('campaigns/%s/content', $campaign['id']), ['html' => $html]);
            if (!empty($response) && !empty($response['type'])) {
                Repositories\MailCampaignRepository::writeSimpleLog('[fixtures] Error setting campaign content: ' . $response['title']);

                return;
            }

            // Store to campaign log
            $log = Repositories\MailCampaignRepository::create(['type' => 'fixtures', 'title' => $title]);

            // Send & update campaign log
            $response = MailChimp::post(sprintf('campaigns/%s/actions/send', $campaign['id']));
            if (!empty($response) && !empty($response['type'])) { // ERROR!
                $log->setAttribute('success', false);
                $log->setAttribute('problem', $response['title']);
                $log->setAttribute('message', $response['detail']);
            } else {
                $log->setAttribute('success', true);
            }
            $log->save();
        }
    }

    /**
     * @param String $type
     * @param String $settings
     *
     * @return boolean
     */
    private function validateCampaignSchedule($type, $settings)
    {
        // Check override setting
        $send_today = Setting::get('fixtures_send_today');
        if ($send_today == 1) {
            Setting::set('fixtures_send_today', 0);

            return true;
        }

        $latest = Repositories\MailCampaignRepository::getLatestByType($type);
        if (!empty($latest)) $last_run = $latest->getAttribute('created_at'); else
            $last_run = Carbon::minValue();

        $every = $settings['by']['every'];
        $on = $settings['by']['on'];
        $today = Carbon::tomorrow(config('app.timezone'))
                       ->subSecond(1); // at 23:59:59 because Carbon diff functions do round down

        switch ($settings['by']['unit']) {
            case 'day':
                return $last_run->diffInDays($today) >= $every;
                break;
            case 'week':
                return $last_run->diffInWeeks($today) >= $every && $today->format('N') == $on;
                break;
            case 'month':
                $last_run->diffInMonths($today) >= $every && $today->format('j') == $on;
                break;
            case 'year':
                $last_run->diffInYears($today) >= $every && $today->format('j n') == $on;
                break;
        }

        return false;
    }

    /**
     * @return boolean
     */
    private function validateFixtureCampaignData()
    {
        // Only send fixtures update if there's any match for the next 3 days
        $today = Carbon::tomorrow(config('app.timezone'))
                       ->subSecond(1); // at 23:59:59 because Carbon diff functions do round down
        return Repositories\MatchRepository::getUpcomingMatchesInRange($today->addDays(3));
    }
}
