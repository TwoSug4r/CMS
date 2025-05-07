<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/admin', function(){
    return 'you are admin, editor, author';
})->middleware('admin');

Route::resource('/admin/pages', 'App\Http\Controllers\Admin\PagesController')->middleware('admin');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
