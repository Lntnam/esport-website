<?php

namespace App\Http;

use Illuminate\Auth;
use Illuminate\Foundation\Http;
use Illuminate\Cookie;
use Illuminate\Routing;
use Illuminate\Session;
use Illuminate\View;
use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel
{
    /**
     * The application's global HTTP middleware stack.
     *
     * These middleware are run during every request to your application.
     *
     * @var array
     */
    protected $middleware = [
        Http\Middleware\CheckForMaintenanceMode::class,
    ];

    /**
     * The application's route middleware groups.
     *
     * @var array
     */
    protected $middlewareGroups = [
        'web' => [
            Middleware\EncryptCookies::class,
            Cookie\Middleware\AddQueuedCookiesToResponse::class,
            Session\Middleware\StartSession::class,
            View\Middleware\ShareErrorsFromSession::class,
            Middleware\VerifyCsrfToken::class,
            Routing\Middleware\SubstituteBindings::class,
        ],

        'back' => [
            'auth:web',
        ],

        'front' => [
            Middleware\App::class,
        ],

        'api' => [
            'throttle:60,1',
            'bindings',
        ],
    ];

    /**
     * The application's route middleware.
     *
     * These middleware may be assigned to groups or used individually.
     *
     * @var array
     */
    protected $routeMiddleware = [
        'auth' => Auth\Middleware\Authenticate::class,
        'auth.basic' => Auth\Middleware\AuthenticateWithBasicAuth::class,
        'bindings' => Routing\Middleware\SubstituteBindings::class,
        'can' => Auth\Middleware\Authorize::class,
        'guest' => Middleware\RedirectIfAuthenticated::class,
        'throttle' => Routing\Middleware\ThrottleRequests::class,
        'root' => Middleware\RootOnlyAccess::class,
    ];
}
