<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Playlist;
use App\Models\Song;

class PlaylistController extends Controller
{
    public function index()
    {
        $playlists = Playlist::with(['songs.artist'])->get();
        return response()->json($playlists);
    }
}
