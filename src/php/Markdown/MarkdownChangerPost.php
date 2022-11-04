<?php
declare(strict_types=1);

namespace ObsidianPages\Markdown;

use ObsidianPages\Content\ContentProvider;

interface MarkdownChangerPost
{
    public function PostChange(string $content, ContentProvider $provider): string;
}