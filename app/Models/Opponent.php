<?php

namespace App\Models;

use App;
use CountryList;
use Illuminate\Database\Eloquent\Model;
use Sofa\Eloquence\Eloquence;
use URL;

class Opponent extends Model
{
    use Eloquence;
    use AppModel;

    protected $searchableColumns = ['name' => 10, 'short' => 5];

    protected $appends = ['country_name'];

    public function matches()
    {
        return $this->hasMany(Match::class);
    }

    public function getCreatedAtAttribute($value)
    {
        return $this->convertToUserTimezone($value);
    }

    public function getUpdatedAtAttribute($value)
    {
        return $this->convertToUserTimezone($value);
    }

    public function getCountryNameAttribute()
    {
        return CountryList::getOne($this->getAttribute('country'), App::getLocale());
    }
}
