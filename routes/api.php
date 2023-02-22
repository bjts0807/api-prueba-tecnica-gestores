<?php

use App\Http\Controllers\NacController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();

    Route::prefix('users')->group(function () {
        Route::get('/', [UserController::class, 'index']);
        Route::post('/store', [UserController::class, 'store']);
        Route::put('/update', [UserController::class, 'update']);
        Route::get('/show/{id}', [UserController::class, 'show']);
    });



});

Route::prefix('nacs')->group(function () {
    Route::get('/', [NacController::class, 'index']);
    Route::post('/store', [NacController::class, 'store']);
    Route::put('/update', [NacController::class, 'update']);
    Route::delete('/destroy', [NacController::class, 'destroy']);
    Route::get('/show/{id}', [NacController::class, 'show']);
});




