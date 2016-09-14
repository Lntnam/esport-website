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
}
