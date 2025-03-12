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

    public function create()
    {
        $tags = Tag::orderBy('title', 'ASC')->get();
        $genres = Genre::orderBy('title', 'ASC')->get();
        $artists = Artist::orderBy('name', 'ASC')->get();
        return view('admin.song.create', compact('tags', 'genres', 'artists'));
    }

    public function store(StoreRequest $request)
    {
        $data = $request->validated();
        $this->service->store($data);
        return redirect()->route('admin.song.index');
    }

    public function show(Song $song) {
        return view('admin.song.show', compact('song'));
    }

    public function edit(Song $song) {
        $tags = Tag::orderBy('title', 'ASC')->get();
        $genres = Genre::orderBy('title', 'ASC')->get();
        $artists = Artist::orderBy('name', 'ASC')->get();
        return view('admin.song.edit', compact('song', 'tags', 'genres', 'artists'));
    }

    public function update(UpdateRequest $request, Song $song) {
        $data = $request->validated();
        $this->service->update($song, $data);

        return redirect()->route('admin.song.index');
    }

    public function destroy(Song $song) {
        Storage::disk('public')->delete($song->image);
        Storage::disk('public')->delete($song->file);
        $song->tags()->detach();
        $song->delete();
        return redirect()->route('admin.song.index');
    }
}
