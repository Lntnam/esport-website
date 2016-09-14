<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Sofa\Eloquence\Eloquence;
use URL;

class Tournament extends Model
{
    use Eloquence;
    use AppModel;

    protected $searchableColumns = ['name' => 10, 'short' => 5];

    protected $casts = ['prize'];

    protected $hidden = [];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [];

    public function matches()
    {
        return $this->hasMany(Match::class);
    }

    public function getLogoAttribute($value)
    {
        if (substr($value, 0, 7) == 'http://' || substr($value, 0, 8) == 'https://') {
            return $value;
        }

        return URL::asset(config('settings.image-tournaments') . $value);
    }

    public function getCreatedAtAttribute($value)
    {
        return $this->convertToUserTimezone($value);
    }

    public function getUpdatedAtAttribute($value)
    {
        return $this->convertToUserTimezone($value);
    }
}
