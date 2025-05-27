<?php

namespace Database\Factories;

use App\Models\Step;
use App\Models\User;
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
            'user_id' => User::factory(),
            'step_id' => Step::factory(),
            'completed_at' => $this->faker->optional(0.7)->dateTimeThisYear(), // 70% chance de estar completo
            'notes' => $this->faker->optional(0.5)->paragraph(), // 50% chance de ter notas
        ];
    }
}
