<?php
declare(strict_types=1);

namespace ObsidianPages;

use UnitEnum;

final class Utils
{
    /**
     * @param UnitEnum[] $cases
     * @return int[]|string[]
     */
    public static function getEnumValues(array $cases): array {
        return array_map(
            function ($case) {
                return $case->value;
            },
            $cases
        );
    }

    public static function prettyDebug(mixed ...$values) {
        foreach ($values as $value) {

            echo "<pre>" . print_r($value, true) . "</pre>";
            echo "<hr>";
        }
        exit();
    }
}