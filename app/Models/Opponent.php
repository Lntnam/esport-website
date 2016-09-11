<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Sofa\Eloquence\Eloquence;

class Opponent extends Model
{
    use Eloquence;
    protected $searchableColumns = ['name'=>10, 'short'=>5];

    protected $casts = [
    ];

    protected $hidden = [
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'schedule'
    ];

    public function matches() {
        return $this->hasMany(Match::class);
    }

    public function getFlagAttribute($value) {
        if (substr($value, 0, 7) == 'http://' || substr($value, 0, 8) == 'https://') {
            return $value;
        }
        return \URL::asset(\Config::get('settings.image-opponents') . $value);
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
