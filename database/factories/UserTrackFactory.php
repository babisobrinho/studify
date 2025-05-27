<?php

namespace Database\Factories;

use App\Models\Track;
use App\Models\User;
use App\Models\UserTrack;
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
            'user_id' => User::factory(),
            'track_id' => Track::factory(),
            'progress' => $this->faker->numberBetween(0, 100),
            'last_accessed' => $this->faker->dateTimeThisYear(),
            'started_at' => $this->faker->dateTimeThisYear(),
            'completed_at' => $this->faker->optional(0.3)->dateTimeThisYear(), // 30% chance de estar completo
        ];
    }

    public function configure()
    {
        return $this->afterMaking(function (UserTrack $userTrack) {
            // Garante que não haja duplicatas
            while (UserTrack::where('user_id', $userTrack->user_id)
                        ->where('track_id', $userTrack->track_id)
                        ->exists()) {
                $userTrack->track_id = Track::factory()->create()->id;
            }
        });
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
