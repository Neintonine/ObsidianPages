<?php
declare(strict_types=1);

namespace ObsidianPages\Routing\Routes;

use ObsidianPages\Content\ContentHandler;
use ObsidianPages\Content\ContentReturn;
use ObsidianPages\Content\ContentVault;
use ObsidianPages\Lib\Utils;
use ObsidianPages\Markdown\MarkdownHandler;
use ObsidianPages\Routing\Route;
use ObsidianPages\Routing\RouteData;
use ObsidianPages\Routing\RouteResult;
use ObsidianPages\SessionData;
use ObsidianPages\Templates\MarkdownTemplate;

final class VaultPageRoute implements Route
{

    static ContentReturn $NotFoundReturn;

    public static function Init() {
        self::$NotFoundReturn = new ContentReturn(
            "",
            ''
        );
    }

    public function AppliesTo(RouteData $requestData): bool
    {
        $data = pathinfo($requestData->uri);
        return !array_key_exists('extension', $data) || $data['extension'] === 'md';
    }

    public function Act(RouteData $requestData): RouteResult
    {
        SessionData::instance()->currentVaultName = $currentVault = explode('/', $requestData->uri)[1];

        $contentProvider = ContentHandler::getContentProvider();
        $vaults = ContentHandler::getContentProvider()->getVaults();
        $currentVaultInstance = array_values(array_filter($vaults, function ( ContentVault $e) use ($currentVault) {
            return $e->getFolderName() == $currentVault;
        }));
        if (empty($currentVaultInstance)) {
            return RouteResult::Error404();
        }
        SessionData::instance()->currentVault = $currentVaultInstance[0];
        SessionData::instance()->currentNote = $requestData->uri;

        $pathdata = pathinfo($requestData->uri);

        if (!array_key_exists('extension', $pathdata)) {
            if (Utils::str_ends_with($requestData->uri, "/")) {
                $requestData->uri .= SessionData::instance()->currentVault->getStartPage() . '.md';
            } else {
                $requestData->uri .= '.md';
            }
        }

        $folderStructure = $contentProvider->getFolderStructure($currentVault);

        $contentData = $contentProvider->hasFile($requestData->uri) ? $contentProvider->getContent($requestData->uri) : self::$NotFoundReturn;

        $markdownHandler = new MarkdownHandler();
        $translatedMarkdown = $markdownHandler->parse($contentData->getContent(), $contentProvider);

        $template = new MarkdownTemplate();
        $template->setMarkdownContent($contentData->setContent($translatedMarkdown));
        $template->setNavigation(ContentHandler::convertStructureToHTML($folderStructure, $requestData->uri));
        return RouteResult::Content200($template->fetch());
    }
}

VaultPageRoute::Init();