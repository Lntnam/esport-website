<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use URL;

class SubscriptionConfirmation extends BaseMailer
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    public function __construct()
    {
        $this->actionUrl = URL::route('front.fixture.index');
        $this->actionText = trans('contents.btn-call-fixtures');

        parent::__construct();
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $this->subject(trans('texts.subscription_confirmation_subject'))
            ->view('emails.subscription_confirmation');

        return parent::build();
    }
}
