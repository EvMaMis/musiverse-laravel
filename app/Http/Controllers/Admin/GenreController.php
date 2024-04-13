<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Genre\StoreRequest;
use App\Http\Requests\Admin\Genre\UpdateRequest;
use App\Models\Genre;

class GenreController extends Controller
{
    public function index() {
        $genres = Genre::withCount('songs')->get();
        return view('admin.genre.index', compact('genres'));
    }

    public function create() {
        return view('admin.genre.create');
    }

    public function store(StoreRequest $request) {
        $data = $request->validated();
        Genre::firstOrCreate($data);
        return redirect()->route('admin.genre.index');
    }

    public function show(Genre $genre) {
        return view('admin.genre.show', compact('genre'));
    }

    public function edit(Genre $genre) {
        return view('admin.genre.edit', compact('genre'));
    }

    public function update(UpdateRequest $request, Genre $genre) {
        $data = $request->validated();
        $genre->update($data);
        return redirect()->route('admin.genre.index');
    }


    public function destroy(Genre $genre) {
        $genre->delete();
        return redirect()->route('admin.genre.index');
    }
}
