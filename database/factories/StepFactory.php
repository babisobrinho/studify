<?php

namespace Database\Factories;

use App\Enums\ContentTypeEnum;
use App\Models\Track;
use App\Models\Step;
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
        static $position = 1;

        return [
            'track_id' => Track::factory(),
            'position' => $position++,
            'title' => $this->faker->sentence(),
            'description' => $this->faker->paragraph(),
            'content_type' => $this->faker->randomElement(ContentTypeEnum::cases()),
            'content_url' => $this->faker->url(),
            'external_resource' => $this->faker->boolean(),
            'estimated_time' => $this->faker->numberBetween(5, 120), // minutos
        ];
    }
}
