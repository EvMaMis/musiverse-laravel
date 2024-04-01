<?php

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MainController extends Controller
{
    public function index() {
        if(auth()->user())
            return view('main.posts');
        return view('main.offer');
    }
}
