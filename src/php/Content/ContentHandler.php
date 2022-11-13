<?php
declare(strict_types=1);

namespace ObsidianPages\Content;

use ObsidianPages\Content\Providers\FileContentProvider;
use ObsidianPages\Lib\Utils;
use ObsidianPages\SessionData;
use ObsidianPages\Templates\Template;

final class ContentHandler
{
    const TEMPLATE_NO_NAVIGATION = 'markdown/navigation/noNavigation.tpl';
    const TEMPLATE_NAVITEM = 'markdown/navigation/parts/navItem.tpl';
    const TEMPLATE_NAVFOLDER = 'markdown/navigation/parts/navFolder.tpl';

    private static ContentProvider $provider;
    public static function getContentProvider(): ContentProvider
    {
        return self::$provider ?? (self::$provider = new FileContentProvider());
    }

    public static function convertRawDataToText(string $rawData): string
    {
        return str_replace('"', '\'', $rawData);
    }

    public static function convertStructureToHTML(array $structure, string $path): string
    {
        if (empty($structure)) {
            return Template::FetchSimple(self::TEMPLATE_NO_NAVIGATION);
        }

        $directoryIndex = 0;
        return self::_convertStructureToHTMLRecursive($structure, $path, $directoryIndex, 0, '/' . SessionData::instance()->currentVaultName);
    }

    private static function _convertStructureToHTMLRecursive(array $structure, string $selectedPath, int &$directoryIndex, int $depth, string $path): string
    {

        $count = 0;
        $ownDirectoryIndex = $directoryIndex;
        $resultHTML = '';
        $template = new Template();
        foreach ($structure as $dirName => $structureItem)
        {
            $count++;
            $content = $structureItem;
            if (is_array($structureItem)) {
                $nextPath = $path . '/' . $dirName;

                $directoryIndex++;
                $template->assign('containsSelection', Utils::str_starts_with($selectedPath, $nextPath));
                $template->assign('targetDirectoryIndex', $directoryIndex);
                $template->assign('directoryIndex', $ownDirectoryIndex);
                $template->assign('count', $count);
                $template->assign('folder', true);
                $template->assign('depth', $depth);
                $template->assign('foldername', $dirName);
                $template->assign('content', self::_convertStructureToHTMLRecursive($structureItem, $selectedPath, $directoryIndex, $depth + 1, $path . '/' . $dirName));
                $resultHTML .= $template->fetch(self::TEMPLATE_NAVFOLDER);

                continue;
            }

            $link = $path . '/' . $content;

            $template->assign('content', substr($content, 0, -3));
            $template->assign("directoryIndex", $ownDirectoryIndex);
            $template->assign('folder', false);
            $template->assign('depth', $depth);
            $template->assign('count', $count);
            $template->assign('path', substr($link, 1));
            $template->assign('isSelected', $link == $selectedPath);
            $resultHTML .= $template->fetch(self::TEMPLATE_NAVITEM);
        }

        return $resultHTML;
    }
}