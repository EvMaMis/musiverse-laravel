<?php

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
use App\Models\Song;
use Illuminate\Http\Request;

class MainController extends Controller
{
    public function index() {
        $songs = Song::all();
        if(auth()->user())
            return view('main.songs', compact('songs'));
        return view('main.offer');
    }

    public function top() {
        dd('top');
    }
}
