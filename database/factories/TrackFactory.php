<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class TrackFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => \App\Models\User::factory(),
            'title' => $this->faker->sentence(4),
            'slug' => $this->faker->slug,
            'description' => $this->faker->paragraphs(3, true),
            'is_official' => $this->faker->boolean(30),
            'is_public' => $this->faker->boolean(80),
            'difficulty' => $this->faker->randomElement(['beginner', 'intermediate', 'advanced']),
            'cover_image' => $this->faker->imageUrl(800, 400, 'technics'),
            'created_at' => $this->faker->dateTimeBetween('-1 year', 'now'),
            'updated_at' => $this->faker->dateTimeBetween('-1 year', 'now'),
        ];
    }

    public function official()
    {
        return $this->state(function (array $attributes) {
            return [
                'is_official' => true,
                'user_id' => \App\Models\User::where('role', 'curator')->first()->id ?? \App\Models\User::factory()->curator(),
            ];
        });
    }
}
