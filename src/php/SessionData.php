<?php
declare(strict_types=1);

namespace ObsidianPages;

final class SessionData
{
    static SessionData $instance;

    public static function createInstance()
    {
        self::$instance = new SessionData();
    }

    public static function instance(): SessionData
    {
        if (self::$instance !== null) return self::$instance;
    }

    public string $currentNote;
    public string $currentVault;
}