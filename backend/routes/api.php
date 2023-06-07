<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\MessageController;
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

Route::middleware(['api'])->prefix('auth')->group(function(){
    Route::post('login', [AuthController::class, 'login'])->name('login');
    Route::post('logout', [AuthController::class, 'logout'])->name('logout');
    Route::post('register', [AuthController::class, 'register'])->name('register');
});

Route::middleware(['auth.jwt'])->namespace('Api')->group(function() {
    Route::put('update', [AuthController::class, 'update'])->name('user-update');
    Route::get('get-user', [AuthController::class, 'getInfoUser'])->name('get-user');
    Route::post('change-room', [MessageController::class, 'changeRoom'])->name('change-room');
    Route::post('send-message', [MessageController::class, 'sendMessage'])->name('send-message');
});
