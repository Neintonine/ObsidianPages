<?php
declare(strict_types=1);

namespace ObsidianPages\Exceptions;

final class ErrorHandler
{
    public static function HandleWarning($errorNumber, $errorString): void
    {
        echo "<b>Warning:</b> [$errorNumber] $errorString";
    }
    public static function HandleError($errorNumber, $errorString): void
    {
        echo "<b>Error:</b> [$errorNumber] $errorString";
    }

    public static function ShutdownFunction(): void
    {
        $lastError    = error_get_last();
        $fatal_errors = [E_ERROR, E_PARSE, E_CORE_ERROR, E_COMPILE_ERROR, E_USER_ERROR];
        if ($lastError && in_array($lastError['type'], $fatal_errors, true)) {
            echo "<b>Fatal Error:</b> " . $lastError['message'];
        }

    }
}