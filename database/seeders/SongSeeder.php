<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Song;
use App\Models\Artist;
use App\Models\Genre;
use App\Models\Tag;
use Illuminate\Support\Facades\Storage;
use Faker\Factory as Faker;

class SongSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        // Убедимся, что директории существуют
        if (!Storage::disk('public')->exists('covers')) {
            Storage::disk('public')->makeDirectory('covers');
        }
        if (!Storage::disk('public')->exists('music')) {
            Storage::disk('public')->makeDirectory('music');
        }

        for ($i = 0; $i < 100; $i++) {
            $song = Song::create([
                'title' => $faker->sentence(3),
                'artist_id' => Artist::all()->random()->id,
                'genre_id' => Genre::all()->random()->id,
                'image' => 'covers/default.jpg',
                'file' => 'music/default.mp3',
            ]);
            $tags = Tag::inRandomOrder()->limit(rand(3,7))->get();
            $song->tags()->attach($tags);
        }
    }
}

