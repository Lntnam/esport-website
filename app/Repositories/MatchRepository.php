<?php
/**
 * Created by PhpStorm.
 * User: Nam
 * Date: 02/09/2016
 * Time: 22:29.
 */
namespace App\Repositories;

use App\Models\Match;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class MatchRepository extends BaseRepository
{
    public static $modelClassName = Match::class;

    public static $allowedForCreate = ['tournament_id', 'opponent_id', 'for', 'against', 'games', 'over'];

    public static $allowedForUpdate = ['opponent_id', 'for', 'against', 'games', 'over'];

    public static $numberFields = ['for', 'against', 'games', 'opponent_id', 'over'];

    public function __construct(Match $model)
    {
        $this->model = $model;
    }

    public static function getCreateValidationRules()
    {
        return [
            'schedule'          => 'required',
            'tournament_id'     => 'required|integer|exists:tournaments,id',
        ];
    }

    public static function getUpdateValidationRules(Model $model)
    {
        return [
        ];
    }

    public static function create(array $attributes)
    {
        $attributes = static::emptyStringToNull($attributes);

        $match = new Match();
        foreach ($attributes as $field => $value) {
            if (in_array($field, static::$allowedForCreate)) {
                $match->setAttribute($field, $value);
            }
        }
        $match->setAttribute('schedule', \Timezone::convertToUTC($attributes['schedule'], $attributes['timezone']));
        $match->save();

        return $match;
    }

    public static function query($keyword, $sort = 'schedule', $order = 'desc')
    {
        return Match::search($keyword)
            ->with('tournament')
            ->with('opponent')
            ->orderBy($sort, $order)
            ->get();
    }

    public function update($attributes)
    {
        $attributes = static::emptyStringToNull($attributes);
        // Make sure only certain fields can be updated this way

        foreach ($attributes as $field => $value) {
            if (in_array($field, static::$allowedForUpdate)) {
                $this->model->setAttribute($field, $value);
            }
        }
        $this->model->save();
    }

    public static function getLiveMatches()
    {
        return Match::where([['over', false], ['schedule', '<=', Carbon::now()->toDateTimeString()]])
            ->with('tournament')
            ->with('opponent')
            ->orderBy('schedule', 'desc')
            ->get();
    }

    public static function getUpcomingMatches()
    {
        return Match::where([['over', false], ['schedule', '>', Carbon::now()->toDateTimeString()]])
            ->with('tournament')
            ->with('opponent')
            ->orderBy('schedule', 'asc')
            ->get();
    }

    public static function getRecentMatches()
    {
        return Match::where('over', true)
            ->with('tournament')
            ->with('opponent')
            ->orderBy('schedule', 'desc')
            ->limit(\Config::get('settings.past-matches-count'))
            ->get();
    }
}
