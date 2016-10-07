<?php


namespace App\Traits;

use ReCaptcha\ReCaptcha;

trait CaptchaTrait
{
    public function captchaCheck()
    {
        $response = request('g-recaptcha-response');
        $remoteip = $_SERVER['REMOTE_ADDR'];
        $secret   = config('services.recaptcha')['secret'];

        $recaptcha = new ReCaptcha($secret);
        $resp = $recaptcha->verify($response, $remoteip);

        return $resp->isSuccess();
    }
}