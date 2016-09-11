<?php
/**
 * Created by PhpStorm.
 * User: Nam
 * Date: 02/09/2016
 * Time: 22:29
 */
namespace App\Repositories;

use App\Models\Opponent;
use Illuminate\Database\Eloquent\Model;

class OpponentRepository extends BaseRepository  {

    static $modelClassName = Opponent::class;

    static $allowedForCreate = ['name', 'short', 'country', 'flag'];

    static $allowedForUpdate = ['name', 'short', 'country', 'flag'];

    public function __construct(Opponent $model)
    {
        $this->model = $model;
    }

    static function getCreateValidationRules()
    {
        return [
            'name'=>'required',
            'short'=>'required',
            'flag'=>'url',
        ];
    }

    static function getUpdateValidationRules(Model $model)
    {
        return [
            'name'=>'required',
            'short'=>'required',
            'flag'=>'url',
        ];
    }

    static function create(array $attributes)
    {
        $opp = new Opponent();
        foreach ($attributes as $field => $value) {
            if (in_array($field, static::$allowedForCreate)) {
                $opp->setAttribute($field, $value);
            }
        }
        $opp->save();
        return $opp;
    }

    public static function query($sort='name', $order='asc')
    {
        return Opponent::orderBy($sort, $order)
            ->get();
    }

    public static function search($keyword, $sort='name', $order='asc')
    {
        return Opponent::search($keyword)
            ->orderBy($sort, $order)
            ->get();
    }

    public static function getList() {
        $opps = Opponent::select('id', 'name')
            ->orderBy('name', 'asc')
            ->get();
        $array = [];
        foreach ($opps as $t) {
            $array[$t->id] = $t->name;
        }
        return $array;
    }

    public function update($attributes)
    {
        foreach ($attributes as $field => $value) {
            if (in_array($field, static::$allowedForUpdate)) {
                $this->model->setAttribute($field, $value);
            }
        }
        $this->model->save();
    }
}