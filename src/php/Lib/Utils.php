<?php
declare(strict_types=1);

namespace ObsidianPages\Lib;

final class Utils
{
    public static function str_ends_with(string $str, string $end): bool {
        return (@substr_compare($str, $end, -strlen($end))==0);
    }

    /**
     * @param string|array<string> $str
     * @param $start
     * @return bool
     */
    public static function str_starts_with(string $str, $start): bool
    {
        if (is_array($start)){
            foreach ($start as $item) {
                if (self::str_starts_with($str, $item)) {
                    return true;
                }
            }
            return false;
        }

        return (@substr_compare($str, $start, 0, strlen($start))==0);
    }

    public static function pretty_print_r($object) {
        echo '<pre>' . print_r($object, true) . '</pre>';
    }

    public static function array_get_value_by_path(array $array, string $path, bool $allowSkip = false) {
        $pathSeperated = array_filter(explode('/', $path));

        $item = $array;
        foreach ($pathSeperated as $pathSeperation) {
            if ($pathSeperation == '/') continue;

            if (!array_key_exists($pathSeperation, $item)) {
                if ($allowSkip) continue;

                break;
            }

            $item = $item[$pathSeperation];
        }
        return $item;
    }

    public static function array_search_value(array $array, $value)
    {
        foreach ($array as $item) {
            if ($item === $value) return [];

            if (is_array($item)) {
                $return = self::array_search_value($item, $value);
                if (!$return) {
                    continue;
                }
                $return[] = $item;
                return $return;
            }
        }

        return false;
    }
}