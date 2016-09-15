<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;

class SubscriptionConfirmation extends BaseMailer
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    public function __construct($mailChimpId)
    {
        $this->unsubscriptionKey = $mailChimpId;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        /** unsubscription key is the mail chimp id */

        $mail = $this->view('emails.subscription_confirmation')
             ->text('email_plains.subscription_confirmation');

        return $this->buildDefault($mail);
    }
}
