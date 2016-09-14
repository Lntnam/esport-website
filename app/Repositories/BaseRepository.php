<?php
/**
 * Created by PhpStorm.
 * User: Nam
 * Date: 02/09/2016
 * Time: 21:36
 */
namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;

abstract class BaseRepository
{

    protected static $modelClassName;

    protected $model;

    protected static $allowedForCreate;

    protected static $allowedForUpdate;

    protected static $numberFields;

    public static function getCreateValidationRules()
    {
        return [];
    }

    public static function getUpdateValidationRules(Model $model)
    {
        return [];
    }

    public static function create(array $attributes)
    {
        return null;
    }

    public function getModel()
    {
        return $this->model;
    }

    public static function read($id)
    {
        return call_user_func_array(static::$modelClassName . "::find", [$id]);
    }

    public static function all($columns = ['*'])
    {
        return call_user_func_array(static::$modelClassName . "::all", [$columns]);
    }

    public static function destroy($ids)
    {
        return call_user_func_array(static::$modelClassName . "::destroy", [$ids]);
    }

    protected static function emptyStringToNull($attributes)
    {
        foreach ($attributes as $k => $v) {
            if (empty($v)) {
                if (!empty(static::$numberFields) && in_array($k, static::$numberFields)) {
                    $attributes[$k] = 0;
                } else {
                    $attributes[$k] = null;
                }
            }
        }

        return $attributes;
    }
}
