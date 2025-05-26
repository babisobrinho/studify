<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class UserStepFactory extends Factory
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
            'step_id' => \App\Models\Step::factory(),
            'completed_at' => $this->faker->dateTimeBetween('-1 year', 'now'),
            'notes' => $this->faker->optional(0.7)->paragraph,
        ];
    }
}
