<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Genre;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index() {
        $genresWithSongs = Genre::all();
        phpinfo();
        dd($genresWithSongs[1]->songs);
        return view('admin.admin');
    }
}
