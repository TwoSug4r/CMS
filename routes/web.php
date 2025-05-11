<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/admin', function(){
    return view('admin.index');
})->middleware('admin');

Route::resource('/admin/pages', \App\Http\Controllers\Admin\PagesController::class,['except' => [
    'show',
]]);

Route::resource('/admin/users', \App\Http\Controllers\Admin\UsersController::class,['except' => [
    'show',
    'create',
    'store'
]]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
