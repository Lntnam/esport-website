<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Sofa\Eloquence\Eloquence;

class Match extends Model
{
    use Eloquence;
    protected $searchableColumns = [
        'tournament.name'=>20,
        'tournament.short'=>5,
        'opponent.name'=>25,
        'opponent.short'=>10,
    ];

    protected $appends = ['date', 'time', 'is_past', 'formatted_schedule', 'diff'];

    protected $casts = [
        'prize'
    ];

    protected $hidden = [
    ];

    protected $dates = ['schedule'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
    ];

    public function opponent() {
        return $this->belongsTo(Opponent::class);
    }

    public function tournament() {
        return $this->belongsTo(Tournament::class);
    }

    public function getDateAttribute() {
        return (new Carbon($this->getAttribute('schedule')))->formatLocalized(\Config::get('settings.match-date-localized'));
    }
    public function getTimeAttribute() {
        return (new Carbon($this->getAttribute('schedule')))->formatLocalized(\Config::get('settings.match-time-localized'));
    }
    public function getFormattedScheduleAttribute() {
        return (new Carbon($this->getAttribute('schedule')))->formatLocalized(\Config::get('settings.match-localized'));
    }
    public function getIsPastAttribute() {
        return (new Carbon($this->getAttribute('schedule')))->lt(Carbon::now());
    }
    public function getDiffAttribute() {
        return (new Carbon($this->getAttribute('schedule')))->diffForHumans(Carbon::now());
    }

    public function getScheduleAttribute($value) {
        return \Timezone::convertFromUTC($value, \Config::get('settings.default_timezone'));
    }
    public function getCreatedAtAttribute($value) {
        if (empty($value)) return null;
        return \Timezone::convertFromUTC($value, \Config::get('settings.default_timezone'));
    }
    public function getUpdatedAtAttribute($value) {
        if (empty($value)) return null;
        return \Timezone::convertFromUTC($value, \Config::get('settings.default_timezone'));
    }

}
