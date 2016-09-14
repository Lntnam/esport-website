<?php
/**
 * Created by PhpStorm.
 * User: Nam
 * Date: 12/09/2016
 * Time: 07:09
 */

namespace App\Repositories;


use App\Models\MailCampaign;

class MailCampaignRepository extends BaseRepository
{
    protected static $modelClassName = MailCampaign::class;

    public function __construct(MailCampaign $model)
    {
        $this->model = $model;
    }

    public static function create(array $attributes)
    {
        return MailCampaign::create($attributes);
    }

    public static function getLatestByType($type)
    {
        return MailCampaign::where('type', $type)
                           ->orderBy('created_at', 'desc')
                           ->first();
    }
}
