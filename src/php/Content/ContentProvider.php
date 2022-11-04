<?php
declare(strict_types=1);

namespace ObsidianPages\Content;

interface ContentProvider
{
    public function getFolderStructure(string $from = ''): array;

    public function getContent(string $path): ContentReturn;
    public function getResource(string $path): string;

    public function hasFile(string $path): bool;

    /**
     * @return array<ContentVault>
     */
    public function getVaults(): array;

    public function findPage(string $filename): string;
    public function findResource(string $filename): string;
}

