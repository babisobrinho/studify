<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class ReportFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $reportable = $this->faker->randomElement([
            ['track_id' => \App\Models\Track::factory(), 'comment_id' => null],
            ['track_id' => null, 'comment_id' => \App\Models\Comment::factory()],
        ]);

        return array_merge([
            'user_id' => \App\Models\User::factory(),
            'reason' => $this->faker->randomElement(['spam', 'inappropriate', 'wrong_info', 'other']),
            'description' => $this->faker->paragraph,
            'status' => $this->faker->randomElement(['pending', 'reviewed', 'resolved']),
            'created_at' => $this->faker->dateTimeBetween('-1 year', 'now'),
            'updated_at' => $this->faker->dateTimeBetween('-1 year', 'now'),
        ], $reportable);
    }
}
