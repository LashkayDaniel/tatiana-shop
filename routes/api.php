<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BiserController;
use App\Http\Controllers\BiserTagsController;
use App\Http\Controllers\MainSettingController;
use App\Http\Controllers\SliderController;
use App\Http\Controllers\VishivankiController;
use App\Http\Controllers\VishivankiTagsController;
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

///products
Route::prefix('/vishivanki')->group(function () {
    Route::post('/new-tag', [VishivankiTagsController::class, 'store']);
    Route::get('/get-tags', [VishivankiTagsController::class, 'get']);

    Route::get('/get-all', [VishivankiController::class, 'get']);
    Route::post('/get-all', [VishivankiController::class, 'getAllWithParam']);
    Route::post('/create', [VishivankiController::class, 'store']);
});

Route::prefix('/biser')->group(function () {
    Route::post('/new-tag', [BiserTagsController::class, 'store']);
    Route::get('/get-tags', [BiserTagsController::class, 'get']);

    Route::get('/get-all', [BiserController::class, 'get']);
    Route::post('/get-all', [BiserController::class, 'getAllWithParam']);
    Route::post('/create', [BiserController::class, 'store']);
});

//Route::post('/auth/register', [AuthController::class, 'register']);
Route::post('/auth/login', [AuthController::class, 'login']);
