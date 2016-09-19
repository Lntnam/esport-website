<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContentBlockContent extends Model
{
    use AppModel;

    protected $touches = ['block'];

    protected $fillable = ['locale', 'content'];

    public function block()
    {
        return $this->belongsTo(ContentBlock::class);
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
