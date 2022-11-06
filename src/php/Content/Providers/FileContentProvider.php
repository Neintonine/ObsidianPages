<?php
declare(strict_types=1);

namespace ObsidianPages\Content\Providers;

use ObsidianPages\Content\ContentProvider;
use ObsidianPages\Content\ContentReturn;
use ObsidianPages\Content\ContentVault;
use ObsidianPages\SessionData;
use ObsidianPages\Lib\Utils;

final class FileContentProvider implements ContentProvider
{

    const INVISIBLE_PREFIX = '_';

    public function getFolderStructure(string $from = ''): array
    {
        return Utils::array_get_value_by_path($this->getDirContentAsArray(PAGES_FOLDER), $from);
    }

    public function getContent(string $path): ContentReturn
    {
        return new ContentReturn(pathinfo($path, PATHINFO_FILENAME), file_get_contents(PAGES_FOLDER . $path));
    }

    public function hasFile(string $path): bool
    {
        return is_file(PAGES_FOLDER . $path);
    }

    /**
     * @return ContentVault[]
     */
    public function getVaults(): array
    {
        $result = [];

        $folders = $this->getFolders(PAGES_FOLDER);
        foreach ($folders as $folder) {
            $jsonFile = $folder . '/.info';
            $name = pathinfo($folder)['basename'];
            if (!file_exists($jsonFile)) {
                $result[] = new ContentVault(['name' => $name, 'folderName' => $name]);
                continue;
            }

            $content = json_decode(file_get_contents($jsonFile), true);
            $content['name'] ??= $name;
            $content['folderName'] = $name;
            $result[] = new ContentVault($content);
        }

        return $result;
    }

    /**
     * @return array<string>
     */
    private function getFolders(string $path): array
    {
        return array_filter(glob($path . '/*'), 'is_dir');
    }

    private function getDirContents(string $dir, string $displayDir, &$results = array()): array {
        $files = scandir($dir);
        $displayDirectory = $displayDir;
        foreach ($files as $key => $value) {
            if ($value === '.' || $value === '..') {
                continue;
            }
            $path = realpath($dir . DIRECTORY_SEPARATOR . $value);
            $displayDirectory = $displayDir . DIRECTORY_SEPARATOR . $value;
            if (!is_dir($path)) {
                $results[] = $displayDirectory;
            } else if ($value != "." && $value != "..") {
                $this->getDirContents($path, $displayDirectory, $results);
            }
        }

        return $results;
    }
    private function wrapperGetDirContent(string $from): array {
        $dirContents = $this->getDirContents(PAGES_FOLDER, '');
        return array_map(function ($content) use ($from) {
            return substr($content, strlen($from));
        },
            array_filter($dirContents, function ($content) use ($from) {
                return Utils::str_starts_with($content, $from);
            }));
    }

    private function getDirContentAsArray(string $dir): array {
        $files = scandir($dir);
        $result = [];
        foreach ($files as $key => $value) {
            if ($value === '.' || $value === '..') {
                continue;
            }
            if (Utils::str_starts_with($value, self::INVISIBLE_PREFIX)) {
                continue;
            }
            $path = realpath($dir . DIRECTORY_SEPARATOR . $value);
            if (is_dir($path)) {
                $result[$value] = $this->getDirContentAsArray($path);

                continue;
            }

            if (!Utils::str_ends_with($value, 'md')) continue;

            $result[] = $value;
        }

        return $result;
    }

    public function findPage(string $filename): string
    {
        $dirname = pathinfo(SessionData::instance()->currentNote,  PATHINFO_DIRNAME);

        $fileFolderStructure = $this->wrapperGetDirContent(pathinfo(SessionData::instance()->currentNote,  PATHINFO_DIRNAME));
        $searchResult = array_search('/'.$filename, $fileFolderStructure);
        if ($searchResult) {
            return $dirname . $fileFolderStructure[$searchResult];
        }

        $vaultFolderStructure = $this->wrapperGetDirContent("/".SessionData::instance()->currentVaultName);

        foreach ($vaultFolderStructure as $item) {
            if (Utils::str_ends_with($item, $filename)) {
                return "/".SessionData::instance()->currentVaultName . $item;
            }
        }

        return '';
    }

    public function findResource(string $filename): string
    {
        return $this->findPage($filename);
    }

    public function getResource(string $path): string
    {
        return file_get_contents(PAGES_FOLDER . $path);
    }
}