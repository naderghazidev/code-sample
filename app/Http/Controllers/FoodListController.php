<?php

namespace App\Http\Controllers;

use App\Services\FoodService;
use App\Utils\Response;
use Illuminate\Http\JsonResponse;

class FoodListController extends Controller
{

    public function __construct(private FoodService $calorieService)
    {
    }

    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function __invoke()
    {
        return Response::success($this->calorieService->all());
    }
}
