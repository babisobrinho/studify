<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class UserTrackFactory extends Factory
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
            'track_id' => \App\Models\Track::factory(),
            'progress' => $this->faker->numberBetween(0, 100),
            'last_accessed' => $this->faker->dateTimeBetween('-6 months', 'now'),
            'started_at' => $this->faker->dateTimeBetween('-1 year', '-1 month'),
            'completed_at' => $this->faker->optional(0.3)->dateTimeBetween('-1 year', 'now'),
        ];
    }

    public function completed()
    {
        return $this->state(function (array $attributes) {
            return [
                'progress' => 100,
                'completed_at' => $this->faker->dateTimeBetween('-1 year', 'now'),
            ];
        });
    }
}
