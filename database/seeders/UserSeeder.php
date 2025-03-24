<?php

namespace Database\Seeders;

use App\Models\Song;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();
        for($i = 0; $i < 1000; $i++){
            $user = User::create([
                'name' => $faker->name,
                'email' => $faker->unique()->email,
                'password' => Hash::make('password' . $i)
            ]);
            $songs = Song::inRandomOrder()->limit(rand(5, 30))->get();
            $user->listenedSongs()->attach($songs);
            $songs = Song::inRandomOrder()->limit(rand(2, 10))->get();
            $user->likedSongs()->attach($songs);
        }
    }
}
