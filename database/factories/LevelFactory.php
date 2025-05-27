<?php

namespace Database\Factories;

use App\Models\Level;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Level>
 */
class LevelFactory extends Factory
{
    protected $model = Level::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $minExp = $this->faker->numberBetween(0, 1000);
        
        return [
            'name' => $this->faker->word(),
            'slug' => $this->faker->slug(3),
            'min_experience' => $minExp,
            'max_experience' => $minExp + 100,
            'badge_image' => $this->faker->imageUrl(100, 100),
            'description' => $this->faker->sentence(),
        ];
    }
}
