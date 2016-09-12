<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;
    use SoftDeletes;

    protected $appends = ['root'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'remember_token',
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'deleted_at',
    ];

    /* determine if this is a root admin */
    public function getRootAttribute()
    {
        $admins = preg_split('/[\s*,\s*]*,+[\s*,\s*]*/', trim(\Config::get('settings.root_admin')));

        return in_array($this->getAttribute('email'), $admins);
    }

    public function getCreatedAtAttribute($value)
    {
        if (empty($value)) {
            return;
        }

        return \Timezone::convertFromUTC($value, \Config::get('settings.default_timezone'));
    }

    public function getUpdatedAtAttribute($value)
    {
        if (empty($value)) {
            return;
        }

        return \Timezone::convertFromUTC($value, \Config::get('settings.default_timezone'));
    }

    public function getDeletedAtAttribute($value)
    {
        if (empty($value)) {
            return;
        }

        return \Timezone::convertFromUTC($value, \Config::get('settings.default_timezone'));
    }
}
