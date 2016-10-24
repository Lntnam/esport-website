<?php
namespace App\Repositories;

use App\Models\Tournament;
use Illuminate\Database\Eloquent\Model;

class TournamentRepository extends BaseRepository
{

    protected static $modelClassName = Tournament::class;

    protected static $allowedForCreate = ['name', 'short', 'type', 'homepage', 'bracket', 'game'];

    protected static $allowedForUpdate = ['name', 'short', 'type', 'homepage', 'bracket'];

    public function __construct(Tournament $model)
    {
        $this->model = $model;
    }

    public static function getCreateValidationRules()
    {
        return ['name' => 'required|max:50', 'short' => 'required|max:10', 'type' => 'required|in:online,onlan,other', 'homepage' => 'url', 'bracket' => 'url'];
    }

    public static function getUpdateValidationRules(Model $model)
    {
        return ['name' => 'required', 'short' => 'required', 'type' => 'required|in:online,onlan,other', 'homepage' => 'url', 'bracket' => 'url'];
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

    public static function search($keyword, $game, $sort = 'name', $order = 'asc')
    {
        return Tournament::search($keyword)
            ->where('game', $game)
            ->orderBy($sort, $order)
            ->get();
    }

    public static function readWithCount($id)
    {
        return Tournament::withCount('matches')
            ->where('id', $id)
            ->first();
    }

    public static function getList($game)
    {
        $tours = Tournament::select('id', 'name')
            ->where('game', $game)
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
