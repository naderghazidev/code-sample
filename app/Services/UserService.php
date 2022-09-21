<?php

namespace App\Services;

use App\Exceptions\UserExceptions;
use App\Models\User;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Support\Facades\Auth;

class UserService
{

    public function register(array $attributes): User
    {
        $user = new User($attributes);
        $user->save();
        return $user;
    }

    /**
     * @throws AuthenticationException
     */
    public function login(string $email, string $password): void
    {
        // check if user with these credentials exists
        $isCredentialsValid = Auth::attempt([
            'email' => $email,
            'password' => $password,
        ], true);

        if (!$isCredentialsValid) {
            UserExceptions::unauthenticated(__('Invalid Credentials provided!'));
        }
    }
}
