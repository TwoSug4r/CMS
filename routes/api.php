<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\BlogController;
use App\Http\Controllers\Api\UserController;

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', function (Request $request) {
        return $request->user(); // Возвращает данные авторизованного пользователя
    });

    // Добавьте здесь свои маршруты, например, для работы с контентом CMS
    Route::apiResource('/posts', BlogController::class);
});

Route::post('/register', [UserController::class, 'store']);