<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterRequest;
use App\Models\User;
use App\Utils\Response;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{

    public function __construct()
    {
    }

    /**
     * Handle the incoming request.
     *
     * @param RegisterRequest $request
     * @return JsonResponse
     */
    public function __invoke(RegisterRequest $request)
    {
        $attributes = $request->safe()->all();

        $user = new User($attributes);
        $user->save();
        Auth::login($user);

        return Response::success(__('Registration Successful!'));
    }
}
