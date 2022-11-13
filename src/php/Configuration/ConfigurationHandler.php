<?php
declare(strict_types=1);

namespace ObsidianPages\Configuration;

use Error;
use Exception;
use ObsidianPages\Configuration\Configurations\BasicConfiguration;
use ObsidianPages\Configuration\Configurations\SmartyConfiguration;
use ObsidianPages\Exceptions\ObsidianPagesException;
use ObsidianPages\Lib\Utils;

final class ConfigurationHandler
{
    /**
     * @var string[]
     */
    private static array $defaultConfigs = [
        BasicConfiguration::class,
        SmartyConfiguration::class,
    ];
    private static ConfigurationHandler $instance;
    public static function Instance(): ConfigurationHandler {
        return self::$instance ?? (self::$instance = new ConfigurationHandler());
    }

    /**
     * @var array<string, Configuration>
     */
    private array $configurations = [];

    public const DEBUG = true;

    public function AddDefaults(): void {
        foreach (self::$defaultConfigs as $defaultConfig) {
            $classInstance = new $defaultConfig();
            if (!($classInstance instanceof Configuration)) {
                throw new ObsidianPagesException('The configuration instance of "' . $defaultConfig . '" does not extend from Configuration.');
            }

            $this->configurations[$defaultConfig] = $classInstance;
        }
    }

    public function Add(Configuration ...$configurations): void {
        foreach ($configurations as $configuration) {
            $this->configurations[$configuration::class] = $configuration;
        }
    }

    /**
     * @template T of Configuration
     * @param class-string<T> $class
     * @param bool $autoCreate
     * @return T
     * @throws ObsidianPagesException
     */
    public function Get(string $class, bool $autoCreate = true): Configuration
    {
        if (!key_exists($class, $this->configurations)) {
            if (!$autoCreate) {
                throw new ObsidianPagesException('ConfigurationHandler "' . $class . '" wasn\'t added.');
            }

            $configuration = new $class();
            if (!($configuration instanceof Configuration)) {
                throw new ObsidianPagesException('Tried to create a not configuration-class "'.$class.'"');
            }
            self::Add(new $class());
        }

        $configuration ??= $this->configurations[$class];
        $requiredConfigs = $configuration::RequiredConfiguration();
        $storedConfigs = array_keys($this->configurations);
        $notFoundConfigs = [];
        foreach ($requiredConfigs as $requiredConfig) {
            if (!in_array($requiredConfig, $storedConfigs)) {
                $notFoundConfigs[] = $requiredConfig;
            }
        }

        if (!empty($notFoundConfigs)) {
            throw new ObsidianPagesException('ConfigurationHandler "' . $class . '" does not have the required configuration available.\nThe following are missing:\n' . implode('\n', $notFoundConfigs));
        }

        $configuration->OnRequest();

        return $configuration;
    }
}