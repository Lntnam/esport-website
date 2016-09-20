<?php


namespace App;

use App\Repositories\ContentBlockRepository;

class ContentBlock
{
    private $cache = [];

    private $view = '';

    public function output($view, $key, ...$args)
    {
        if (!$this->loadToCache($view)) {
            return $key;
        }

        if (isset($this->cache[$key])) {
            $block = $this->cache[$key];
            $text = $key;
            if (isset($block[\App::getLocale()]))
                $text = $block[\App::getLocale()];
            else if (isset($block[config('app.locale')]))
                $text = $block[config('app.locale')];

            return sprintf($text, ...$args);
        }

        return $key;
    }

    public function getList($view)
    {
        if (!$this->loadToCache($view)) {
            return [];
        }

        return $this->cache;
    }

    private function loadToCache($view)
    {
        if ($view != $this->view || empty($this->cache)) {
            $blocks = ContentBlockRepository::load($view);
            if (!empty($blocks)) {
                foreach ($blocks as $block) {
                    $contents = [];
                    foreach ($block->getAttribute('contents') as $content) {
                        $contents[$content->getAttribute('locale')] = $content->getAttribute('content');
                    }
                    $this->cache[$block->getAttribute('key')] = $contents;
                }

                $this->view = $view;

                return true;
            }

            return false;
        }

        return true;
    }
}
