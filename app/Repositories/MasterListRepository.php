<?php
/**
 * Created by PhpStorm.
 * User: Nam
 * Date: 02/09/2016
 * Time: 23:20
 */
namespace App\Repositories;

use App\Models\MasterList;

class MasterListRepository
{
    public static function get($key)
    {
        return MasterList::where('key', $key)->first();
    }

    public static function set($key, $value)
    {
        $list_item = MasterList::where('key', $key)->first();
        if (!empty($list_item)) {
            $list_item->value = $value;
            $list_item->save();
        }
    }
}
