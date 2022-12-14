<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use Laravel\Passport\Http\Controllers\AccessTokenController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\BlogController;

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

Route::group(['prefix' => 'auth'], function () {
    Route::post('login', [
        'uses' => AccessTokenController::class.'@issueToken',
        'as' => 'login',
        'middleware' => ['format-response-sign-in', 'add-data-response'],
    ]);

    Route::group(['middleware' => 'auth:member'], function () {
        Route::post('logout', [AuthController::class, 'logout']);
        Route::get('info', [AuthController::class, 'info']);
    });
});

Route::post('/', [MemberController::class, 'store']);
Route::group(['middleware' => 'auth:member'], function () {
    Route::group(['prefix' => 'members'], function () {
        Route::get('/', [MemberController::class, 'index']);
        Route::put('/{id}', [MemberController::class, 'update']);
    });

    Route::group(['prefix' => 'blogs'], function () {
        Route::get('/', [BlogController::class, 'index']);
        Route::get('/{id}', [BlogController::class, 'show']);
        Route::post('/', [BlogController::class, 'store']);
        Route::put('/{id}', [BlogController::class, 'update']);
        Route::delete('/{id}', [BlogController::class, 'destroy']);
    });
});
