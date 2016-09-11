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

class SiteSettingRepository extends BaseRepository {

    static $modelClassName = SiteSetting::class;

    static function getCreateValidationRules()
    {
        return [];
    }

    static function getUpdateValidationRules(Model $model)
    {
         return [];
    }

    static function create(array $attributes)
    {
    }

    static function all($columns = ['*'])
    {
        return SiteSetting::orderBy('order')
            ->get();
    }

    public static function save(array $settings)
    {
        $data = array();
        foreach ($settings as $key => $value) {
            $setting = SiteSetting::find($key);
            if ($setting && $setting->getAttribute('visible')) {
                $setting->setAttribute('value', $value);
                $setting->save();
                $data[] = $setting;
            }
        }
        return $data;
    }

    static function read($key)
    {
        $setting = SiteSetting::withoutGlobalScope('visibility')->find($key);
        if (!empty($setting)) return $setting->getAttribute('value');

        return null;
    }
}