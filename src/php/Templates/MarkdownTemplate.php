<?php
declare(strict_types=1);

namespace ObsidianPages\Templates;

use ObsidianPages\Content\ContentReturn;
use ObsidianPages\SessionData;

final class MarkdownTemplate extends Template
{
    public function __construct()
    {
        parent::__construct();

        $this->assign('vault', SessionData::instance()->currentVault);
    }

    public function setMarkdownContent(ContentReturn $content, string $rawData)
    {
        $this->assign('title', $content->getTitle());
        $this->assign('content', $content->getContent());
        $this->assign('rawContent', $rawData);
    }

    public function setNavigation(string $navigation)
    {
        $this->assign('navigation', $navigation);
    }

    public function display($template = 'markdown/showMarkdown.tpl', $cache_id = null, $compile_id = null, $parent = null)
    {
        parent::display($template, $cache_id, $compile_id, $parent);
    }

    public function fetch($template = 'markdown/showMarkdown.tpl', $cache_id = null, $compile_id = null, $parent = null)
    {
        return parent::fetch($template, $cache_id, $compile_id, $parent);
    }
}