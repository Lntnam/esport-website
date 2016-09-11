<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Sofa\Eloquence\Eloquence;

class Tournament extends Model
{
    use Eloquence;
    protected $searchableColumns = ['name'=>10, 'short'=>5];

    protected $casts = [
        'prize'
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

    public function matches() {
        return $this->hasMany(Match::class);
    }

    public function getLogoAttribute($value) {
        if (substr($value, 0, 7) == 'http://' || substr($value, 0, 8) == 'https://') {
            return $value;
        }
        return \URL::asset(\Config::get('settings.image-tournaments') . $value);
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
