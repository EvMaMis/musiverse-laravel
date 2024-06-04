<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Playlist\StoreRequest;
use App\Http\Requests\Admin\Playlist\UpdateRequest;
use App\Models\Artist;
use App\Models\Genre;
use App\Models\Playlist;
use App\Models\Song;
use App\Models\Tag;
use App\Service\PlaylistService;
use Illuminate\Support\Facades\Storage;

class PlaylistController extends Controller
{

    protected PlaylistService $service;
    public function __construct(PlaylistService $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        $playlists = Playlist::all();
        return view('admin.playlist.index', compact('playlists'));
    }

    public function create()
    {
        $songs = Song::with('artist')->get();
        return view('admin.playlist.create', compact('songs'));
    }

    public function store(StoreRequest $request)
    {
        $data = $request->validated();
        $this->service->store($data);
        return redirect()->route('admin.playlist.index');
    }
}
