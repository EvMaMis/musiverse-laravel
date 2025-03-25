<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Song\StoreRequest;
use App\Http\Requests\Admin\Song\UpdateRequest;
use App\Models\Artist;
use App\Models\Genre;
use App\Models\Song;
use App\Models\Tag;
use App\Models\User;
use App\Service\SongService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ArtistController extends Controller
{
    public function getSingleArtist(Artist $artist) {
        $artist->load('songs.artist');
        $artist->likes = $artist->likes();
        $artist->subscribers_count = $artist->subscriptions()->count();
        $artist->plays = $artist->plays();
        return response()->json($artist);
    }

    public function handleSubscribe(Request $request) {
        $user = auth()->user();
        $artistId = $request->artist;

        if(!$artistId || !$user) {
            return response()->json(['error' => 'unauthorized'], 403);
        }

        if($user->subscriptions()->where('artist_id', $artistId)->exists()) {
            $user->subscriptions()->detach($artistId);
            return response()->json(['success' => true, 'subscribed' => false]);
        } else {
            $user->subscriptions()->attach($artistId);
            return response()->json(['success' => true, 'subscribed' => true]);
        }
    }
}
