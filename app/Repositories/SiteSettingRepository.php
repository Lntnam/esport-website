<?php
/**
 * Created by PhpStorm.
 * User: Nam
 * Date: 02/09/2016
 * Time: 23:20
 */
namespace App\Repositories;

use App\Models\SiteSetting;
use Illuminate\Database\Eloquent\Model;

class SiteSettingRepository extends BaseRepository
{

    protected static $modelClassName = SiteSetting::class;

    public static function all($columns = ['*'])
    {
        return SiteSetting::orderBy('order')
            ->get();
    }

    public static function save(array $settings)
    {
        $data = [];
        foreach ($settings as $key => $value) {
            $setting = SiteSetting::withoutGlobalScope('visibility')
                ->find($key);
            if ($setting) {
                $setting->setAttribute('value', $value);
                $setting->save();
                $data[] = $setting;
            }
        }

        return $data;
    }

    public static function read($key = null)
    {
        if (!empty($key)) {
            $setting = SiteSetting::withoutGlobalScope('visibility')
                ->find($key);
            if (!empty($setting))
                return $setting->getAttribute('value');
        }
        else {
            return SiteSetting::withoutGlobalScope('visibility')
                ->get();
        }

        return null;
    }
}
