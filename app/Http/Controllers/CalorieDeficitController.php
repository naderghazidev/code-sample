<?php

namespace App\Http\Controllers;

use App\Http\Requests\CalorieDeficitRequest;
use App\Services\CalorieDeficitCalculator;
use App\Utils\Response;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class CalorieDeficitController extends Controller
{

    public function __construct(private CalorieDeficitCalculator $calorieDeficitCalculator)
    {
    }

    /**
     * Handle the incoming request.
     *
     * @param CalorieDeficitRequest $request
     * @return JsonResponse
     */
    public function __invoke(CalorieDeficitRequest $request)
    {
        $calorieDeficit = $this->calorieDeficitCalculator->calculate(
            Auth::user()->tdee,
            $request->validated('days'),
            $request->validated('weight_loss_amount')
        );

        return Response::success($calorieDeficit);
    }
}
