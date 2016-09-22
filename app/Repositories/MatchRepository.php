<?php
/**
 * Created by PhpStorm.
 * User: Nam
 * Date: 02/09/2016
 * Time: 22:29
 */
namespace App\Repositories;

use App\Models\Match;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class MatchRepository extends BaseRepository
{

    protected static $modelClassName = Match::class;

    protected static $allowedForCreate = ['tournament_id', 'opponent_id', 'for', 'against', 'games', 'over', 'stream', 'round'];

    protected static $allowedForUpdate = ['tournament_id', 'opponent_id', 'for', 'against', 'games', 'over', 'stream', 'round'];

    protected static $numberFields = ['for', 'against', 'games', 'opponent_id', 'over'];

    public function __construct(Match $model)
    {
        $this->model = $model;
    }

    public static function getCreateValidationRules()
    {
        return ['schedule' => 'required', 'tournament_id' => 'required|integer|exists:tournaments,id', 'stream' => 'url'];
    }

    public static function getUpdateValidationRules(Model $model)
    {
        return ['schedule' => 'required', 'tournament_id' => 'required|integer|exists:tournaments,id', 'stream' => 'url'];
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
        $match->setAttribute('schedule', Carbon::createFromFormat(config('settings.match_format'), $attributes['schedule'], $attributes['timezone'])
                                               ->tz(config('app.timezone')));
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
        $this->model->setAttribute('schedule', Carbon::createFromFormat(config('settings.match_format'), $attributes['schedule'], $attributes['timezone'])
                                                     ->tz(config('app.timezone')));
        $this->model->save();
    }

    public static function getLiveMatches()
    {
        /* current ly getting Today's matches */
        return Match::where([['over', false], ['schedule', '<=', Carbon::today()
                                                                       ->endOfDay()
                                                                       ->toDateTimeString()]])
                    ->with('tournament')
                    ->with('opponent')
                    ->orderBy('schedule', 'desc')
                    ->get();
    }

    public static function getUpcomingMatches()
    {
        return Match::where([['over', false], ['schedule', '>=', Carbon::tomorrow()
                                                                      ->toDateTimeString()]])
                    ->with('tournament')
                    ->with('opponent')
                    ->orderBy('schedule', 'asc')
                    ->get();
    }

    public static function getRecentMatches($offset = 0, $limit = 0)
    {
        $builder = Match::where('over', true)
                        ->with('tournament')
                        ->with('opponent')
                        ->orderBy('schedule', 'desc')
                        ->offset($offset);
        if ($limit) {
            $builder->limit($limit);
        }

        return $builder->get();
    }

    public static function getRecentMatchesCount()
    {
        return Match::where('over', true)
                    ->count();
    }

    public static function getUpcomingMatchesInRange(Carbon $endDate)
    {
        return Match::where([['over', false], ['schedule', '>', Carbon::now(config('app.timezone'))
                                                                      ->toDateTimeString()], ['schedule', '<=', $endDate->toDateTimeString()]])
                    ->with('tournament')
                    ->with('opponent')
                    ->orderBy('schedule', 'asc')
                    ->get();
    }
}
