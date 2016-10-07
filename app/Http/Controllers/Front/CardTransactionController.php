<?php

namespace App\Http\Controllers\Front;

use App\Repositories\CardTransactionRepository;
use App\Traits\CaptchaTrait;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller as BaseController;
use App\Http\Requests;
use lntn\Epay\EpayClient;
use lntn\Epay\Exceptions\EpayException;
use lntn\Epay\Responses\ChargingResponse;
use Validator;

class CardTransactionController extends BaseController
{
    use CaptchaTrait;

    public function donateDotA2(Request $request)
    {
        $input = $request->all();
        $source = 'donate_DotA2';
        if ($request->has('source') && $input['source'] == $source) {

            $validator = Validator::make($input, CardTransactionRepository::getCreateValidationRules());
            if (!$validator->fails()) {

                if ($this->captchaCheck() == false) {
                    return redirect()
                        ->back()
                        ->with('status', 'error')
                        ->with('message', 'Wrong Captcha')
                        ->withInput();
                }

                /** @var EpayClient $client */
                $config = config('services.epay');
                $client = new EpayClient($config['username'], $config['partnerid'], $config['partnercode'], $config['mpin'], [
                    'WS_URL'          => $config['ws_url'],
                    'EPAY_PUBLIC_KEY' => $config['epay_public_key'],
                    'PRIVATE_KEY'     => $config['private_key'],
                ]);


                try {
                    $client->login($config['password']);
                } catch (EpayException $ex) {
                    return redirect()
                        ->back()
                        ->with('status', 'error')
                        ->with('message', sprintf('Service login error: [%s] %s', $ex->getCode(), $ex->getMessage()))
                        ->withInput();
                }

                $transactionID = date('Ymdhis');
                $target = $source;

                /** @var ChargingResponse $response */
                try {
                    $response = $client->chargeCard($transactionID, $target, $input['serial'], $input['pin'], $input['provider']);
                } catch (Exception $ex) {
                    return redirect()
                        ->back()
                        ->with('status', 'error')
                        ->with('message', sprintf('Charging card error: [%s] %s', $ex->getCode(), $ex->getMessage()))
                        ->withInput();
                }

                $client->logout();

                /* Add transaction */
                CardTransactionRepository::create([
                    'source'   => $source,
                    'name'     => $input['name'],
                    'provider' => $input['provider'],
                    'pin'      => $input['pin'],
                    'serial'   => $input['serial'],
                    'amount'   => $response->getResponseAmount(),
                    'ip'       => $request->ip(),
                ]);

                return redirect()
                    ->route('dota2.card_donation')
                    ->with('status', 'success')
                    ->with('message', trans('success.donated'));
            }

            return view('payment.epay_card_form', [
                'source'    => $source,
                'providers' => EpayClient::getProviders(),
                'errors'    => $validator->errors(),
            ]);
        }

        return view('payment.epay_card_form', [
            'source'    => $source,
            'providers' => EpayClient::getProviders(),
        ]);
    }
}
