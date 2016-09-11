<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Sofa\Eloquence\Eloquence;

class Subscriber extends Model
{
    use Eloquence;
    use SoftDeletes;

    protected $searchableColumns = [
    ];

    protected $appends = [

    ];

    protected $casts = [
    ];

    protected $hidden = [
    ];

    protected $dates = [

    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
    ];
}
