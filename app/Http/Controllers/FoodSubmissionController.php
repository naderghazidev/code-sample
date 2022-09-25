<?php

namespace App\Http\Controllers;

use App\Http\Requests\FoodSubmissionRequest;
use App\Services\FoodService;
use App\Utils\Response;
use Illuminate\Http\JsonResponse;

class FoodSubmissionController extends Controller
{

    public function __construct(private FoodService $foodService)
    {
    }

    /**
     * Handle the incoming request.
     *
     * @param FoodSubmissionRequest $request
     * @return JsonResponse
     */
    public function __invoke(FoodSubmissionRequest $request)
    {
        $this->foodService->syncFoods($request->validated('foods'));

        return Response::success(__('Foods added to your records successfully!'));
    }
}
