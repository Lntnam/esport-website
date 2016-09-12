<?php
/**
 * Created by PhpStorm.
 * User: Nam
 * Date: 07/09/2016
 * Time: 22:04
 */

namespace App\Facades;


use Illuminate\Support\Facades\Facade;

class MailChimp extends Facade
{
    protected static function getFacadeAccessor() { return 'DrewM\MailChimp\MailChimp'; }
}