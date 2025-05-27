<?php

namespace Database\Factories;

use App\Models\Level;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * The current password being used by the factory.
     */
    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'username' => $this->faker->unique()->userName(),
            'email' => $this->faker->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => bcrypt('password'),
            'bio' => $this->faker->paragraph(),
            'profile_pic' => $this->faker->imageUrl(200, 200, 'people'),
            'level_id' => Level::factory(),
            'experience' => $this->faker->numberBetween(0, 1000),
            'remember_token' => Str::random(10),
        ];
    }

    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }

    public function admin()
{
    return $this->afterCreating(function (User $user) {
        $user->assignRole('admin');
    });
}

public function curator()
{
    return $this->afterCreating(function (User $user) {
        $user->assignRole('curator');
    });
}

public function moderator()
{
    return $this->afterCreating(function (User $user) {
        $user->assignRole('moderator');
    });
}

public function student()
{
    return $this->afterCreating(function (User $user) {
        $user->assignRole('student');
    });
}

public function withExperience(int $experience)
{
    return $this->state(function (array $attributes) use ($experience) {
        return [
            'experience' => $experience,
        ];
    });
}
}
