<?php

namespace App\Services\Domain\Auth;

use App\Models\User;

use function auth;

class LoginService
{
    public function login(
        string $email,
        string $password
    ): bool {
        return auth()->attempt(
            [
                User::EMAIL_COLUMN    => $email,
                User::PASSWORD_COLUMN => $password,
            ],
            true
        );
    }
}
