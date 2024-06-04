<?php

namespace App\Http\Controllers;

use App\Models\Playlist;
use App\Models\Song;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PlaylistController extends Controller
{
    public function index()
    {
        $playlists = Auth::user()->playlists;
        return view('playlists.index', compact('playlists'));
    }

    public function create()
    {
        return view('playlists.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $playlist = Auth::user()->playlists()->create([
            'name' => $request->name,
        ]);

        return redirect()->route('playlists.index');
    }

    public function show(Playlist $playlist)
    {
        $this->authorize('view', $playlist);
        return view('playlists.show', compact('playlist'));
    }

    public function edit(Playlist $playlist)
    {
        $this->authorize('update', $playlist);
        return view('playlists.edit', compact('playlist'));
    }

    public function update(Request $request, Playlist $playlist)
    {
        $this->authorize('update', $playlist);

        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $playlist->update([
            'name' => $request->name,
        ]);

        return redirect()->route('playlists.index');
    }

    public function destroy(Playlist $playlist)
    {
        $this->authorize('delete', $playlist);
        $playlist->delete();

        return redirect()->route('playlists.index');
    }

    public function addSong(Request $request, Playlist $playlist)
    {
        $this->authorize('update', $playlist);

        $request->validate([
            'song_id' => 'required|exists:songs,id',
        ]);
        $playlist->songs()->attach($request->song_id);

        return redirect()->route('playlists.show', $playlist);
    }

    public function removeSong(Playlist $playlist, Song $song)
    {
        $this->authorize('update', $playlist);
        $playlist->songs()->detach($song->id);

        return redirect()->route('playlists.show', $playlist);
    }
}
