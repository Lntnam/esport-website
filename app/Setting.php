<?php
/**
 * Created by PhpStorm.
 * User: Nam
 * Date: 08/09/2016
 * Time: 15:20.
 */
namespace App;

use App\Repositories\SiteSettingRepository;

class Setting
{
    private $cache = [];

    public function clearCache()
    {
        $this->cache = [];
    }

    public function __construct()
    {
        $settings = SiteSettingRepository::all();
        foreach ($settings as $item) {
            $this->cache[$item->key] = $item->value;
        }
    }

    public function get($key)
    {
        if (!isset($this->cache[$key])) {
            return;
        }

        return $this->cache[$key];
    }
}
