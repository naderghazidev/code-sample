<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::post('/login', LoginController::class)->name('user.login');
Route::post('/register', RegisterController::class)->name('user.register');
//Route::get('/test', function (Request $request) {
//    $bmr = (new BMRCalculator())->calculate(90, 183, 28, Gender::MALE);
//    $tdee = (new TDEECalculator())->calculate($bmr, ActivityLevel::SEDENTARY);
//    return response()->json([
//        'bmr' => $bmr,
//        'tdee' => $tdee,
//    ]);
//});

Route::middleware('auth:sanctum')->group(function () {

});
