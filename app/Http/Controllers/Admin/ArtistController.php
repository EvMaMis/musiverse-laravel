<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Artist\StoreRequest;
use App\Http\Requests\Admin\Artist\UpdateRequest;
use App\Models\Artist;
use Illuminate\Http\Request;

class ArtistController extends Controller
{
    public function index() {
        $artists = Artist::all();
        return view('admin.artist.index', compact('artists'));
    }

    public function create() {
        return view('admin.artist.create');
    }

    public function store(StoreRequest $request) {
        $data = $request->validated();
        Artist::firstOrCreate(['name' => $data['name']], $data);
        return redirect()->route('admin.artist.index');
    }

    public function show(Artist $artist){
        return view('admin.artist.show', compact('artist'));
    }

    public function edit(Artist $artist) {
        return view('admin.artist.edit', compact('artist'));
    }

    public function update(UpdateRequest $request, Artist $artist) {
        $data = $request->validated();
        $artist->update($data);
        return redirect()->route('admin.artist.index');
    }

    public function destroy(Artist $artist) {
        $artist->delete();
        return redirect()->route('admin.artist.index');
    }
}
