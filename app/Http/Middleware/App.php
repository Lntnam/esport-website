<?php

namespace App\Http\Middleware;

use App as Application;
use Closure;
use GeoIP;

class App
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     *
     * @throws AuthorizationException
     */
    public function handle($request, Closure $next)
    {
        $locale = $request->cookie('locale');
//        $timezone = $request->session()->get('timezone');

        if (empty($locale)) {
            // check ip geo-location
            // check from CloudFlare first
            $location = $request->header('HTTP_CF_IPCOUNTRY');
            if (empty($location)) {
                $ip = null;

                if (!empty($request->header('HTTP_CF-Connecting-IP'))) $ip = $request->header('HTTP_CF-Connecting-IP');
                elseif (isset($_SERVER['REMOTE_ADDR'])) $ip = $_SERVER['REMOTE_ADDR'];

                $location = GeoIP::getLocation($ip);
            }

            // also add timezone if hasn't
//            if (empty($timezone)) {
//                $timezone = $location['timezone'];
//                $request->session()->put('timezone', $timezone);
//            }
            foreach (config('settings.locales') as $l => $d) {
                if ($d['geo'] == $location['isoCode']) {
                    $locale = $l;
                    break;
                }
            }
        }

        if (!empty($locale)) {
            Application::setLocale($locale);
            setlocale(LC_TIME, $locale);
        }

//        if (empty($timezone)) {
//            $location = GeoIPFacade::getLocation();
//            $timezone = $location['timezone'];
//            $request->session()->put('timezone', $timezone);
//        }

        return $next($request);
    }
}
