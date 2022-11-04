<?php
declare(strict_types=1);

namespace ObsidianPages\Content;

final class ContentReturn
{
    private string $title;
    private string $content;

    public function __construct(string $title = '', string $content = '')
    {
        $this->title = $title;
        $this->content = $content;
    }

    public function setContent(string $content): ContentReturn
    {
        $this->content = $content;
        return $this;
    }

    public function getContent(): string
    {
        return $this->content;
    }

    public function setTitle(string $title): ContentReturn
    {
        $this->title = $title;
        return $this;
    }
    public function getTitle(): string
    {
        return $this->title;
    }
}