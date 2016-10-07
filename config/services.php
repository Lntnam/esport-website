<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Stripe, Mailgun, SparkPost and others. This file provides a sane
    | default location for this type of information, allowing packages
    | to have a conventional place to find your various credentials.
    |
    */

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
    ],

    'ses' => [
        'key'    => env('SES_KEY'),
        'secret' => env('SES_SECRET'),
        'region' => 'us-east-1',
    ],

    'sparkpost' => [
        'secret' => env('SPARKPOST_SECRET'),
    ],

    'stripe' => [
        'model'  => App\User::class,
        'key'    => env('STRIPE_KEY'),
        'secret' => env('STRIPE_SECRET'),
    ],

    'google' => [
        'client_id'     => env('GOOGLE_ID'),
        'client_secret' => env('GOOGLE_SECRET'),
        'redirect'      => env('GOOGLE_REDIRECT'),
    ],

    'mailchimp' => [
        'api_key'          => env('MAILCHIMP_KEY'),
        'list_id'          => env('MAILCHIPM_LIST_ID'),
        'language_mapping' => ['vi' => 'vi_VN', 'en' => 'en_US', 'vi_VN' => 'vi', 'en_US' => 'en'],
    ],

    'megabank' => [
        'ws_url'       => 'http://103.23.146.165:8015/Service.asmx?wsdl',                               //link gọi webservice
        'merchantid'   => 'TA123',                                                                //Merchant Code
        'IssuerID'     => '18800110',                                                               //Mã bắt buộc, hệ thống yêu cầu phải có mã này để xác thực
        'send_key'     => 'reesatersuusrtiy12312kty',                                               //Mã hash key gửi lên hệ thống
        'received_key' => 'k43423553535gsgrthkladgt'                                             //Mã để check dữ liệu từ hệ thống trả về
    ],

    'epay' => [
        'ws_url'          => env('LNTN_EPAY_WS_URL'),
        'ws_uri'          => env('LNTN_EPAY_WS_URI'),
        'partnerid'       => env('LNTN_EPAY_PARTNERID'),
        'partnercode'     => env('LNTN_EPAY_PARTNERCODE'),
        'mpin'            => env('LNTN_EPAY_MPIN'),
        'username'        => env('LNTN_EPAY_USERNAME'),
        'password'        => env('LNTN_EPAY_PASSWORD'),
        'epay_public_key' => storage_path('app/epay_public_key.pem'),
        'private_key'     => storage_path('app/private_key.pem'),
    ],

    'recaptcha' => [
        'site_key' => env('RE_CAP_SITE'),
        'secret'   => env('RE_CAP_SECRET'),
    ],
];
