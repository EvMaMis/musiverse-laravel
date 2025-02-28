<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Artist>
 */
class ArtistFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->unique()->randomElement(['The Beatles', 'Beyoncé', 'Radiohead', 'Kendrick Lamar',
                'Fleetwood Mac', 'David Bowie', 'Taylor Swift', 'Queen', 'Michael Jackson', 'Björk', 'Led Zeppelin',
                'Aretha Franklin', 'Prince', 'Stevie Wonder', 'Nirvana', 'Billie Eilish', 'The Rolling Stones',
                'Kate Bush', 'Drake', 'ABBA', 'Pink Floyd', 'Elton John', 'Rihanna', 'AC/DC', 'Lady Gaga', 'Bob Marley',
                'Adele', 'Metallica', 'Madonna', 'Kanye West', 'Daft Punk', 'Whitney Houston', 'Red Hot Chili Peppers',
                'Ariana Grande', 'U2', 'Celine Dion', 'Eminem', 'Spice Girls', 'The Cure', 'Justin Bieber', 'Coldplay',
                'Jimi Hendrix', 'Mariah Carey', 'Jay-Z', 'Destiny\'s Child', 'Oasis', 'Bruce Springsteen', 'Cher',
                'Gorillaz', 'Linkin Park', 'Black Sabbath']),
            'description' => $this->faker->text(100),
        ];
    }
}
