<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Song\StoreRequest;
use App\Http\Requests\Admin\Song\UpdateRequest;
use App\Models\Artist;
use App\Models\Genre;
use App\Models\Song;
use App\Models\Tag;
use App\Service\SongService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class SongController extends Controller
{
    protected SongService $service;
    public function __construct(SongService $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        $songs = Song::with('artist')->get();
        return response()->json($songs);
    }

    public function single(Song $song) {
        dd($song);
        return response()->json($song);
    }

    public function getLikedSongs() {
        $user = auth()->user();
        $songs = Song::with('artist')->get()->map(function ($song) use ($user) {
            $song->is_liked = $user ? $user->likedSongs()->where('song_id', $song->id)->exists() : false;
            return $song;
        });
        return response()->json($songs);
    }

    public function toggleLiked(Request $request) {
        $user = auth()->user();
        $songId = $request->songId;
        if(!$songId || !$user) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        if($user->likedSongs()->where('song_id', $songId)->exists()) {
            $user->likedSongs()->detach($songId);
            return response()->json(['status' => 'success', 'liked' => false]);
        } else {
            $user->likedSongs()->attach($songId);
            return response()->json(['status' => 'success', 'liked' => true]);
        }
    }

    public function addListenedSong(Request $request) {
        $user = auth()->user();
        $songId = $request->songId;
        if(!$songId || !$user) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }
        if($user->listenedSongs()->where('song_id', $songId)->exists()) {
            return response()->json(['status' => 'error', 'listened' => false, 'error' => 'User already listened song with id ' . $songId]);
        } else {
            $user->listenedSongs()->attach($songId);
            return response()->json(['status' => 'success', 'listened' => true]);
        }
    }
}
