<?php


namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller as BaseController;
use App\Mail\SubscriptionConfirmation;
use App\Repositories\InterestRepository;
use App\Repositories\SubscriberRepository;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Http\Request;
use Mail;
use MailChimp;
use Validator;

class SubscriptionController extends BaseController
{
    public function create(Request $request)
    {
        /* verify if human */
        if (!empty($request->input('b_59a9a5aee257480d4f3cbe81e_f848ac684f'))) {
            abort(403);
        }

        $interests = InterestRepository::getList();

        /* validation */
        $attributes = $request->input();

        if (!is_array($attributes['interests'])) {
            $attributes['interests'] = [$attributes['interest'] => true];
        }

        foreach ($attributes['interests'] as $key => $value) {
            $attributes['interests'][$key] = ($value == '1' || $value == true);
        }

        /* bind interest list */
        $list = array_fill_keys(array_keys($interests), false);
        $list = array_replace($list, $attributes['interests']);
        $attributes['interests'] = $list;

        $validator = Validator::make($attributes, SubscriberRepository::getCreateValidationRules());
        if (!$validator->fails()) {
            /* create subscriber locally */
            $model = SubscriberRepository::create($attributes);

            /* send to mailchimp */
            $member = MailChimp::createMember($model->getAttributes());
            if ($member !== false) {
                /* update subscriber locally */
                $repo = new SubscriberRepository($model);
                $repo->updateMailChimpId($member['unique_email_id']);

                /* send confirmation email */
                try {
                    Mail::to($model->getAttribute('email'))
                        ->send(new SubscriptionConfirmation());
                } catch (RequestException $e) {
                    \Log::error('Unable to send email: ' . $e->getMessage());
                }

                return redirect()
                    ->route('front.subscription.confirmation')
                    ->with('success', true);
            }

            \Log::error('Unable to send member to MailChimp: ' . MailChimp::getError()['detail']);

            return redirect()
                ->route('front.subscription.confirmation')
                ->with('success', false);
        }

        return view('subscription.subscribe')
            ->with('model', $attributes)
            ->with('errors', $validator->errors())
            ->with('interests', $interests);
    }

}
