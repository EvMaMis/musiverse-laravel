<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Artist;
use App\Models\Genre;
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
            ->limit(5)
            ->get();
        $recommendationsByArtists = Song::with('artist')->inRandomOrder()->whereIn('artist_id', $likedArtists)->limit(5)->get();
        $recommendationsByGenre = Song::with('artist')->inRandomOrder()->whereIn('genre_id', $likedGenres)->limit(5)->get();
        $result = ['artists' => $recommendationsByArtists, 'genres' => $recommendationsByGenre, 'tags' => $songQuery];
        return response()->json($result);

    }
}
