<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\GenreController;
use App\Http\Controllers\Main\MainController;
use Illuminate\Support\Facades\Route;

Route::get('/', [MainController::class, 'index']);
Route::group(['prefix' => 'admin/'], function() {
    Route::get('/', [AdminController::class, 'index'])->name('admin.main.index');
    Route::group(['prefix' => 'genres'], function() {
        Route::get('/', [GenreController::class, 'index'])->name('admin.genre.index');
        Route::get('/create', [GenreController::class, 'create'])->name('admin.genre.create');
        Route::post('/', [GenreController::class, 'store'])->name('admin.genre.store');
    });
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
