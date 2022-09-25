<?php

namespace App\Services;

use App\Enums\ActivityLevel;
use App\Enums\Gender;
use App\Exceptions\UserExceptions;
use App\Models\User;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Support\Facades\Auth;

class UserService
{

    public function __construct(private BMRCalculator $bmrCalculator, private TDEECalculator $tdeeCalculator)
    {
    }

    public function register(array $attributes): User
    {

        # calculate BMR
        $attributes['bmr'] = $this->bmrCalculator->calculate($attributes['weight'], $attributes['height'], $attributes['age'], Gender::from($attributes['gender']));

        # calculate TDEE
        $attributes['tdee'] = $this->tdeeCalculator->calculate($attributes['bmr'], ActivityLevel::from($attributes['activity_level']));

        # create a new user
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
