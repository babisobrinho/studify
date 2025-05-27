<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Spatie\Permission\Models\Role;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class RoleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->unique()->word,
            'guard_name' => 'web',
        ];
    }

    public function admin()
    {
        return $this->state(function (array $attributes) {
            return [
                'name' => 'admin',
            ];
        });
    }

    public function curator()
    {
        return $this->state(function (array $attributes) {
            return [
                'name' => 'curator',
            ];
        });
    }

    public function moderator()
    {
        return $this->state(function (array $attributes) {
            return [
                'name' => 'moderator',
            ];
        });
    }

    public function student()
    {
        return $this->state(function (array $attributes) {
            return [
                'name' => 'student',
            ];
        });
    }
}
