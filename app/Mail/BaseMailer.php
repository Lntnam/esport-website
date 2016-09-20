<?php


namespace App\Mail;

use Illuminate\Mail\Mailable;

class BaseMailer extends Mailable
{
    protected $actionUrl = '';

    protected $actionText = '';

    public function __construct()
    {
        $this->constructTest();
    }

    public function build()
    {
        return $this->with(['hasAction'  => !empty($this->actionUrl),
                            'actionUrl'  => $this->actionUrl,
                            'actionText' => $this->actionText,
                           ]);
    }

    protected function constructTest()
    {

    }
}
