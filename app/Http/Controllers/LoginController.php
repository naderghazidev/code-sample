<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Exceptions\UserExceptions;
use App\Http\Requests\LoginRequest;
use App\Utils\Response;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /**
     * @throws AuthenticationException
     */
    public function __invoke(LoginRequest $request)
    {
        $email = $request->validated('email');
        $password = $request->validated('password');

        // check if user with these credentials exists
        $isCredentialsValid = Auth::attempt([
            'email' => $email,
            'password' => $password,
        ], true);

        if (!$isCredentialsValid) {
            UserExceptions::unauthenticated(__('Invalid Credentials provided!'));
        }
        $user = Auth::user();

        return Response::success(message: __('Welcome :firstName!', ['firstName' => $user->first_name]));
    }
}
