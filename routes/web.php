<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

//Admin
Route::get('/admin', function(){
    return view('admin.index');
})->middleware('admin')->name('admin');

//Pages
Route::resource('/admin/pages', \App\Http\Controllers\Admin\PagesController::class,['except' => [
    'show',
]]);

foreach(\App\Models\Page::all() as $page){
    Route::view($page->url, 'home.page', ['page' => $page]);
}

Route::resource('/admin/blog', \App\Http\Controllers\Admin\BlogController::class,['except' => [
    'show',
]]);

Route::get('/blog', [\App\Http\Controllers\BlogPostController::class, 'index'])->name('blog');
Route::get('/blog/{slug}', [\App\Http\Controllers\BlogPostController::class, 'view'])->name('blog.view');

Route::resource('/admin/users', \App\Http\Controllers\Admin\UsersController::class,['except' => [
    'show',
    'create',
    'store'
]]);
