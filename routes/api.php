<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use Laravel\Passport\Http\Controllers\AccessTokenController;
use App\Http\Controllers\MemberController;

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
        // 'as' => 'passport.token',
        'middleware' => ['format-response-sign-in', 'add-data-response'],
    ]);

    Route::group(['middleware' => 'auth:member'], function () {
        Route::post('logout', [AuthController::class, 'logout']);
        Route::get('info', [AuthController::class, 'info']);
    });
});

Route::group(['prefix' => 'members'], function () {
    Route::get('/', [MemberController::class, 'index']);
});
