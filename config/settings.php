<?php
/**
 * Created by PhpStorm.
 * User: Nam
 * Date: 01/09/2016
 * Time: 20:34
 */
return [
    'root_admin'            => 'j251282@gmail.com',
    'back-name'             => 'NG Staff Portal',

    /*
     * Front-end view options
     */
    'past-matches-count'    => 20,

    /*
     * Path settings
     */

    'image-opponent'        => 'storage/opponents/',
    'image-tournament'      => 'storage/tournaments/',
    'vendor_dir'            => 'vendor',

    /*
     * For date and time display
     */

    'default_timezone'      => 'Asia/Bangkok',
    'default_timezone_value'=> 'GMT +7',
    'match-localized'       => '%a, %e/%m/%Y %H:%M',
    'match-date-localized'  => '%a, %e/%m/%Y',
    'match-time-localized'  => '%H:%M',

    'match-date-format'     => 'D, j/m/Y',
    'match-time-format'     => 'H:i',
    'match-picker-format'   => 'ddd, D MMM YYYY H:mm',

    /*
     * Localization
     */
    'locales'     => [
        'vi_VN' => ['title'=>'Vie', 'geo'=>'VN', 'icon'=>'vn'],
        'en_US' => ['title'=>'Eng', 'geo'=>'US', 'icon'=>'gb'],
    ],

    /*
     * Email campaigns
     */
    'mc_campaigns' => [
        'fixtures' => [
            'enabled' => true,
            'campaign_id' => '21263', // saved campaign to replicate
            'template_id' => '8279', // saved template to generate HTML content
            'blocks' => [ // defined in the template in *|mc:edit="key"|* format
                'preview' => 'fixtures.preview',
                'content' => 'fixtures.content',
                'change' => 'general.change_preferences',
            ],
            'by' => [
                'unit' => 'day',
                'every' => 3,
                'on' => null, // week: N | month: j | year: jn
            ],
            'time'       => '23:00', // H:i
        ],
        'results' => [
            'enabled' => false,
            'campaign_id' => '', // saved campaign to replicate
            'template_id' => '', // saved template to generate HTML content
            'blocks' => [ // defined in the template in *|mc:edit="key"|* format
                'preview' => 'results.preview',
                'content' => 'results.content',
                'change' => 'general.change_preferences',
            ],
            'segment_id' => '', // saved segment to receive emails
            'by' => [
                'unit' => 'day',
                'every' => 3,
                'on' => null, // week: N | month: j | year: jn
            ],
            'time'       => '', // H:i
        ],
    ],

    /*
     * Third party packages
     */

    'mailchimp' => [
        'api_key'               => env('MAILCHIMP_KEY'),
        'list-id'               => env('MAILCHIPM_LIST_ID'),
    ],
];