<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
    use Notifiable;
    use SoftDeletes;
    use AppModel;

    protected $appends = ['root'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = ['remember_token',];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    /* determine if this is a root admin */
    public function getRootAttribute()
    {
        $admins = preg_split('/[\s*,\s*]*,+[\s*,\s*]*/', trim(config('settings.root_admin')));

        return in_array($this->getAttribute('email'), $admins);
    }

    public function getCreatedAtAttribute($value)
    {
        return $this->convertToUserTimezone($value);
    }

    public function getUpdatedAtAttribute($value)
    {
        return $this->convertToUserTimezone($value);
    }

    public function getDeletedAtAttribute($value)
    {
        return $this->convertToUserTimezone($value);
    }
}
