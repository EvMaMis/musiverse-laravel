<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Genre\UpdateRequest;
use App\Http\Requests\Admin\Tag\StoreRequest;
use App\Models\Artist;
use App\Models\Genre;
use App\Models\Song;
use App\Models\Tag;

class SongController extends Controller
{
    public function index() {
        $songs = Song::all();
        return view('admin.song.index', compact('songs'));
    }

    public function create() {
        $tags = Tag::all();
        $genres = Genre::all();
        $artists = Artist::all();
        return view('admin.song.create', compact('tags', 'genres', 'artists'));
    }

    public function store(\App\Http\Requests\Admin\Song\StoreRequest $request) {
        $data = $request->validated();
        Song::firstOrCreate($data);
        return redirect()->route('admin.song.index');

    }
}
