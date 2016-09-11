<?php
/**
 * Created by PhpStorm.
 * User: Nam
 * Date: 05/09/2016
 * Time: 01:52
 */

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller as BaseController;

class DashboardController extends BaseController
{
    public function getDashboard()
    {
        return view('back.dashboard');
    }
}