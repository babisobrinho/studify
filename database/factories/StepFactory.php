<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class StepFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $contentTypes = ['video', 'article', 'podcast', 'course', 'exercise'];
        $type = $this->faker->randomElement($contentTypes);

        $urls = [
            'video' => 'https://www.youtube.com/watch?v='.$this->faker->regexify('[A-Za-z0-9]{11}'),
            'article' => 'https://medium.com/'.$this->faker->slug,
            'podcast' => 'https://open.spotify.com/episode/'.$this->faker->regexify('[A-Za-z0-9]{22}'),
            'course' => 'https://www.udemy.com/course/'.$this->faker->slug,
            'exercise' => 'https://exercism.org/tracks/'.$this->faker->word,
        ];

        return [
            'track_id' => \App\Models\Track::factory(),
            'position' => $this->faker->numberBetween(1, 10),
            'title' => $this->faker->sentence,
            'description' => $this->faker->paragraph,
            'content_type' => $type,
            'content_url' => $urls[$type],
            'external_resource' => $this->faker->boolean(90),
            'estimated_time' => $this->faker->numberBetween(5, 120),
            'created_at' => $this->faker->dateTimeBetween('-1 year', 'now'),
            'updated_at' => $this->faker->dateTimeBetween('-1 year', 'now'),
        ];
    }
}
