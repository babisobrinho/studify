<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Spatie\Permission\Models\Permission;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class PermissionFactory extends Factory
{
    protected $model = Permission::class;

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

    public function forTracks()
    {
        return $this->state(function (array $attributes) {
            return [
                'name' => 'manage_tracks',
            ];
        });
    }

    public function forUsers()
    {
        return $this->state(function (array $attributes) {
            return [
                'name' => 'manage_users',
            ];
        });
    }

    public function forContent()
    {
        return $this->state(function (array $attributes) {
            return [
                'name' => 'manage_content',
            ];
        });
    }
}
