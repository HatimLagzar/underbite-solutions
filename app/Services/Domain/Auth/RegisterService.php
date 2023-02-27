<?php

namespace App\Services\Domain\Auth;

use App\Mail\EmailVerificationMail;
use App\Models\User;
use App\Services\Core\User\UserService;
use App\Services\Domain\Auth\Exceptions\EmailAlreadyInUseException;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class RegisterService
{
    private UserService $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    /**
     * @throws EmailAlreadyInUseException
     */
    public function register(string $name, string $email, string $password, int $countryId): User
    {
        $name     = htmlspecialchars($name);
        $email    = filter_var($email, FILTER_SANITIZE_EMAIL);
        $password = htmlspecialchars($password);

        $existingAccount = $this->userService->findByEmail($email);
        if ($existingAccount instanceof User) {
            throw new EmailAlreadyInUseException();
        }

        $user = $this->userService->create([
            User::NAME_COLUMN               => $name,
            User::EMAIL_COLUMN              => $email,
            User::PASSWORD_COLUMN           => Hash::make($password),
            User::COUNTRY_ID_COLUMN         => $countryId,
            User::VERIFICATION_TOKEN_COLUMN => Str::random(60),
            User::TYPE_COLUMN               => User::NORMAL_TYPE,
        ]);

        Mail::to($user)->queue(new EmailVerificationMail($user));

        return $user;
    }
}
