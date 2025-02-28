<?php

namespace Database\Factories;

use App\Models\Genre;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Genre>
 */
class GenreFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Genre::class;
    public function definition(): array
    {
        return [
            'title' => $this->faker->unique()->randomElement(['Synthwave', 'Grime', 'Dream Pop', 'Krautrock', 'Ska',
                'Death Metal', 'Chillwave', 'Bossa Nova', 'Reggaeton', 'Trip Hop', 'Gospel', 'Hardcore Punk',
                'J-Pop', 'New Wave', 'Blues Rock', 'Ambient', 'Dubstep', 'Indie Folk', 'Classical Crossover', 'Funk',
                'Progressive House', 'Shoegaze', 'Country Blues', 'Techno', 'Cumbia', 'Garage Rock', 'Opera',
                'Lo-fi Hip Hop', 'Power Pop', 'Celtic Punk']),
        ];
    }
}
