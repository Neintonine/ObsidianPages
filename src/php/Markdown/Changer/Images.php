<?php
declare(strict_types=1);

namespace ObsidianPages\Markdown\Changer;

use ObsidianPages\Content\ContentProvider;
use ObsidianPages\Lib\Utils;

final class Images implements \ObsidianPages\Markdown\MarkdownChangerPre
{
    const REGEX = '/!\[\[.+]]/i';

    public function PreChange(string $content, ContentProvider $provider): string
    {
        if (!preg_match_all(self::REGEX, $content, $matches)) {
            return $content;
        }


        $matches = $matches[0];
        $resultingMatch = array_map(function ($item) use ($provider) {
            $name = trim($item, "![]");
            $path = BASE_URL . 'vaultresource' . $provider->findResource($name);
            return "<img src='$path' class='markdownImage' alt='$name' />";
        }, $matches);

        return str_replace($matches, $resultingMatch, $content);
    }
}