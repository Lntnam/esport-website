<?php


namespace App\Facades;


use Illuminate\Support\Facades\Facade;

class ContentBlock extends Facade
{
    public static function getFacadeAccessor()
    {
        return 'App\ContentBlock';
    }
}