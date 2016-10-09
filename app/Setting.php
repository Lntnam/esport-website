<?php
/**
 * Created by PhpStorm.
 * User: Nam
 * Date: 08/09/2016
 * Time: 15:20
 */
namespace App;

use App\Repositories\MasterListRepository;
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
        $settings = SiteSettingRepository::read();
        foreach ($settings as $item) {
            $this->cache[$item->key] = $item->value;
        }
    }

    public function get($key)
    {
        if (!isset($this->cache[$key])) return null;

        return $this->cache[$key];
    }

    public function set($key, $value)
    {
        if (isset($this->cache[$key])) {
            $this->cache[$key] = $value;

            SiteSettingRepository::save([$key => $value]);
        }
    }

    public function server($key) {
        if (isset($_SERVER[$key]))
            return $_SERVER[$key];

        return null;
    }

    public function getJSON($key)
    {
        if (!isset($this->cache[$key])) return null;

        return json_decode($this->cache[$key]);
    }

    public function getMasterList($key)
    {
        $list_item = MasterListRepository::get($key);
        if (!empty($list_item)) {
            return json_decode($list_item->value);
        }
    }

    public function getMasterListValue($key, $arrKey)
    {
        $list_item = MasterListRepository::get($key);
        if (!empty($list_item)) {
            return json_decode($list_item->value)->$arrKey;
        }
    }
}
