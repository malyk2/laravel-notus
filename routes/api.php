<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\AuthController;

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
Route::prefix('admin')->group(function () {
    Route::prefix('auth')->group(function () {
        Route::post('login', [AuthController::class, 'login']);
        Route::post('register', [AuthController::class, 'register']);
        Route::prefix('password')->middleware('guest')->group(function () {
            Route::post('forgot', [AuthController::class, 'passwordForgot']);
            Route::post('reset', [AuthController::class, 'passwordReset']);
        });
        Route::prefix('verify')->group(function () {
            Route::get('{id}/{hash}', [AuthController::class, 'verifyEmail'])->name('api.verify.email');
        });
        Route::middleware('auth:sanctum')->group(function () {
            Route::get('me', [AuthController::class, 'me']);
            Route::post('logout', [AuthController::class, 'logout']);
        });
    });
    Route::middleware('auth:sanctum')->group(function () {
        Route::prefix('users')->group(function () {
            Route::get('', [UserController::class, 'index']);
            Route::post('', [UserController::class, 'create']);
            Route::get('{user}', [UserController::class, 'get']);
            Route::post('{user}', [UserController::class, 'update']);
        });
    });
});
