<?php
declare(strict_types=1);

namespace ObsidianPages\Authentication;

use ObsidianPages\Configuration\Configuration;

interface Authentication
{
    /**
     * @return array<array{name: string, placeholder: string, type: string}>
     */
    public function getFormular(): array;
    public function check(array $formularData): bool|string;
}