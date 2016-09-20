<?php


namespace App\Repositories;

use App;
use App\Models\ContentBlock;

class ContentBlockRepository extends BaseRepository
{
    protected static $modelClassName = ContentBlock::class;

    protected static $allowedForCreate = ['key', 'view', 'description'];

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
        return ['key' => 'required', 'view' => 'required'];
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

        return $model;
    }

    public static function query()
    {
        return ContentBlock::orderBy('view')
                           ->orderBy('key')
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

    public function saveContent($content)
    {
        $blockContent = $this->model->contents()
                                    ->firstOrNew(['locale' => App::getLocale()]);
        $blockContent->setAttribute('content', $content);
        $blockContent->save();
    }

    public static function loadOne($view, $key)
    {
        $model = ContentBlock::where([
            ['key', $key],
            ['view', $view],
        ])
                             ->first();

        if (!empty($model))
            return new ContentBlockRepository($model);

        return null;
    }

    public static function load($view)
    {
        return ContentBlock::where('view', $view)
                           ->with('contents')
                           ->get();
    }
}
