<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Artist;
use App\Models\Genre;
use App\Models\Song;
use App\Models\User;
use Illuminate\Http\Request;

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
            ->withCount(['plays', 'likes'])
            ->orderBy('tags_count', 'desc')
            ->limit(5)
            ->get();
        $recommendationsByArtists = Song::with('artist')
            ->withCount(['plays', 'likes'])
            ->inRandomOrder()
            ->whereIn('artist_id', $likedArtists)
            ->limit(5)
            ->get();
        $recommendationsByGenre = Song::with('artist')
            ->withCount(['plays', 'likes'])
            ->inRandomOrder()
            ->whereIn('genre_id', $likedGenres)
            ->limit(5)
            ->get();

        $collaborativeRecommendations = $this->getCollaborativeFiltering();

        $result = ['artists' => $recommendationsByArtists, 'genres' => $recommendationsByGenre, 'tags' => $songQuery, 'collaborative' => $collaborativeRecommendations];
        return response()->json($result);
    }

    public function getRelatedSongs(Song $song)
    {
        $songTags = $song->tags()->pluck('tags.id')->toArray();
        $genre = Song::with('artist')
            ->withCount(['plays', 'likes'])
            ->where('genre_id', $song->genre_id)
            ->limit(5)
            ->get();
        $artist = Song::with('artist')
            ->where('artist_id', $song->artist_id)
            ->withCount(['likes', 'plays'])
            ->orderBy('likes_count', 'desc')
            ->limit(5)
            ->get();
        $tags = Song::with('artist')
            ->where('id', '!=', $song->id)
            ->withCount(['tags' => function ($query) use ($songTags) {
                $query->whereIn('tags.id', $songTags);
            }])
            ->withCount(['plays', 'likes'])
            ->orderBy('tags_count', 'desc')
            ->limit(5)
            ->get();
        $result = ['artist' => $artist, 'genre' => $genre, 'tags' => $tags];
        return response()->json($result);
    }

    private function getCollaborativeFiltering()
    {
        $user = auth()->user();
        $likedSongs = $user->likedSongs()->get()->pluck('id')->toArray();
        $listenedSongs = $user->listenedSongs()->get()->pluck('id')->toArray();

        $similarUsers = User::where('id', '!=', $user->id)
            ->where(function ($query) use ($likedSongs, $listenedSongs) {
                $query->whereHas('likedSongs', function ($q) use ($likedSongs) {
                    $q->whereIn('song_id', $likedSongs);
                })
                    ->orWhereHas('listenedSongs', function ($q) use ($listenedSongs) {
                        $q->whereIn('song_id', $listenedSongs);
                    });
            })
            ->withCount([
                'likedSongs as liked_count' => function ($query) use ($likedSongs) {
                    $query->whereIn('song_id', $likedSongs);
                },
                'listenedSongs as listened_count' => function ($query) use ($listenedSongs) {
                    $query->whereIn('song_id', $listenedSongs);
                }
            ])
            ->get()
            ->map(function ($user) {
                $user->similarity = ($user->liked_count * 5) + $user->listened_count;
                return $user;
            })
            ->sortByDesc('similarity')
            ->take(5)
            ->pluck('id')
            ->toArray();

        $recommendedSongs = Song::with('artist')->whereHas('likes', function ($query) use ($similarUsers) {
            $query->whereIn('user_id', $similarUsers);
        })
            ->whereNotIn('id', $likedSongs)
            ->withCount(['likes as similar_likes' => function ($query) use ($similarUsers) {
                $query->whereIn('user_id', $similarUsers);
            }])
            ->withCount(['likes', 'plays'])
            ->orderByDesc('similar_likes')
            ->take(5)
            ->get();
        return $recommendedSongs;
    }
}
