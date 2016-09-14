<?php
namespace App\Models;

use Carbon\Carbon;

trait AppModel
{
    protected function convertToUserTimezone($value)
    {
        if (empty($value)) return null;

        return (string)(new Carbon($value, config('app.timezone')))->tz(config('settings.default_timezone'));
    }
}
