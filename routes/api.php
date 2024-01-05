<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\KostController;

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

Route::middleware('auth:sanctum')->group(function () {
    Route::delete('/kosts', [KostController::class, 'destroy']);
});

Route::get('/dashboard', [HomeController::class, 'index'])->name('dashboard');
Route::post('/register', [HomeController::class, 'register'])->name('register');
Route::post('/login', [HomeController::class, 'login'])->name('login.api');

Route::get('/kost', [KostController::class, 'index']);
Route::post('/kosts', [KostController::class, 'store']);
Route::put('/kosts/{id}', [KostController::class, 'update']);

