<?php
declare(strict_types=1);

namespace ObsidianPages\Configuration\Configurations;

use ObsidianPages\Configuration\Configuration;

final class BasicConfiguration extends Configuration
{
    /**
     * @param string $baseDir
     * @param string $phpFolder
     * @param string $resourceFolder
     * @param string $templateFolder
     * @param string $vendorFolder
     * @param string $baseURL
     */
    public function __construct(
        private string $baseDir = BASE_FOLDER,
        private readonly string  $phpFolder = '/src/php',
        private readonly string  $resourceFolder = '/public/resources',
        private readonly string  $templateFolder = '/src/templates',
        private readonly string  $vendorFolder = '/vendor',

        private readonly string  $baseURL = '/'
    )
    {
        $this->baseDir ??= realpath($_SERVER['DOCUMENT_ROOT'] . '/..');
    }

    /**
     * @return string
     */
    public function getBaseDir(): string
    {
        return $this->baseDir;
    }

    /**
     * @return string
     */
    public function getPhpFolder(): string
    {
        return $this->baseDir . $this->phpFolder;
    }

    /**
     * @return string
     */
    public function getResourceFolder(): string
    {
        return $this->baseDir . $this->resourceFolder;
    }

    /**
     * @return string
     */
    public function getTemplateFolder(): string
    {
        return $this->baseDir . $this->templateFolder;
    }

    /**
     * @return string
     */
    public function getVendorFolder(): string
    {
        return $this->baseDir . $this->vendorFolder;
    }

    /**
     * @return string
     */
    public function getBaseURL(): string
    {
        return $this->baseURL;
    }
}