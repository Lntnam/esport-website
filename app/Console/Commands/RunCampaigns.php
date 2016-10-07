<?php

namespace App\Console\Commands;

use App\Repositories;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Database\Eloquent\Collection;
use Log;
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
        if (is_array($type))
            $type = implode(',', $type);

        if (!isset($config[$type])) {
            Log::warning(sprintf('MailChimp Campaign - [%s] type not found. Quitting.', $type));
            echo sprintf("\033[31m [%s] type not found. Skipping.\033[0m\n", $type);

            return;
        }

        $settings = $config[$type];
        if ($this->validateCampaignSchedule($type, $settings)) {
            switch ($type) {
                case 'fixtures':
                    $this->runFixtures($settings);

                    return;
            }
        }
        Log::info(sprintf('MailChimp Campaign - [%s] Schedule constraint not met. Skipping.', $type));
        echo sprintf("\033[30m [%s] Schedule constraint not met. Skipping.\033[0m\n", $type);
    }

    /**
     * @param $settings
     *
     * @return mixed
     */
    protected function runFixtures($settings)
    {
        /** @var Collection $data */
        $data = $this->getFixtures();
        if ($data->count() > 0) {
            foreach ($settings['campaign_id'] as $locale => $id) {
                $this->sendFixtureByLocale($locale, $id, $data);
            }

            return;
        }
        Log::info(sprintf('MailChimp Campaign - [fixtures] No matches to send. Skipping.'));
        echo sprintf("\033[30m [fixtures] No matches to send. Skipping.\033[0m\n");
    }

    protected function sendFixtureByLocale($locale, $id, $data)
    {
        Log::info(sprintf('MailChimp Campaign - [fixtures] Attempting to send in [%s] campaign [%s].', $locale, $id));
        echo sprintf("\033[30m [fixtures] [fixtures] Attempting to send in [%s] campaign [%s].\033[0m\n", $locale, $id);
        // Replicate campaign
        $replicate_result = MailChimp::post(sprintf('campaigns/%s/actions/replicate', $id));
        if ($this->hasError($replicate_result)) {
            Repositories\MailCampaignRepository::writeSimpleLog('[fixtures] Error replicating campaign: ' .
                $replicate_result['title']);

            return;
        }

        // Change campaign title
        $title = $replicate_result['settings']['title'];
        $title = substr($title, 0, strlen($title) - 10) . ' #' . Carbon::today(config('settings.default_timezone'))
                                                                       ->format('Ymj');

        $replicate_result['settings']['title'] = $title;
        $edit_result = MailChimp::patch(sprintf('campaigns/%s', $replicate_result['id']), $replicate_result);
        if ($this->hasError($edit_result)) {
            Repositories\MailCampaignRepository::writeSimpleLog('[fixtures] Error changing campaign title: ' .
                $edit_result['title']);

            return;
        }

        // Set content
        $html = view(sprintf('campaigns.%s.fixtures', $locale))
            ->with('matches', $data)
            ->render();

        $content_result = MailChimp::put(sprintf('campaigns/%s/content', $replicate_result['id']), ['html' => $html]);
        if ($this->hasError($content_result)) {
            Log::error(sprintf('MailChimp Campaign - [fixtures] Error setting campaign content: %s', $content_result['detail']));
            echo sprintf("\033[31m [fixtures] Error setting campaign content: %s\033[0m\n", $content_result['detail']);

            return;
        }

        // Store to campaign log
        $log = Repositories\MailCampaignRepository::create(['type' => 'fixtures', 'title' => $title]);

        // Send & update campaign log
        $send_result = MailChimp::post(sprintf('campaigns/%s/actions/send', $replicate_result['id']));
        if ($this->hasError($send_result)) { // ERROR!
            $log->setAttribute('success', false);
            $log->setAttribute('problem', $send_result['title']);
            $log->setAttribute('message', $send_result['detail']);

            Log::error(sprintf('MailChimp Campaign - [fixtures] Error sending campaign: %s', $send_result['detail']));
            echo sprintf("\033[31m [fixtures] [fixtures] Error sending campaign: %s\033[0m\n", $send_result['detail']);
        }
        else {
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

            return $this->validateRepeatPattern($last_run, $settings);
        }
        Setting::set('fixtures_send_today', 0);

        return true;
    }

    private function validateRepeatPattern($last_run, $settings)
    {
        $today = Carbon::tomorrow(config('app.timezone'))
                       ->subSecond(1); // at 23:59:59 because Carbon diff functions do round down
        $unit = $settings['by']['unit'];
        $interval = $settings['by']['every'];
        $checkValue = $settings['by']['check'];

        switch ($unit) {
            case 'day':
                return $last_run->diffInDays($today) >= $interval;
            case 'week':
                return $last_run->diffInWeeks($today) >= $interval && $today->format('N') == $checkValue;
            case 'month':
                return $last_run->diffInMonths($today) >= $interval && $today->format('j') == $checkValue;
            case 'year':
                return $last_run->diffInYears($today) >= $interval && $today->format('j n') == $checkValue;
        }

        return false;
    }

    private function hasError($result)
    {
        return !empty($result) && isset($result['type']) && isset($result['detail']);
    }

    /**
     * @return boolean
     */
    private function getFixtures()
    {
        // Only send fixtures update if there's any match for the next 3 days
        $today = Carbon::tomorrow(config('app.timezone'))
                       ->subSecond(1); // at 23:59:59 because Carbon diff functions do round down
        return Repositories\MatchRepository::getUpcomingMatchesInRange($today->addDays(3));
    }
}
