<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Services\UserService;
use App\Utils\Response;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{

    use RefreshDatabase;

    public function __construct(private UserService $userService)
    {
    }

    /**
     * @throws AuthenticationException
     */
    public function __invoke(LoginRequest $request)
    {
        $email = $request->validated('email');
        $password = $request->validated('password');

        $this->userService->login($email, $password);

        $user = Auth::user();

        return Response::success(message: __('Welcome :firstName!', ['firstName' => $user->first_name]));
    }
}
