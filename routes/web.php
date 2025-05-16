<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;

Route::get('/', [App\Http\Controllers\HomeController::class, 'index']);

Auth::routes();

Route::get('/admin', function(){
    return view('admin.index');
})->middleware('admin');

Route::resource('/admin/pages', \App\Http\Controllers\Admin\PagesController::class,['except' => [
    'show',
]]);

Route::resource('/admin/blog', \App\Http\Controllers\Admin\BlogController::class,['except' => [
    'show',
]]);

Route::resource('/admin/users', \App\Http\Controllers\Admin\UsersController::class,['except' => [
    'show',
    'create',
    'store'
]]);
