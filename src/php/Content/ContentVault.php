<?php
declare(strict_types=1);

namespace ObsidianPages\Content;

use Error;

final class ContentVault
{
    private string $name;
    private string $color;
    private string $folderName;
    private bool $visible;
    private string $startPage;

    public function __construct(array $data)
    {
        if (!array_key_exists("name", $data))
            throw new Error('The content vault needs a name!');

        if (!array_key_exists("folderName", $data))
            throw new Error('The content vault needs a folder name!');


        $this->name = $data['name'];
        $this->color = $data['color'] ?? 'black';
        $this->visible = $data['visible'] ?? true;
        $this->folderName = $data['folderName'];
        $this->startPage = $data['startPage'] ?? 'index';
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getColor(): string
    {
        return $this->color;
    }

    /**
     * @return bool
     */
    public function isVisible(): bool
    {
        return $this->visible;
    }

    /**
     * @return string
     */
    public function getFolderName(): string
    {
        return $this->folderName;
    }

    /**
     * @return string
     */
    public function getStartPage(): string
    {
        return $this->startPage;
    }
}