<?php
declare(strict_types=1);

namespace ObsidianPages\Markdown\Changer;

use ObsidianPages\Content\ContentProvider;
use ObsidianPages\Markdown\MarkdownChangerConst;
use ObsidianPages\Markdown\MarkdownChangerPre;

final class Tags implements MarkdownChangerPre
{

    const REGEX = '/#(\p{L}|\p{Pd}|\p{N})+/iu';

    public function PreChange(string $content, ContentProvider $provider): string
    {
        return preg_replace(self::REGEX, '<a class="tag">$0</a>', $content);
    }
}