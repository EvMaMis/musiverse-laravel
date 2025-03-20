<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Song;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function profilePage() {
        $user = Auth::user();
        if(!$user) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
        $timezone = $user->timezone ?? config('app.timezone');
        $likedSongs = $user->likedSongs()->with('artist')->get()->map(function ($song) use ($timezone) {
            $song->is_liked = true;
            $song->timestamp = Carbon::parse($song->pivot->created_at)
                ->timezone($timezone)
                ->translatedFormat('d F Y H:i:s');
            return $song;
        });

        $listenedSongs = $user->listenedSongs()->with('artist')->get()->map(function ($song) use ($timezone) {
            $song->timestamp = Carbon::parse($song->pivot->created_at)
                ->timezone($timezone)
                ->translatedFormat('d F Y H:i:s');
            return $song;
        });

        return response()->json(['likes' => $likedSongs, 'listened' => $listenedSongs]);
    }
}
