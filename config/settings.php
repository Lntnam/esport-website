<?php
/**
 * Created by PhpStorm.
 * User: Nam
 * Date: 01/09/2016
 * Time: 20:34.
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

    'default_timezone'       => 'Asia/Bangkok',
    'default_timezone_value' => 'GMT +7',
    'match-localized'        => '%a, %e/%m/%Y %H:%M',
    'match-date-localized'   => '%a, %e/%m/%Y',
    'match-time-localized'   => '%H:%M',

    'match-date-format'     => 'D, j/m/Y',
    'match-time-format'     => 'H:i',
    'match-picker-format'   => 'ddd, D MMM YYYY H:mm',

    /*
     * Localization
     */
    'locales'     => [
        'vi_VN' => ['title' => 'Vie', 'geo' => 'VN', 'icon' => 'vn'],
        'en_US' => ['title' => 'Eng', 'geo' => 'US', 'icon' => 'gb'],
    ],

    /*
     * Third party packages
     */

    'mailchimp-api-key'     => 'eb11873cc5d478f8501ea6152b549e79-us14',
    'mailchimp-list-id'     => 'f848ac684f',
];
