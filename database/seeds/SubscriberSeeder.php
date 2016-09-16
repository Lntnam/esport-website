<?php

use App\Models\Subscriber;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use App\Facades\MailChimp;

class SubscriberSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Pull subscribers from MailChimp account
        $members = MailChimp::getMembers();
        if ($members === false) {
            \Log::error('Unable to get members list: ' . MailChimp::getError()['detail']);
            return;
        }

        DB::table('subscribers')->delete();

        $languages = array_merge(config('services.mailchimp')['language_mapping'], [null => config('app.locale'), '' => config('app.locale')]);

        foreach ($members as $member) {
            Subscriber::create(array(
                'mail_chimp_id' => $member['unique_email_id'],
                'name'          => $member['merge_fields']['FNAME'],
                'email'         => $member['email_address'],
                'status'        => $member['status'],
                'language'      => $languages[$member['language']],
                'interests'     => json_encode($member['interests']),
                'ip_signup'     => $member['ip_signup'],
                'ip_opt'        => $member['ip_opt'],
                'created_at'    => (new Carbon($member['timestamp_opt'] ?: $member['timestamp_signup']))->toDateTimeString(),
                'updated_at'    => (new Carbon($member['last_changed'] ?: $member['timestamp_signup']))->toDateTimeString(),
            ));
        }
    }
}
