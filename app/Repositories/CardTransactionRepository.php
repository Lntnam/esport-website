<?php


namespace App\Repositories;


use App\Models\CardTransaction;

class CardTransactionRepository extends BaseRepository
{
    protected static $modelClassName = CardTransaction::class;

    protected static $allowedForCreate = ['source', 'name', 'provider', 'ip', 'pin', 'serial', 'amount'];

    public function __construct(CardTransaction $model)
    {
        $this->model = $model;
    }

    public static function getCreateValidationRules()
    {
        return ['provider' => 'required', 'pin' => 'required', 'serial' => 'required'];
    }

    public static function create(array $attributes)
    {
        /* We do not need to check if PIN/Provider/Serial have been used. The gateway shall do it for us. */
        $model = new CardTransaction();
        foreach ($attributes as $field => $value) {
            if (in_array($field, static::$allowedForCreate)) {
                $model->setAttribute($field, $value);
            }
        }

        $model->save();

        return $model;
    }

    public static function query($keyword, $sort, $order)
    {
        return CardTransaction::search($keyword)
                    ->orderBy($sort, $order)
                    ->get();
    }
}
