<?php
declare(strict_types=1);

namespace ObsidianPages\Templates;

use ObsidianPages\Authentication\AuthenticationHandler;
use ObsidianPages\Configuration\ConfigurationHandler;
use ObsidianPages\Configuration\Configurations\BasicConfiguration;
use ObsidianPages\Configuration\Configurations\SmartyConfiguration;
use Smarty;

class Template extends Smarty
{
    public function __construct()
    {
        parent::__construct();

        $basicConfig = ConfigurationHandler::Instance()->Get(BasicConfiguration::class);
        $smartyConfig = ConfigurationHandler::Instance()->Get(SmartyConfiguration::class);

        $this->setTemplateDir($basicConfig->getTemplateFolder());
        $this->setConfigDir($smartyConfig->getConfigFolder());
        $this->setCacheDir($smartyConfig->getCacheFolder());
        $this->setCompileDir($smartyConfig->getCompileFolder());

        $this->assign('configHandler', ConfigurationHandler::Instance());
        $this->assign('basicConfig', $basicConfig);
        $this->assign('smartyConfig', $smartyConfig);
        $this->assign('hasAuthConfig', AuthenticationHandler::hasAvailiableAuthentication());
        $this->assign('isAuthenticated', AuthenticationHandler::isAuthenticated());
    }

    public function setContent($content): Template
    {
        $this->assign('content', $content);
        return $this;
    }

    public static function FetchSimple(string $template = ''): string
    {
        return (new Template())->fetch($template);
    }
}