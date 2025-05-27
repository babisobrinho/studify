<?php

namespace Database\Factories;

use App\Models\Track;
use App\Models\Comment;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class NotificationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $notifiableType = $this->faker->randomElement(['track', 'comment', 'user']);
        
        return [
            'user_id' => User::factory(),
            'notifiable_type' => $notifiableType,
            'notifiable_id' => $this->getNotifiableId($notifiableType),
            'message' => $this->faker->sentence(),
            'is_read' => $this->faker->boolean(),
        ];
    }

    protected function getNotifiableId(string $type)
    {
        return match($type) {
            'track' => Track::factory(),
            'comment' => Comment::factory(),
            'user' => User::factory(),
            default => throw new \InvalidArgumentException("Tipo notificável inválido")
        };
    }

    // Métodos específicos para cada tipo
    public function forTrack()
    {
        return $this->state([
            'notifiable_type' => 'track',
            'notifiable_id' => Track::factory(),
        ]);
    }

    public function forComment()
    {
        return $this->state([
            'notifiable_type' => 'comment',
            'notifiable_id' => Comment::factory(),
        ]);
    }

    public function forUser()
    {
        return $this->state([
            'notifiable_type' => 'user',
            'notifiable_id' => User::factory(),
        ]);
    }
}
