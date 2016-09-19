<?php


namespace App\Repositories;

use App\Models\ContentBlock;

class ContentBlockRepository extends BaseRepository
{
    protected static $modelClassName = ContentBlock::class;

    protected static $allowedForCreate = ['key', 'description'];

    protected static $allowedForUpdate = ['description'];

    /**
     * ContentBlockRepository constructor.
     * @param ContentBlock $model
     */
    public function __construct(ContentBlock $model)
    {
        $this->model = $model;
    }

    public static function getCreateValidationRules()
    {
        return ['key' => 'required'];
    }

    public static function create(array $attributes)
    {
        $attributes = static::emptyStringToNull($attributes);

        $model = new ContentBlock();
        foreach ($attributes as $field => $value) {
            if (in_array($field, static::$allowedForCreate)) {
                $model->setAttribute($field, $value);
            }
        }
        $model->save();

        foreach (config('settings.locales') as $locale => $details) {
            $model->contents()
                  ->create(['locale' => $locale, 'content' => '']);
        }

        return $model;
    }

    public static function query($sort = 'name', $order = 'asc')
    {
        return ContentBlock::orderBy($sort, $order)
                           ->get();
    }

    public function update($attributes)
    {
        $attributes = static::emptyStringToNull($attributes);

        foreach ($attributes as $field => $value) {
            if (in_array($field, static::$allowedForUpdate)) {
                $this->model->setAttribute($field, $value);
            }
        }
        $this->model->save();
    }

    public static function load($prefix)
    {
        return ContentBlock::where('key', 'like', $prefix . '.%')
                           ->with('contents')
                           ->get();
    }
}
