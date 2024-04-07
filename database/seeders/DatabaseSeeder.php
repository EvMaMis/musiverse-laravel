<?php

namespace Database\Seeders;

use App\Models\Artist;
use App\Models\Genre;
use App\Models\Tag;
use Illuminate\Database\Seeder;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        Tag::factory(20)->create();
        Genre::factory(10)->create();
        Artist::factory(15)->create();
    }
}
