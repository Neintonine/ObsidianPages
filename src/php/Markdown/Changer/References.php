<?php
declare(strict_types=1);

namespace ObsidianPages\Markdown\Changer;

use ObsidianPages\Content\ContentProvider;

final class References implements \ObsidianPages\Markdown\MarkdownChangerPre
{

    const REGEX = '/\[\[.+]]/i';

    public function PreChange(string $content, ContentProvider $provider): string
    {
        if (!preg_match_all(self::REGEX, $content, $matches)) {
            return $content;
        }

        $matches = $matches[0];
        $resultingMatch = array_map(function ($item) use ($provider) {
            $name = trim($item, "[]");
            $path = $provider->findPage($name . ".md");
            return "<a href='$path' class='referenceLink'>$name</a>";
        }, $matches);

        return str_replace($matches, $resultingMatch, $content);
    }
}