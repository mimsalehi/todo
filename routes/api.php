<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\TodoController;
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
Route::controller(AuthController::class)->group(function () {
    Route::post('register', 'register')->name('user.register');
    Route::post('login', 'login')->name('user.login');
});


Route::middleware('auth:sanctum')->group(function () {
    Route::controller(TodoController::class)->prefix('todos')->group(function () {
        Route::get('/', 'index');
        Route::post('/store', 'store');
        Route::patch('/update/{todo}', 'update');
    });
});


