<?php
declare(strict_types=1);

namespace ObsidianPages\Routing\Routes;

use ObsidianPages\Content\ContentHandler;
use ObsidianPages\Routing\RouteData;
use ObsidianPages\Routing\RouteResult;
use ObsidianPages\Templates\MarkdownTemplate;
use ObsidianPages\Templates\Template;

final class IndexRoute implements \ObsidianPages\Routing\Route
{

    public function AppliesTo(RouteData $requestData): bool
    {
        $indexArray = [
            '/',
            '/index',
            '/index.html',
            '/index.md'
            ];

        return in_array($requestData->uri, $indexArray);
    }

    public function Act(RouteData $requestData): RouteResult
    {
        $vaults = ContentHandler::getContentProvider()->getVaults();

        $template = (new Template());
        $template->assign("vaults", $vaults);
        return RouteResult::Content200($template->fetch('index.tpl'));
    }
}