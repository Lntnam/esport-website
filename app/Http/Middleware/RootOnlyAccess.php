<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Support\Facades\Auth;

class RootOnlyAccess
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure                 $next
     *
     * @throws AuthorizationException
     *
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (empty(Auth::user()) || !session('root')) {
            abort(404);
        }

        return $next($request);
    }
}
