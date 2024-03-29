<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\ArtistController;
use App\Http\Controllers\Admin\GenreController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\SongController;
use App\Http\Controllers\Admin\TagController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Main\MainController;
use Illuminate\Support\Facades\Route;

Route::get('/', [MainController::class, 'index']);
Route::group(['prefix' => 'admin'], function() {
    Route::get('/', [AdminController::class, 'index'])->name('admin.main.index');

    Route::group(['prefix' => 'genres'], function() {
        Route::get('/', [GenreController::class, 'index'])->name('admin.genre.index');
        Route::get('/create', [GenreController::class, 'create'])->name('admin.genre.create');
        Route::post('/', [GenreController::class, 'store'])->name('admin.genre.store');
        Route::get('/{genre}', [GenreController::class, 'show'])->name('admin.genre.show');
        Route::get('/{genre}/edit', [GenreController::class, 'edit'])->name('admin.genre.edit');
        Route::patch('/{genre}', [GenreController::class, 'update'])->name('admin.genre.update');
        Route::delete('/{genre}', [GenreController::class, 'destroy'])->name('admin.genre.destroy');
    });

    Route::group(['prefix' => 'tags'], function() {
        Route::get('/', [TagController::class, 'index'])->name('admin.tag.index');
        Route::get('/create', [TagController::class, 'create'])->name('admin.tag.create');
        Route::post('/', [TagController::class, 'store'])->name('admin.tag.store');
        Route::get('/{tag}', [TagController::class, 'show'])->name('admin.tag.show');
        Route::get('/{tag}/edit', [TagController::class, 'edit'])->name('admin.tag.edit');
        Route::patch('/{tag}', [TagController::class, 'update'])->name('admin.tag.update');
        Route::delete('/{tag}', [TagController::class, 'destroy'])->name('admin.tag.destroy');
    });

    Route::group(['prefix' => 'artists'], function() {
        Route::get('/', [ArtistController::class, 'index'])->name('admin.artist.index');
        Route::get('/create', [ArtistController::class, 'create'])->name('admin.artist.create');
        Route::post('/', [ArtistController::class, 'store'])->name('admin.artist.store');
        Route::get('/{artist}', [ArtistController::class, 'show'])->name('admin.artist.show');
        Route::get('/{artist}/edit', [ArtistController::class, 'edit'])->name('admin.artist.edit');
        Route::patch('/{artist}', [ArtistController::class, 'update'])->name('admin.artist.update');
        Route::delete('/{artist}', [ArtistController::class, 'destroy'])->name('admin.artist.destroy');
    });

    Route::group(['prefix' => 'songs'], function() {
        Route::get('/', [SongController::class, 'index'])->name('admin.song.index');
        Route::get('/create', [SongController::class, 'create'])->name('admin.song.create');
        Route::post('/', [SongController::class, 'store'])->name('admin.song.store');
        Route::get('/{song}', [SongController::class, 'show'])->name('admin.song.show');
        Route::get('/{song}/edit', [SongController::class, 'edit'])->name('admin.song.edit');
        Route::patch('/{song}', [SongController::class, 'update'])->name('admin.song.update');
        Route::delete('/{song}', [SongController::class, 'destroy'])->name('admin.song.destroy');
    });

    Route::group(['prefix' => 'roles'], function() {
        Route::get('/', [RoleController::class, 'index'])->name('admin.role.index');
        Route::get('/create', [RoleController::class, 'create'])->name('admin.role.create');
        Route::post('/', [RoleController::class, 'store'])->name('admin.role.store');
        Route::get('/{role}', [RoleController::class, 'show'])->name('admin.role.show');
        Route::get('/{role}/edit', [RoleController::class, 'edit'])->name('admin.role.edit');
        Route::patch('/{role}', [RoleController::class, 'update'])->name('admin.role.update');
        Route::delete('/{role}', [RoleController::class, 'destroy'])->name('admin.role.destroy');
    });

    Route::group(['prefix' => 'users'], function() {
        Route::get('/', [UserController::class, 'index'])->name('admin.user.index');
        Route::get('/create', [UserController::class, 'create'])->name('admin.user.create');
        Route::post('/', [UserController::class, 'store'])->name('admin.user.store');
        Route::get('/{user}', [UserController::class, 'show'])->name('admin.user.show');
        Route::get('/{user}/edit', [UserController::class, 'edit'])->name('admin.user.edit');
        Route::patch('/{user}', [UserController::class, 'update'])->name('admin.user.update');
        Route::delete('/{user}', [UserController::class, 'destroy'])->name('admin.user.destroy');
    });
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
