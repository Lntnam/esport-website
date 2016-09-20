<?php


namespace App\Repositories;


class MarkdownFileRepository
{
    private $fileName = '';

    private $isNew = true;

    private $content = '';

    /**
     * MarkdownFileRepository constructor.
     * @param string $fileName
     */
    public function __construct($fileName = '')
    {
        $this->fileName = $fileName;
    }

    /**
     * @return string
     */
    public function getFileName()
    {
        return $this->fileName;
    }

    /**
     * @return boolean
     */
    public function isIsNew()
    {
        return $this->isNew;
    }

    /**
     * @return string
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * @param string $content
     */
    public function setContent($content)
    {
        $this->content = $content;
    }

    public static function listFiles()
    {

    }

    public function open($fileName)
    {

    }

    public function save($fileName = null, $overwrite = false)
    {

    }

    public function generateUntitledFileName()
    {

    }
}
