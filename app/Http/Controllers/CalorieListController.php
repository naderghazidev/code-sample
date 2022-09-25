<?php

namespace App\Http\Controllers;

use App\Services\CalorieService;
use App\Utils\Response;
use Illuminate\Http\JsonResponse;

class CalorieListController extends Controller
{

    public function __construct(private CalorieService $calorieService)
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
