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
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        // get settings
        $config = config('settings.mc_campaigns');
        $type = $this->argument('type');
        if (is_array($type)) $type = implode(',', $type);

        if (!isset($config[$type])) {
            Repositories\MailCampaignRepository::writeSimpleLog(sprintf('[%s] Schedule constraint not met. Skipping.', $type));

            return;
        }

        $settings = $config[$type];
        if ($this->validateCampaignSchedule($type, $settings)) {
            switch ($type) {
                case 'fixtures':
                    $this->runFixtures($settings);
                    break;
            }

            return;
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

            $this->sendFixtureByLocale($locale, $id, $data);
        }
    }

    protected function sendFixtureByLocale($locale, $id, $data)
    {
        // Replicate campaign
        $replicate_result = MailChimp::post(sprintf('campaigns/%s/actions/replicate', $id));
        if (!empty($replicate_result) && empty($replicate_result['id'])) {
            Repositories\MailCampaignRepository::writeSimpleLog('[fixtures] Error replicating campaign: ' . $replicate_result['title']);

            return;
        }

        // Change campaign title
        $title = $replicate_result['settings']['title'];
        $title = substr($title, 0, strlen($title) - 10) . ' #' . Carbon::today(config('settings.default_timezone'))
                                                                       ->format('Ymj');

        $replicate_result['settings']['title'] = $title;
        $edit_result = MailChimp::patch(sprintf('campaigns/%s', $replicate_result['id']), $replicate_result);
        if (!empty($edit_result) && empty($edit_result['id'])) {
            Repositories\MailCampaignRepository::writeSimpleLog('[fixtures] Error changing campaign title: ' . $edit_result['title']);

            return;
        }

        // Set content
        $html = view(sprintf('campaigns.%s.fixtures', $locale))
            ->with('matches', $data)
            ->render();

        $content_result = MailChimp::put(sprintf('campaigns/%s/content', $edit_result['id']), ['html' => $html]);
        if (!empty($content_result) && !empty($content_result['type'])) {
            Repositories\MailCampaignRepository::writeSimpleLog('[fixtures] Error setting campaign content: ' . $content_result['title']);

            return;
        }
dump($content_result);
        // Store to campaign log
        $log = Repositories\MailCampaignRepository::create(['type' => 'fixtures', 'title' => $title]);

        // Send & update campaign log
        $send_result = MailChimp::post(sprintf('campaigns/%s/actions/send', $content_result['id']));
        if (!empty($send_result) && !empty($send_result['type'])) { // ERROR!
            $log->setAttribute('success', false);
            $log->setAttribute('problem', $send_result['title']);
            $log->setAttribute('message', $send_result['detail']);

            return;
        } else {
            $log->setAttribute('success', true);
        }
        $log->save();
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
        if (!$send_today) {
            $last_run = Carbon::minValue();
            $latest = Repositories\MailCampaignRepository::getLatestByType($type);
            if (!empty($latest)) {
                $last_run = $latest->getAttribute('created_at');
            }

            $every = $settings['by']['every'];
            $check = $settings['by']['check'];
            $today = Carbon::tomorrow(config('app.timezone'))
                           ->subSecond(1); // at 23:59:59 because Carbon diff functions do round down

            switch ($settings['by']['unit']) {
                case 'day':
                    return $last_run->diffInDays($today) >= $every;
                case 'week':
                    return $last_run->diffInWeeks($today) >= $every && $today->format('N') == $check;
                case 'month':
                    return $last_run->diffInMonths($today) >= $every && $today->format('j') == $check;
                case 'year':
                    return $last_run->diffInYears($today) >= $every && $today->format('j n') == $check;
            }
        }
        Setting::set('fixtures_send_today', 0);

        return true;
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
