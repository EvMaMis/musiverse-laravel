<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Song\StoreRequest;
use App\Http\Requests\Admin\Song\UpdateRequest;
use App\Models\Artist;
use App\Models\Genre;
use App\Models\Song;
use App\Models\Tag;
use App\Service\SongService;
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
        return view('admin.song.index', compact('songs'));
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
        if(isset($data['cover'])) {
            Storage::disk('public')->delete($song->image);
            $data['image'] = Storage::disk('public')->put('/covers', $data['cover']);
        }
        if(isset($data['file'])){
            Storage::disk('public')->delete($song->file);
            $data['file'] = Storage::disk('public')->put('/music', $data['file']);
        }
        $tagIds = $data['tags'];
        unset($data['tags']);

        $song->update($data);
        $song->tags()->sync($tagIds);

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
