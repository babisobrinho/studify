<?php

namespace Database\Factories;

use App\Models\Comment;
use App\Models\Track;
use App\Models\User;
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
        return [
            'user_id' => User::factory(),
            'track_id' => null,
            'comment_id' => null,
            'reason' => $this->faker->randomElement(['spam', 'inappropriate', 'wrong_info', 'other']),
            'description' => $this->faker->paragraph(),
            'status' => $this->faker->randomElement(['pending', 'reviewed', 'resolved']),
        ];
    }

    public function forTrack()
    {
        return $this->state(function (array $attributes) {
            return [
                'track_id' => Track::factory(),
                'comment_id' => null,
            ];
        });
    }

    public function forComment()
    {
        return $this->state(function (array $attributes) {
            return [
                'comment_id' => Comment::factory(),
                'track_id' => null,
            ];
        });
    }

    public function resolved()
    {
        return $this->state(function (array $attributes) {
            return [
                'status' => 'resolved',
            ];
        });
    }

    public function reviewed()
    {
        return $this->state(function (array $attributes) {
            return [
                'status' => 'reviewed',
            ];
        });
    }
}
