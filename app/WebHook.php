<?php
namespace App;

use App\Models\Subscriber;
use Log;
use App\Facades\MailChimp as MC;

class WebHook
{
    public static function receiveMailChimp()
    {
        $type = request('type', null);

        if (!empty($type)) {
            Log::info('MailChimp web hook triggered. Type [' . $type . ']');
            $data = request('data');
//            Log::debug('data: ' . json_encode($data));
            switch ($type) {
                case 'unsubscribe':
                    static::_changeSubscriptionStatus($data, 'unsubscribed');

                    return;
                case 'subscribe':
                    static::_changeSubscriptionStatus($data, 'subscribed');

                    return;
                case 'profile':
                    static::_changeMergeInfo($data);

                    return;
                default:
                    return;
            }
        }

        Log::info('MailChimp web hook triggered. Type missing.');
    }

    private static function _changeSubscriptionStatus($data, $status)
    {
        $subscriber = Subscriber::where('mail_chimp_id', $data['id'])
                                ->first();
        if ($subscriber) {
            $subscriber->setAttribute('status', $status);
            $subscriber->save();
        }

        Log::info(sprintf('Subscriber status updated. ID [%s] Email [%s]', $data['id'], $data['email']));
    }

    private static function _changeMergeInfo($data)
    {
        $subscriber = Subscriber::where('mail_chimp_id', $data['id'])
                                ->first();
        if ($subscriber) {
            /* bind interests */
            $member = MC::getSingleMember($data['merges']['EMAIL']);
            if ($member === false) {
                Log::error('Unable to get member: ' . MC::getError()['detail']);

                return;
            }

            $languages = array_merge(config('services.mailchimp')['language_mapping'], [null => config('app.locale'), '' => config('app.locale')]);

            $subscriber->setAttribute('email', $member['email_address']);
            $subscriber->setAttribute('name', $member['merge_fields']['FNAME']);
            $subscriber->setAttribute('language', $languages[$member['language']]);
            $subscriber->setAttribute('interests', json_encode($member['interests']));

            $subscriber->save();
        }

        Log::info(sprintf('Subscriber profile updated. ID [%s] Email [%s]', $data['id'], $data['email']));
    }
}
