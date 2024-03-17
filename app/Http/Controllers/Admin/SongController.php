<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Song;
use Illuminate\Http\Request;

class SongController extends Controller
{
    public function index() {
        $songs = Song::all();
        return view('admin.song.index', compact('songs'));
    }
}
