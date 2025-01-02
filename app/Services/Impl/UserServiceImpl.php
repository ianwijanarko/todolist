<?php

namespace App\Services\Impl;

use App\Services\UserService;

class UserServiceImpl implements UserService
{
    private array $user = [
        'admin' => 'admins'
    ];

    public function login(string $username, string $password): bool
    {
        if (!isset($this->user[$username])) {
            return false;
        }
        $correctPassword = $this->user[$username];

        if ($password === $correctPassword) {
            return true;
        } else {
            return false;
        }

    }
}