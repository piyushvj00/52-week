<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\BaseController;
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
Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/banners', [BaseController::class, 'banners']);
    Route::get('/news', [BaseController::class, 'news']);
    Route::get('/advertisement', [BaseController::class, 'advertisement']);
    Route::get('/language', [BaseController::class, 'language']);
});

