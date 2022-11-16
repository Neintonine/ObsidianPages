<?php
declare(strict_types=1);

namespace ObsidianPages\Authentication\Authentications;

use ObsidianPages\Authentication\Authentication;
use ObsidianPages\Lib\Utils;

final class StaticAuthentication implements Authentication
{

    /**
     * @param string $passwordHash The Bcrypt-Hash it checks against
     */
    public function __construct(private readonly string $passwordHash)
    {
    }

    /**
     * @inheritDoc
     */
    public function getFormular(): array
    {
        return [
            [
                'name' => 'Password',
                'placeholder' => 'Password',
                'type' => 'password'
            ]
        ];
    }

    public function check(array $formularData): bool|string
    {
        return password_verify($formularData['Password'], $this->passwordHash);
    }
}
