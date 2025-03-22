<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\ArtistController;
use App\Http\Controllers\Admin\GenreController;
use App\Http\Controllers\Admin\PlaylistController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\SongController;
use App\Http\Controllers\Admin\TagController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Main\MainController;
use App\Http\Controllers\Personal\PersonalController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', [MainController::class, 'index'])->name('main.index');
Route::get('/top', [MainController::class, 'top'])->name('main.top');

Route::group(['prefix' => 'personal', 'middleware' => ['auth']], function () {
    Route::get('/', [PersonalController::class, 'index'])->name('personal.index');
});

Route::group(['prefix' => 'admin', 'middleware' => ['auth']], function () {
    Route::get('/', [AdminController::class, 'index'])->name('admin.main.index');

    Route::group(['middleware' => 'permission:Suggest|Add|Edit|Delete'], function () {

        // Checks if user can add anything
        Route::group(['middleware' => 'permission:Add|Suggest'], function() {
            Route::get('genres/create', [GenreController::class, 'create'])->name('admin.genre.create');
            Route::post('genres/', [GenreController::class, 'store'])->name('admin.genre.store');

            Route::get('tags/create', [TagController::class, 'create'])->name('admin.tag.create');
            Route::post('tags/', [TagController::class, 'store'])->name('admin.tag.store');

            Route::get('artists/create', [ArtistController::class, 'create'])->name('admin.artist.create');
            Route::post('artists/', [ArtistController::class, 'store'])->name('admin.artist.store');

            Route::get('songs/create', [SongController::class, 'create'])->name('admin.song.create');
            Route::post('songs/', [SongController::class, 'store'])->name('admin.song.store');

            Route::get('playlists/create', [PlaylistController::class, 'create'])->name('admin.playlist.create');
            Route::post('playlists/', [PlaylistController::class, 'store'])->name('admin.playlist.store');
        });

        // Basic routes for showing elements
        Route::group(['prefix' => 'genres'], function () {
            Route::get('/', [GenreController::class, 'index'])->name('admin.genre.index');
            Route::get('/{genre}', [GenreController::class, 'show'])->name('admin.genre.show');
        });

        Route::group(['prefix' => 'tags'], function () {
            Route::get('/', [TagController::class, 'index'])->name('admin.tag.index');
            Route::get('/{tag}', [TagController::class, 'show'])->name('admin.tag.show');
        });

        Route::group(['prefix' => 'artists'], function () {
            Route::get('/', [ArtistController::class, 'index'])->name('admin.artist.index');
            Route::get('/{artist}', [ArtistController::class, 'show'])->name('admin.artist.show');
        });

        Route::group(['prefix' => 'songs'], function () {
            Route::get('/', [SongController::class, 'index'])->name('admin.song.index');
            Route::get('/{song}', [SongController::class, 'show'])->name('admin.song.show');
        });

        Route::group(['prefix' => 'playlists'], function () {
            Route::get('/', [PlaylistController::class, 'index'])->name('admin.playlist.index');
            Route::get('/{song}', [PlaylistController::class, 'show'])->name('admin.playlist.show');
        });

        // Checks if user can edit anything
        Route::group(['middleware' => 'permission:Edit'], function() {
            Route::get('genres/{genre}/edit', [GenreController::class, 'edit'])->name('admin.genre.edit');
            Route::patch('genres/{genre}', [GenreController::class, 'update'])->name('admin.genre.update');

            Route::get('tags/{tag}/edit', [TagController::class, 'edit'])->name('admin.tag.edit');
            Route::patch('tags/{tag}', [TagController::class, 'update'])->name('admin.tag.update');

            Route::get('artists/{artist}/edit', [ArtistController::class, 'edit'])->name('admin.artist.edit');
            Route::patch('artists/{artist}', [ArtistController::class, 'update'])->name('admin.artist.update');

            Route::get('songs/{song}/edit', [SongController::class, 'edit'])->name('admin.song.edit');
            Route::patch('songs/{song}', [SongController::class, 'update'])->name('admin.song.update');

            Route::get('playlist/{playlist}/edit', [PlaylistController::class, 'edit'])->name('admin.playlist.edit');
            Route::patch('playlist/{playlist}', [PlaylistController::class, 'update'])->name('admin.playlist.update');
        });

        // Checks if user can delete anything
        Route::group(['middleware' => 'permission:Delete'], function () {
            Route::delete('genres/{genre}', [GenreController::class, 'destroy'])->name('admin.genre.destroy');
            Route::delete('tags/{tag}', [TagController::class, 'destroy'])->name('admin.tag.destroy');
            Route::delete('artists/{artist}', [ArtistController::class, 'destroy'])->name('admin.artist.destroy');
            Route::delete('songs/{song}', [SongController::class, 'destroy'])->name('admin.song.destroy');
            Route::delete('playlist/{playlist}', [PlaylistController::class, 'destroy'])->name('admin.playlist.destroy');
        });

    });

    Route::group(['middleware' => 'permission:Manage roles'], function() {

        Route::group(['prefix' => 'roles'], function () {
            Route::get('/', [RoleController::class, 'index'])->name('admin.role.index');
            Route::get('/create', [RoleController::class, 'create'])->name('admin.role.create');
            Route::post('/', [RoleController::class, 'store'])->name('admin.role.store');
            Route::get('/{role}', [RoleController::class, 'show'])->name('admin.role.show');
            Route::get('/{role}/edit', [RoleController::class, 'edit'])->name('admin.role.edit');
            Route::patch('/{role}', [RoleController::class, 'update'])->name('admin.role.update');
            Route::delete('/{role}', [RoleController::class, 'destroy'])->name('admin.role.destroy');
        });

        Route::group(['prefix' => 'users'], function () {
            Route::get('/', [UserController::class, 'index'])->name('admin.user.index');
            Route::get('/create', [UserController::class, 'create'])->name('admin.user.create');
            Route::post('/', [UserController::class, 'store'])->name('admin.user.store');
            Route::get('/{user}', [UserController::class, 'show'])->name('admin.user.show');
            Route::get('/{user}/edit', [UserController::class, 'edit'])->name('admin.user.edit');
            Route::patch('/{user}', [UserController::class, 'update'])->name('admin.user.update');
            Route::delete('/{user}', [UserController::class, 'destroy'])->name('admin.user.destroy');
        });
    });
});

Route::group(['middleware' => 'auth', 'prefix' => 'api'], function() {
    Route::get('/songs', [\App\Http\Controllers\Api\SongController::class, 'getLikedSongs']);
    Route::get('/playlists', [\App\Http\Controllers\Api\PlaylistController::class, 'index']);
    Route::get('/profile', [\App\Http\Controllers\Api\ProfileController::class, 'profilePage']);
    Route::get('/recommendations/songs', [\App\Http\Controllers\Api\RecommendationController::class, 'getSongsRecommendations']);
    Route::post('/songs/add-listened', [\App\Http\Controllers\Api\SongController::class, 'addListenedSong']);
    Route::post('/songs/toggle-like', [\App\Http\Controllers\Api\SongController::class, 'toggleLiked']);
    Route::post('/songs/generate-queue', [\App\Http\Controllers\Api\SongController::class, 'generateQueue']);
});

Auth::routes(['verify' => true]);
Route::any('{all}', function () {
    return view('app');
})->where('all', '.*');
