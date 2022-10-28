<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use Laravel\Passport\Http\Controllers\AccessTokenController;

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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

// Route::group(['prefix' => 'auth'], function () {
//     Route::post('login', [AuthController::class, 'login']);
//     Route::post('signup', [AuthController::class, 'signup']);

//     Route::group(['middleware' => 'auth:api'], function () {
//         Route::get('logout', [AuthController::class, 'logout']);
//         Route::get('user', [AuthController::class, 'user']);
//     });
// });

Route::group(['prefix' => 'auth'], function () {
    Route::post('login', [
        'uses' => AccessTokenController::class.'@issueToken',
        // 'as' => 'passport.token',
        'middleware' => ['format-response-sign-in', 'add-data-response'],
    ]);
    Route::middleware(['auth:member'])->post('logout', [AuthController::class, 'logout']);
});
