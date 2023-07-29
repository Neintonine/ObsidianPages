<?php
declare(strict_types=1);

namespace ObsidianPages\Template;

use League\Plates\Engine;
use Zend\Diactoros\Response;

final class TemplateEngine extends Engine
{
    protected const FOLDERS = [
        'layout',
        'pages'
    ];
    protected const TEMPLATE_PATH = BASE_PHP_FOLDER . '/templates';
    protected const FILE_EXTENSION = 'php';

    private string $title;

    public function __construct()
    {
        parent::__construct(self::TEMPLATE_PATH, self::FILE_EXTENSION);

        foreach (self::FOLDERS as $folder) {
            parent::addFolder($folder, self::TEMPLATE_PATH . '/' . $folder);
        }

        parent::registerFunction("loadFiles", $this->loadFiles(...));
    }

    #region Extensions
    private function loadFiles(?string $page): string
    {
        if (is_null($page)) {
            return '';
        }

        $result =  $this->loadFileForPage(
            $page, 'css', '<link rel="stylesheet" href="%s">'
        );
        $result .= $this->loadFileForPage(
            $page,
            'js',
            '<script src="%s"></script>'
        );

        return $result;
    }
    private function loadFileForPage(string $page, string $part, string $template): string
    {
        $publicPath = "/$part/$page.$part";
        $path = PUBLIC_FOLDER . $publicPath;

        if (file_exists($path)) {
            return sprintf($template, $publicPath);
        }
        if (!PROD) {
            return "<!-- File '$path' not found. -->";
        }
        return '';
    }
    #endregion
}