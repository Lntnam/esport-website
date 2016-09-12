<?php
/**
 * Created by PhpStorm.
 * User: Nam
 * Date: 02/09/2016
 * Time: 22:29.
 */
namespace App\Repositories;

use App\Models\Tournament;
use Illuminate\Database\Eloquent\Model;

class TournamentRepository extends BaseRepository
{
    public static $modelClassName = Tournament::class;

    public static $allowedForCreate = ['name', 'short', 'type', 'logo', 'homepage', 'bracket', 'prize'];

    public static $allowedForUpdate = ['name', 'short', 'type', 'logo', 'homepage', 'bracket', 'prize'];

    public function __construct(Tournament $model)
    {
        $this->model = $model;
    }

    public static function getCreateValidationRules()
    {
        return [
            'name'     => 'required',
            'short'    => 'required',
            'type'     => 'required|in:online,onlan,other',
            'logo'     => 'url',
            'homepage' => 'url',
            'bracket'  => 'url',
            'prize'    => 'integer',
        ];
    }

    public static function getUpdateValidationRules(Model $model)
    {
        return [
            'name'     => 'required',
            'short'    => 'required',
            'type'     => 'required|in:online,onlan,other',
            'logo'     => 'url',
            'homepage' => 'url',
            'bracket'  => 'url',
            'prize'    => 'integer',
        ];
    }

    public static function create(array $attributes)
    {
        $tour = new Tournament();
        foreach ($attributes as $field => $value) {
            if (in_array($field, static::$allowedForCreate)) {
                $tour->setAttribute($field, $value);
            }
        }
        $tour->save();

        return $tour;
    }

    public static function query($sort = 'name', $order = 'asc')
    {
        return Tournament::orderBy($sort, $order)
            ->get();
    }

    public static function search($keyword, $sort = 'name', $order = 'asc')
    {
        return Tournament::search($keyword)
            ->orderBy($sort, $order)
            ->get();
    }

    public static function getList()
    {
        $tours = Tournament::select('id', 'name')
            ->orderBy('name', 'asc')
            ->get();
        $array = [];
        foreach ($tours as $t) {
            $array[$t->id] = $t->name;
        }

        return $array;
    }

    public function update($attributes)
    {
        // Make sure only certain fields can be updated this way
        foreach ($attributes as $field => $value) {
            if (in_array($field, static::$allowedForUpdate)) {
                $this->model->setAttribute($field, $value);
            }
        }
        $this->model->save();
    }
}
