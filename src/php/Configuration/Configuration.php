<?php
declare(strict_types=1);

namespace ObsidianPages\Configuration;

interface Configuration
{
    /**
     * @return string[]
     */
    public static function RequiredConfiguration(): array;

    public function OnRequest(): void;
}