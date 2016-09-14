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
     * Back-end view options
     */
    'table_page_size'       => 15,
    'table_page_list'       => '[15,30,45,60,100]',

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

    /** For using with Carbon -> localization */
    'match-localized'       => '%a, %d/%m/%Y %H:%M',
    'match-date-localized'  => '%a, %d/%m/%Y',
    'match-time-localized'  => '%H:%M',

    'match-format'          => 'Y-m-d H:i', // for binding data to datepicker
    'match-picker-format'   => 'YYYY-MM-DD HH:mm', // for moment.js

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
            'campaign_id' => [
                'en_US' => '1ce3d317ef',
                'vi_VN' => '6cfc74b5d6',
            ], // saved campaigns to replicate
            'by' => [
                'unit' => 'day',
                'every' => 3,
                'on' => null, // week: N | month: j | year: j n
            ],
            'time' => '23:00', // H:i, default timezone
        ],
        'results' => [
            'enabled' => false,
            'campaign_id' => [
                'en_US' => '',
                'vi_VN' => '',
            ], // saved campaigns to replicate
            'by' => [
                'unit' => 'week',
                'every' => 1,
                'on' => 1, // week: N | month: j | year: j n
            ],
            'time' => '08:00', // H:i, default timezone
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
