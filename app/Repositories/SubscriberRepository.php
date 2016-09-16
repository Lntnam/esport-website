<?php
namespace App\Repositories;

use App;
use App\Models\Subscriber;
use Illuminate\Database\Eloquent\Model;
use Request;

class SubscriberRepository extends BaseRepository
{
    protected static $modelClassName = Subscriber::class;

    protected static $allowedForCreate = ['name', 'email'];

    protected static $allowedForUpdate = ['name', 'email', 'language', 'interests', 'ip_signup', 'opt_in_code', 'ip_opt', 'mail_chimp_id', 'status',];

    public function __construct(Subscriber $model)
    {
        $this->model = $model;
    }

    public static function getCreateValidationRules()
    {
        return ['email' => 'bail|required|email', 'interests' => 'bail|required|array|interests'];
    }

    public static function getUpdateValidationRules(Model $model)
    {
        return ['interests' => 'bail|required|array|interests'];
    }

    public static function create(array $attributes)
    {
        /* check if email exists */
        $model = Subscriber::where('email', $attributes['email'])->first();
        if (!$model) {
            $model = new Subscriber();
        }

        foreach ($attributes as $field => $value) {
            if (in_array($field, static::$allowedForCreate)) {
                $model->setAttribute($field, $value);
            }
        }
        /* interests from array to json */
        $model->setAttribute('interests', json_encode($attributes['interests']));

        /* Setting other attributes */
        $model->setAttribute('status', 'subscribed');
        $model->setAttribute('language', App::getLocale());
        $model->setAttribute('ip_signup', Request::ip());
        $model->setAttribute('ip_opt', Request::ip());

        $model->save();

        return $model;
    }

    public static function unsubscribe($mailChimpId)
    {
        $model = Subscriber::where('mail_chimp_id', $mailChimpId)
                           ->first();
        if ($model) {
            $model->setAttribute('status', 'unsubscribed');
            $model->save();

            return $model;
        }

        return false;
    }

    public function updateMailChimpId($mailChimpId)
    {
        $this->model->setAttribute('mail_chimp_id', $mailChimpId);
        $this->model->save();
    }

    public static function unsubscribeFromMailChimp($email)
    {
        $model = Subscriber::where('email', $email)
                           ->first();
        if (!empty($model)) {
            $model->setAttribute('status', 'unsubscribed');
            $model->save();

            return $model;
        }

        return false;
    }

    public static function resubscribeFromMailChimp($email)
    {
        $model = Subscriber::where('email', $email)
                           ->first();
        if (!empty($model)) {
            $model->setAttribute('status', 'unsubscribed');
            $model->save();

            return $model;
        }

        return false;
    }

    public function updateInterests($interests)
    {
        $this->model->setAttribute('interests', json_encode($interests));
        $this->model->save();
    }
}
