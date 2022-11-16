<?php
declare(strict_types=1);

namespace ObsidianPages\Authentication;

use ObsidianPages\Lib\Utils;

final class AuthenticationHandler
{
    private static ?Authentication $authentication = null;

    public static function setAuthentication(Authentication $authentication)
    {
        self::$authentication = $authentication;
    }

    public static function hasAvailiableAuthentication(): bool
    {
        return self::$authentication != null;
    }

    public static function getAuthentication(): Authentication
    {
        return self::$authentication;
    }

    public static function authenticate(array $form): bool|string
    {
        $checkReturn = self::$authentication->check($form);
        if (is_string($checkReturn)) {
            return $checkReturn;
        }
        if (!$checkReturn) {
            return 'Login failed';
        }

        session_start();
        $_SESSION['authenticated'] = true;

        return $checkReturn;
    }

    public static function isAuthenticated(): bool
    {
        if (!self::hasAvailiableAuthentication()) {
            return false;
        }

        session_start();

        if (isset($_SESSION['authenticated'])) {
            return $_SESSION['authenticated'];
        }
        return false;
    }
}