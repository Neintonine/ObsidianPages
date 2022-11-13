<?php
declare(strict_types=1);

namespace ObsidianPages\Exceptions;

use Exception;
use ObsidianPages\Lib\Utils;
use Throwable;

final class ObsidianPagesException extends Exception
{
    public function __construct(string $message = "", int $code = 0, ?Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }

    public function __toString(): string
    {
        return "{$this->getFile()} ({$this->getLine()})<br>" .
            str_replace('\\n', '<br>', $this->message) .
            "<br><br> Trace:<br>". implode('<br>', array_map(function($item) {
                return "{$item['file']}[{$item['line']}]: {$item['class']}{$item['type']}{$item['function']}()";
            }, $this->getTrace())) . "<br>";

    }
}