<?php
declare(strict_types=1);

namespace ObsidianPages\Templates;

use Smarty;

class Template extends Smarty
{
    public function __construct()
    {
        parent::__construct();

        $this->setTemplateDir(TEMPLATE_FOLDER);
        $this->setConfigDir(SMARTY_CONFIG_FOLDER);
        $this->setCacheDir(SMARTY_CACHE_FOLDER);
        $this->setCompileDir(SMARTY_COMPILE_FOLDER);
    }

    public function setContent($content): Template
    {
        $this->assign('content', $content);
        return $this;
    }

    public function display($template = null, $cache_id = null, $compile_id = null, $parent = null)
    {
        parent::display($template, $cache_id, $compile_id, $parent);
    }

    public function fetch($template = null, $cache_id = null, $compile_id = null, $parent = null)
    {
        return parent::fetch($template, $cache_id, $compile_id, $parent);
    }

    public static function FetchSimple(string $template = ''): string
    {
        return (new Template())->fetch($template);
    }
}