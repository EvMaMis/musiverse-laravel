<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Song\StoreRequest;
use App\Models\Artist;
use App\Models\Genre;
use App\Models\Song;
use App\Models\Tag;
use Illuminate\Support\Facades\Storage;

class SongController extends Controller
{
    public function index() {
        $songs = Song::all();
        return view('admin.song.index', compact('songs'));
    }

    public function create() {
        $tags = Tag::orderBy('title', 'ASC')->get();
        $genres = Genre::orderBy('title', 'ASC')->get();
        $artists = Artist::orderBy('name', 'ASC')->get();
        return view('admin.song.create', compact('tags', 'genres', 'artists'));
    }

    public function store(StoreRequest $request) {
        $data = $request->validated();
        $data['image'] = Storage::disk('public')->put('/covers', $data['cover']);
        $data['file'] = Storage::disk('public')->put('/music', $data['file']);
        if(isset($data['tags'])) {
            $tags = $data['tags'];
            unset($data['tags']);
        }
        $song = Song::create($data);
        if(isset($tags))
            $song->tags()->attach($tags);

        return redirect()->route('admin.song.index');

}
}
