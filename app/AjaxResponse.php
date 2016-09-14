<?php

namespace App;
/**
 * Created by PhpStorm.
 * User: Nam
 * Date: 04/09/2016
 * Time: 04:34
 */

use Carbon\Carbon;

class AjaxResponse
{
    public $success = true;
    public $content = "";
    public $model = null;
    public $time = '';

    public function __construct($success, $content='', $model=null)
    {
        $this->success = $success;
        $this->content = $content;
        $this->model = $model;
        $this->time = Carbon::now();
    }
}
