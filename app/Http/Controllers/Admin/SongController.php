<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Genre\UpdateRequest;
use App\Http\Requests\Admin\Tag\StoreRequest;
use App\Models\Song;
use App\Models\Tag;

class SongController extends Controller
{
    public function index() {
        $songs = Song::all();
        return view('admin.song.index', compact('songs'));
    }
}
