<?php
declare(strict_types=1);

namespace ObsidianPages\Markdown\Changer;

use ObsidianPages\Configuration\ConfigurationHandler;
use ObsidianPages\Configuration\Configurations\BasicConfiguration;
use ObsidianPages\Content\ContentProvider;
use ObsidianPages\Markdown\MarkdownChangerPre;

final class Images implements MarkdownChangerPre
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
            $path = ConfigurationHandler::Instance()->Get(BasicConfiguration::class)->getBaseURL() . 'vaultresource' . $provider->findResource($name);
            return "<img src='$path' class='markdownImage' alt='$name' />";
        }, $matches);

        return str_replace($matches, $resultingMatch, $content);
    }
}