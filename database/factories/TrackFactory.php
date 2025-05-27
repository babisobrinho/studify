<?php

namespace Database\Factories;

use App\Enums\DifficultyEnum;
use App\Models\User;
use App\Models\Track;
use App\Models\Step;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class TrackFactory extends Factory
{
    protected $model = \App\Models\Track::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'title' => $this->faker->sentence(),
            'slug' => $this->faker->slug(),
            'description' => $this->faker->paragraph(),
            'is_official' => $this->faker->boolean(),
            'is_public' => $this->faker->boolean(80),
            'difficulty' => $this->faker->randomElement(DifficultyEnum::cases())->value,
            'cover_image' => $this->faker->imageUrl(800, 400, 'technics'),
            'contributors_count' => $this->faker->numberBetween(0, 10),
        ];
    }

    public function official()
    {
        return $this->state(function (array $attributes) {
            return [
                'is_official' => true,
                'user_id' => User::role('curator')->first()->id ?? 
                            User::factory()->create()->assignRole('curator'),
            ];
        });
    }

    public function difficulty(DifficultyEnum $difficulty)
    {
        return $this->state(function (array $attributes) use ($difficulty) {
            return [
                'difficulty' => $difficulty->value,
            ];
        });
    }

    public function withSteps($count = 5)
    {
        return $this->afterCreating(function (Track $track) use ($count) {
            Step::factory()->count($count)->for($track)->create();
        });
    }
}
