<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Genre;
use Illuminate\Http\Request;

class GenreController extends Controller
{
    public function index() {
        $items = Genre::all();
        return view('admin.genre.index', $items);
    }

    public function create() {
        return view('admin.genre.create');
    }

    public function store(Genre $item) {
        Genre::firstOrCreate($item);
        return redirect()->route('admin.genre.index');
    }
}
