<?php

use App\Http\Controllers\CalorieDeficitController;
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

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/calorie/deficit', CalorieDeficitController::class)->name('calorie.deficit');
});
