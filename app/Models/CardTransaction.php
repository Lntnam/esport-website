<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CardTransaction extends Model
{
    use AppModel;

    public function getCreatedAtAttribute($value)
    {
        return $this->convertToUserTimezone($value);
    }

    public function getUpdatedAtAttribute($value)
    {
        return $this->convertToUserTimezone($value);
    }
}
