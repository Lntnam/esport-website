<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Auth;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\Request;
use Route;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that should not be reported.
     *
     * @var array
     */
    protected $dontReport = [Auth\AuthenticationException::class, Auth\Access\AuthorizationException::class, \Symfony\Component\HttpKernel\Exception\HttpException::class, \Illuminate\Database\Eloquent\ModelNotFoundException::class, \Illuminate\Session\TokenMismatchException::class, \Illuminate\Validation\ValidationException::class,];

    /**
     * Report or log an exception.
     *
     * This is a great spot to send exceptions to Sentry, Bugsnag, etc.
     *
     * @param  \Exception $exception
     * @return void
     */
    public function report(Exception $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Exception $exception
     * @return \Illuminate\Http\Response
     */
    public function render($request, Exception $exception)
    {
        return parent::render($request, $exception);
    }

    /**
     * Convert an authentication exception into an unauthenticated response.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Illuminate\Auth\AuthenticationException $exception
     * @return \Illuminate\Http\ResponseTrait
     */
    protected function unauthenticated(Request $request, Auth\AuthenticationException $exception)
    {
        if ($request->expectsJson()) {
            return response()->json(['error' => 'Unauthenticated.', 'message' => $exception->getMessage()], 401);
        }

        return redirect()
            ->guest(route('back.login'))
            ->with('status', 'error')
            ->with('message', trans('auth.please_login'));
    }
}
