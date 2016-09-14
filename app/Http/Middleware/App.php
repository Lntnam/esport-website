<?php

namespace App\Http\Middleware;

use App as Application;
use Closure;
use GeoIP;
use Illuminate\Http\Request;
use Setting;

class App
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     *
     * @throws AuthorizationException
     */
    public function handle(Request $request, Closure $next)
    {
        $locale = $request->cookie('locale');

        if (empty($locale)) {
            // check ip geo-location
            // check from CloudFlare first
            $location = $request->header('HTTP_CF_IPCOUNTRY');
            if (empty($location)) {
                $ip = Setting::server('REMOTE_ADDR');

                if (!empty($request->header('HTTP_CF-Connecting-IP'))) {
                    $ip = $request->header('HTTP_CF-Connecting-IP');
                }

                $location = GeoIP::getLocation($ip);
            }

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

        return $next($request);
    }
}
