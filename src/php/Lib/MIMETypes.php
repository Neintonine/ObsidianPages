<?php
declare(strict_types=1);

namespace ObsidianPages\Lib;

final class MIMETypes
{
    public const APACHE_MIME_TYPES_URL = 'https://svn.apache.org/repos/asf/httpd/httpd/trunk/docs/conf/mime.types';

    /**
     * @var array<string, string>
     */
    private static array $mimeTypes;
    public static function init()
    {
        self::$mimeTypes = self::generateMimeArray(self::APACHE_MIME_TYPES_URL);
    }

    /**
     * @return array<string, string>
     */
    public static function generateMimeArray(string $url): array
    {
        $s = [];
        foreach (@explode("\n", @file_get_contents($url)) as $x)
            if (isset($x[0]) && $x[0] !== '#' && preg_match_all('#(\S+)#', $x, $out) && isset($out[1]) && ($c = count($out[1])) > 1)
                for ($i = 1; $i < $c; $i++)
                    $s[$out[1][$i]] = $out[1][0];
        //@sort($s);
        return $s;
    }

    public static function getMimeType(string $fileExtension): string
    {
        return self::$mimeTypes[$fileExtension] ?? '';
    }
}

MIMETypes::init();