<?php
/**
 * Created by PhpStorm.
 * User: Nam
 * Date: 03/09/2016
 * Time: 00:12
 */
namespace App\Http\Controllers\Back;

use App\Repositories\SiteSettingRepository;
use App\Http\Controllers\Controller as BaseController;
use Illuminate\Http\Request;

class SettingController extends BaseController
{
    public function getSiteSettings()
    {
        $settings = SiteSettingRepository::all();

        return view('back.site_settings')->with('settings', $settings);
    }

    public function postSiteSettings(Request $request)
    {
        $inputs = $request->all();
        $settings = [];
        foreach ($inputs as $name => $value) {
            if (substr($name, 0, 8) == 'setting-') {
                $name = substr($name, 8);
                $settings[$name] = $value;
            }
        }

        $settings = SiteSettingRepository::save($settings);

        $request->session()
                ->flash('status', 'success');
        $request->session()
                ->flash('message', trans('success.site_setting_updated'));

        return view('back.site_settings')->with('settings', $settings);
    }
}
