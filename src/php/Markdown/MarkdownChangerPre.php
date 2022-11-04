<?php
declare(strict_types=1);

namespace ObsidianPages\Markdown;

use ObsidianPages\Content\ContentProvider;

interface MarkdownChangerPre
{
    public function PreChange(string $content, ContentProvider $provider): string;

}