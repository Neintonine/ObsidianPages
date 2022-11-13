<?php
declare(strict_types=1);

namespace ObsidianPages\Configuration;

class Configuration
{
    /**
     * @return string[]
     */
    public static function RequiredConfiguration(): array
    {
        return [];
    }

    public function OnRequest(): void
    {}
}