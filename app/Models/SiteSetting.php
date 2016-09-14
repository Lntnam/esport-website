<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class SiteSetting extends Model
{
    protected $primaryKey = 'key';
    public $incrementing = false;

    protected $casts = ['lines', 'visible', 'order'];

    protected $hidden = ['visible', 'order'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [

    ];

    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope('visibility', function (Builder $builder) {
            $builder->where('visible', '=', 1);
        });
    }
}
