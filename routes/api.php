<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\MainSettingController;
use App\Http\Controllers\SliderController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('/settings')->group(function () {
    Route::post('/create', [MainSettingController::class, 'store']);
    Route::get('/get', [MainSettingController::class, 'get']);
    Route::put('/update', [MainSettingController::class, 'update']);
});

Route::prefix('/slider')->group(function () {
    Route::post('/create', [SliderController::class, 'store']);
    Route::get('/get', [SliderController::class, 'get']);
});

//Route::post('/auth/register', [AuthController::class, 'register']);
Route::post('/auth/login', [AuthController::class, 'login']);
