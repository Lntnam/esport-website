<?php
/**
 * Created by PhpStorm.
 * User: Nam
 * Date: 02/09/2016
 * Time: 22:29.
 */
namespace App\Repositories;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Laravel\Socialite\AbstractUser;

class UserRepository extends BaseRepository
{
    public static $modelClassName = User::class;

    public static $allowedForCreate = ['name', 'email'];

    public static $allowedForUpdate = ['name', 'email'];

    public function __construct(User $model)
    {
        $this->model = $model;
    }

    public static function getCreateValidationRules()
    {
        return [
            'name'  => 'required',
            'email' => 'required|email|unique:users',
        ];
    }

    public static function getUpdateValidationRules(Model $model)
    {
        return [
            'name'  => 'required',
            'email' => 'required|email|unique:users,email,'.$model->getAttribute('id'),
        ];
    }

    public static function create(array $attributes)
    {
        $model = new User();
        foreach ($attributes as $field => $value) {
            if (in_array($field, static::$allowedForCreate)) {
                $model->setAttribute($field, $value);
            }
        }

        $model->save();

        return $model;
    }

    public static function query($sort, $order)
    {
        return User::withTrashed()
            ->orderBy($sort, $order)
            ->get();
    }

    public static function restoreDeleted($id)
    {
        $deleted = User::withTrashed()
            ->where('id', $id);
        if (!$deleted) {
            return false;
        }

        $deleted->restore();

        return $deleted->first();
    }

    public static function matchWithSocial(AbstractUser $socialUser, $provider)
    {
        $model = User::where('email', '=', $socialUser->getEmail())
            ->first();

        if (empty($model)) {
            $model = User::where('social_id', '=', $socialUser->id)
                ->where('provider', '=', $provider)
                ->first();
        }

        return $model;
    }

    public function updateFromSocial(AbstractUser $socialUser, $provider)
    {
        if (empty($this->model)) {
            $this->model = new User();
        }

        $this->model->setAttribute('email', $socialUser->getEmail());
        $this->model->setAttribute('name', $socialUser->getName());
        $this->model->setAttribute('provider', $provider);
        $this->model->setAttribute('social_id', $socialUser->getId());
        $this->model->setAttribute('avatar', $socialUser->getAvatar());

        $this->model->save();
    }

    public function update($attributes)
    {
        // Make sure only certain fields can be updated this way
        foreach ($attributes as $field => $value) {
            if (in_array($field, static::$allowedForUpdate)) {
                $this->model->setAttribute($field, $value);
            }
        }
        $this->model->save();
    }
}
