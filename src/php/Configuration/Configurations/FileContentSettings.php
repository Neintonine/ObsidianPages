<?php
declare(strict_types=1);

namespace ObsidianPages\Configuration\Configurations;

use ObsidianPages\Configuration\Configuration;
use ObsidianPages\Configuration\ConfigurationHandler;

final class FileContentSettings implements Configuration
{
    private BasicConfiguration $basicConfiguration;

    public function __construct(
        private readonly string $pagesFolder = '/pages',
        private readonly array  $invisiblePrefixes = ['_', '.'],
    )
    {}

    public static function RequiredConfiguration(): array
    {
        return [BasicConfiguration::class];
    }

    public function OnRequest(): void
    {
        $this->basicConfiguration = ConfigurationHandler::Instance()->Get(BasicConfiguration::class);
    }

    public function getInvisiblePrefixes(): array
    {
        return $this->invisiblePrefixes;
    }

    public function getPagesFolder(): string
    {
        return $this->basicConfiguration->getBaseDir() . $this->pagesFolder;
    }
}