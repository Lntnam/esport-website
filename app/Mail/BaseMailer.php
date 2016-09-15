<?php


namespace App\Mail;

use Illuminate\Mail\Mailable;
use URL;

class BaseMailer extends Mailable
{
    protected $unsubscriptionKey = '';

    protected $actionUrl = '';

    protected $actionText = '';

    public function build()
    {

    }

    public function buildDefault(Mailable $mail)
    {
        return $mail->with(['hasAction'      => !empty($this->actionUrl),
                            'unsubscribeUrl' => URL::route('front.subscription.unsubscribe', ['key' => $this->unsubscriptionKey]),
                           ]);
    }
}
