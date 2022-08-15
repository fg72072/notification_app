<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\GroupController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\ParticipantController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/clear', function () {
    \Artisan::call('optimize:clear'); 
});

Auth::routes();

Route::group(['prefix' => '', 'middleware' => ['auth']], function () {

    Route::get('/', [HomeController::class, 'index'])->name('home');
    // groups 
    Route::group(['prefix' => 'group'], function () {
        Route::get('/', [GroupController::class, 'index']);
        Route::get('/create', [GroupController::class, 'create']);
        Route::post('/store', [GroupController::class, 'store'])->name('group.store');
        Route::get('/edit/{slug}', [GroupController::class, 'edit']);
        Route::post('/update/{slug}', [GroupController::class, 'update']);
        Route::post('/destroy/{slug}', [GroupController::class, 'destroy']);
    });
    // end groups 

    // participants
    Route::group(['prefix' => 'participant'], function () {
        Route::post('/store', [ParticipantController::class, 'store'])->name('member.store');
        Route::post('/destroy/{id}', [ParticipantController::class, 'destroy'])->where('id', '[0-9]+');
    });
    // end participants

    // messages
    Route::group(['prefix' => 'message'], function () {
        Route::post('/store/{id}', [MessageController::class, 'store']);
        Route::get('/{id}', [MessageController::class, 'show'])->where('id', '[0-9]+');
    });
    // end messages

    // notifications
    Route::group(['prefix' => 'notification'], function () {
        Route::get('/', [MessageController::class, 'index']);
        Route::post('/destroy/{id}', [MessageController::class, 'destroy'])->where('id', '[0-9]+');
        Route::get('/all', [MessageController::class, 'getUnreadMessage']);
    });
    // end notifications

    // users 
    Route::group(['prefix' => 'user'], function () {
        Route::get('/', [UserController::class, 'index']);
        Route::get('/create', [UserController::class, 'create']);
        Route::post('/store', [UserController::class, 'store'])->name('user.store');
        Route::get('/edit/{id}', [UserController::class, 'edit'])->where('id', '[0-9]+');
        Route::post('/update/{id}', [UserController::class, 'update'])->where('id', '[0-9]+');
        Route::post('/change-password', [UserController::class, 'changePassword']);
    });
    // end users 
});
