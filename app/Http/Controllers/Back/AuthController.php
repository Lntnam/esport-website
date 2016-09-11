<?php
/**
 * Created by PhpStorm.
 * User: Nam
 * Date: 02/09/2016
 * Time: 03:30
 */

namespace App\Http\Controllers\Back;

use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller as BaseController;

use Socialite;

class AuthController extends BaseController
{
    private $user;

    public function getLogout()
    {
        Auth::logout();

        return redirect()->route('back.login')
            ->with('status', 'success')
            ->with('message', trans('auth.logged_out'));

    }

    public function getSocialRedirect( $provider ) {
        $providerKey = \Config::get('services.' . $provider);
        if(empty($providerKey))
            return view('auth.login');

        return Socialite::driver( $provider )->redirect();
    }

    public function getSocialHandle( $provider ) {
        $socialUser = Socialite::driver( $provider )->user();

        $userCheck = UserRepository::matchWithSocial($socialUser, $provider);

        if(!empty($userCheck))
        {
            //Check if we can match an existing staff with social user
            $this->user = new UserRepository($userCheck);

            // update latest information from social network
            $this->user->updateFromSocial($socialUser, $provider);
        }
        else
        {
            // this social user is not authorized
            return redirect()->route('back.login')
                ->with('status', 'error')
                ->with('message', trans('auth.unauthorized'));
        }

        Auth::login($userCheck, false);

        // Flag root admin
        $admins = preg_split('/[\s*,\s*]*,+[\s*,\s*]*/', trim(\Config::get('settings.root_admin')));
        session(['root' => in_array($userCheck->getAttribute('email'), $admins)]);

        return redirect()->intended(route('back.home'));
    }
}