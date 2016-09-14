<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected function retrieveSortParams(Request $request, array $default = ['sort' => 'name', 'order' => 'asc'])
    {
        $default['sort'] = !empty($request->input('sort')) && is_string($request->input('sort')) ? $request->input('sort') : $default['sort'];
        $default['order'] = !empty($request->input('order')) && is_string($request->input('order')) ? $request->input('order') : $default['order'];

        return $default;
    }
}
