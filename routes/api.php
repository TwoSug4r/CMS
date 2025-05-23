<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\PostController;
use App\Http\Controllers\Api\UserController;

Route::middleware('auth:sanctum')->group(function () {
    //profile
    Route::get('/profile', [UserController::class, 'show']);

    // Добавьте здесь свои маршруты, например, для работы с контентом CMS
    Route::apiResource('/posts', PostController::class);
});

Route::post('/register', [UserController::class, 'store']);