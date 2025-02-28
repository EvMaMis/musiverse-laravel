<?php

namespace Database\Factories;

use App\Models\Tag;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Tag>
 */
class TagFactory extends Factory
{
    protected $model = Tag::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->unique()->randomElement(['Energetic', 'Chill', 'Upbeat', 'Melancholic', 'Driving', 'Ambient', 'Funky', 'Heavy', 'Mellow', 'Groovy', 'Intense', 'Relaxing', 'Danceable', 'Acoustic', 'Electronic', 'Distorted', 'Smooth', 'Raw', 'Catchy', 'Dreamy', 'Experimental', 'Retro', 'Futuristic', 'Orchestral', 'Vocal', 'Instrumental', 'Bass-heavy', 'Percussive', 'Harmonic', 'Lo-fi', 'High-energy', 'Soulful', 'Poppy', 'Rocking', 'Hypnotic', 'Dark', 'Bright', 'Warm', 'Cold', 'Spacious', 'Dense', 'Layered', 'Minimalist', 'Maximalist', 'Epic', 'Intimate', 'Nostalgic', 'Progressive', 'Simple', 'Complex']),
        ];
    }
}
