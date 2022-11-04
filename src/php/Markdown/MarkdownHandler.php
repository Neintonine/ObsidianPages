<?php
declare(strict_types=1);

namespace ObsidianPages\Markdown;

use ObsidianPages\Content\ContentProvider;
use Parsedown;

final class MarkdownHandler
{
    /**
     * @var array<MarkdownChangerPre>
     */
    private array $preChanger;

    /**
     * @var array<MarkdownChangerPost>
     */
    private array $postChanger;

    private Parsedown $parsedown;

    public function __construct(array $changer = [])
    {
        $this->parsedown = new Parsedown();

        if (empty($changer)) {
            $changer = require 'defaultChangers.php';
        }

        $this->processChangers($changer);
    }

    public function parse(string $content, ContentProvider $contentProvider): string
    {
        $this->executePreChangers($content, $this->preChanger, $contentProvider);
        $content = $this->parsedown->text($content);
        $this->executePostChangers($content, $this->postChanger, $contentProvider);
        return $content;
    }

    private function processChangers(array $changers): void
    {
        $this->preChanger = $this->postChanger = [];

        foreach ($changers as $changer) {
            $markdownChanger = new $changer();
            if ($markdownChanger instanceof MarkdownChangerPre) {
                $this->preChanger[] = $markdownChanger;
            }
            if ($markdownChanger instanceof MarkdownChangerPost) {
                $this->postChanger[] = $markdownChanger;
            }
        }
    }


    /**
     * @param array<MarkdownChangerPre> $changer
     */
    private function executePreChangers(string &$content, array $changer, ContentProvider $contentProvider): void
    {
        foreach ($changer as $item) {
            $content = $item->PreChange($content, $contentProvider);
        }
    }
    /**
     * @param array<MarkdownChangerPost> $changer
     */
    private function executePostChangers(string &$content, array $changer, ContentProvider $contentProvider): void
    {
        foreach ($changer as $item) {
            $content = $item->PostChange($content, $contentProvider);
        }
    }
}