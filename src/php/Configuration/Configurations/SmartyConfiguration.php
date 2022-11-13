<?php
declare(strict_types=1);

namespace ObsidianPages\Configuration\Configurations;

use ObsidianPages\Configuration\Configuration;
use ObsidianPages\Configuration\ConfigurationHandler;

final class SmartyConfiguration extends Configuration
{
    private BasicConfiguration $basicConfiguration;

    public function __construct(
        private readonly string $theme = 'default',
        private readonly bool   $useTintedNavigation = true,
        private readonly string $configFolder = '/src/smarty/config',
        private readonly string $cacheFolder = '/src/smarty/cache',
        private readonly string $compileFolder = '/src/smarty/cache/compile',
    )
    { }

    public static function RequiredConfiguration(): array
    {
        return [BasicConfiguration::class];
    }

    public function OnRequest(): void
    {
        $this->basicConfiguration = ConfigurationHandler::Instance()->Get(BasicConfiguration::class, false);
    }

    public function getTheme(): string
    {
        return $this->theme;
    }
    public function isUsingTintedNavigation(): bool
    {
        return $this->useTintedNavigation;
    }

    public function getConfigFolder(): string
    {
        return $this->basicConfiguration->getBaseDir() . $this->configFolder;
    }
    public function getCacheFolder(): string
    {
        return $this->basicConfiguration->getBaseDir() . $this->cacheFolder;
    }
    public function getCompileFolder(): string
    {
        return $this->basicConfiguration->getBaseDir() . $this->compileFolder;
    }
}