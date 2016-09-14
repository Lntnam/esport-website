<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Config;

class SubscriberSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Pull subscribers from Mailchimp account
        $mailchimp = new \DrewM\MailChimp\MailChimp(config('settings.mailchimp-api-key'));
        $uri = sprintf("lists/%s/members", config('settings.mailchimp-list-id'));
        $result = $mailchimp->get($uri);
        if (empty($result) || empty($result['members'])) return;

        DB::table('subscribers')->delete();

        foreach ($result['members'] as $member) {
            \App\Models\Subscriber::create(array(
                'name'          => $member['merge_fields']['FNAME'],
                'email'         => $member['email_address'],
                'interests'     => json_encode($member['interests']),
                'mailchimp_id'  => $member['id'],
                'ip'            => $member['ip_opt'],
                'created_at'    => (new \Carbon\Carbon($member['timestamp_opt']))->toDateTimeString(),
                'updated_at'    => (new \Carbon\Carbon($member['timestamp_opt']))->toDateTimeString(),
                'deleted_at'    => $member['status'] == 'subscribed' ? null : (new \Carbon\Carbon())->toDateTimeString(),
            ));
        }
    }
}
