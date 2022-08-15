<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ChatController;
use App\Http\Controllers\Api\MessageController;
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

Route::middleware('auth.jwt')->get('/user', function (Request $request) {
    return $request->user();
});
Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);
Route::group(['middleware' => ['auth.jwt']], function () {
    Route::post('logout', [AuthController::class, 'logout']);
    Route::get('me', [AuthController::class, 'getUser']);

    // messages
    Route::group(['prefix' => 'message'], function () {
        Route::get('/', [MessageController::class, 'index']);
        Route::post('/read-message/{id}', [MessageController::class, 'readMessage'])->where('id', '[0-9]+');
    });
    // end messages

    // chat
     Route::group(['prefix' => 'chat'], function () {
        Route::get('/list', [ChatController::class, 'chatList']);
        Route::get('/', [ChatController::class, 'index']);
        Route::post('/store/{id}', [ChatController::class, 'store'])->where('id', '[0-9]+');
    });
    // end chat
});
