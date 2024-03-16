<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Genre\StoreRequest;
use App\Models\Genre;
use Illuminate\Http\Request;

class GenreController extends Controller
{
    public function index() {
        $items = Genre::all();
        return view('admin.genre.index', compact('items'));
    }

    public function create() {
        return view('admin.genre.create');
    }

    public function store(StoreRequest $request) {
        $data = $request->validated();
        Genre::firstOrCreate($data);
        return redirect()->route('admin.genre.index');
    }

    public function destroy($item) {
        dd($item);
        $item->delete();
        return redirect()->route('admin.genre.index');
    }
}
