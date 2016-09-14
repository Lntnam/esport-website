<?php
namespace App;

use RuntimeException;

class CountryList
{
    private $cache = [];

    private $location = '';

    public function __construct()
    {
        $dir = base_path(config('settings.vendor_dir') . '/umpirsky/country-list/data');
        if (!is_dir($dir)) {
            throw new RuntimeException(sprintf('Unable to locate the country data directory at "%s"', $dir));
        }
        $this->location = realpath($dir);
    }

    public function getOne($countryCode, $locale = 'en')
    {
        $countryCode = mb_strtoupper($countryCode);
        $allCodes = $this->loadData($locale);
        if (!isset($allCodes[$countryCode])) {
            throw new RuntimeException(sprintf('Unable to locate the country code of "%s"', $countryCode));
        }

        return $allCodes[$countryCode];
    }

    public function getList($locale = 'en')
    {

        return $this->loadData($locale);
    }

    protected function loadData($locale)
    {
        if (!isset($this->cache[$locale])) {

            $file = sprintf('%s/%s/country.php', $this->location, $locale);
            if (!is_file($file)) {
                throw new RuntimeException(sprintf('Unable to load the country data file "%s"', $file));
            }
            $data = require $file;
            $this->cache[$locale] = $this->sortData($locale, $data);
        }

        return $this->cache[$locale];
    }

    protected function sortData($locale, $data)
    {
        if (is_array($data)) {
            if (class_exists('Collator')) {
                $collator = new \Collator($locale);
                $collator->asort($data);
            } else {
                asort($data);
            }
        }

        return $data;
    }
}
