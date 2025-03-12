<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Song;

class RecommendationController extends Controller
{
    public function index()
    {
        dd('Recommendation controller index');
    }

    public function getSongsRecommendations()
    {
        $user = auth()->user();
        $likedSongs = $user->likedSongs()->with('tags');
        $likedArtists = $likedSongs->get()->pluck('artist_id')->toArray();
        $likedGenres = $likedSongs->get()->pluck('genre_id')->toArray();
        $likedTags = $likedSongs->get()->pluck('tags')->flatten()->unique('id')->pluck('id')->toArray();
        $songQuery = Song::with('artist')->whereHas('tags', function ($query) use ($likedTags) {
            $query->whereIn('tags.id', $likedTags);
        })
            ->withCount(['tags as tags_count' => function ($query) use ($likedTags) {
                $query->whereIn('tags.id', $likedTags);
            }])
            ->orderBy('tags_count', 'desc')
            ->limit(10)
            ->get();

        return response()->json($songQuery);

    }
}
