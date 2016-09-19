<?php


namespace App;


use App\Repositories\ContentBlockRepository;

class ContentBlock
{
    private $cache = [];

    private $page = '';

    public function output($key)
    {
        $page = substr($key, 0, strpos($key, '.'));

        if ($page != $this->page || empty($this->cache)) {
            /* Load content for whole page if not cached */
            $blocks = ContentBlockRepository::load($page);
            if (!empty($blocks)) {
                foreach ($blocks as $block) {
                    $contents = [];
                    foreach ($block->getAttribute('contents') as $content) {
                        $contents[$content->getAttribute('locale')] = $content->getAttribute('content');
                    }
                    $this->cache[$block->getAttribute('key')] = $contents;
                }
            }
            else {
                return $key;
            }
        }

        if (isset($this->cache[$key])) {
            $block = $this->cache[$key];
            if (isset($block[\App::getLocale()]))
                return $block[\App::getLocale()];

            return $block[config('app.locale')];
        }

        return $key;
    }
}