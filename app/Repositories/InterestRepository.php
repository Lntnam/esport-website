<?php


namespace App\Repositories;

use App\Models\Interest;

class InterestRepository extends BaseRepository
{
    protected static $modelClassName = Interest::class;

    public static function query($sort = 'name', $order = 'asc')
    {
        return Interest::orderBy($sort, $order)
                       ->get();
    }

    public static function getList()
    {
        $list = Interest::select('mail_chimp_id', 'name')
                        ->orderBy('name', 'asc')
                        ->get();
        $array = [];
        foreach ($list as $t) {
            $array[$t->getAttribute('mail_chimp_id')] = $t->getAttribute('name');
        }

        return $array;
    }
}
