<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/songs', [\App\Http\Controllers\Api\SongController::class, 'index']);
Route::get('/playlists', [\App\Http\Controllers\Api\PlaylistController::class, 'index']);
