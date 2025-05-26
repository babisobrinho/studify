<?php

namespace Database\Factories;

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
        $types = ['new_follower', 'track_update', 'comment', 'like', 'badge'];
        $type = $this->faker->randomElement($types);

        return [
            'user_id' => \App\Models\User::factory(),
            'type' => $type,
            'related_id' => $this->getRelatedId($type),
            'message' => $this->getMessage($type),
            'is_read' => $this->faker->boolean,
            'created_at' => $this->faker->dateTimeBetween('-1 year', 'now'),
            'updated_at' => $this->faker->dateTimeBetween('-1 year', 'now'),
        ];
    }

    private function getRelatedId($type)
    {
        switch ($type) {
            case 'new_follower':
                return \App\Models\User::factory();
            case 'track_update':
                return \App\Models\Track::factory();
            case 'comment':
                return \App\Models\Comment::factory();
            case 'like':
                return \App\Models\Like::factory();
            case 'badge':
                return \App\Models\Badge::factory();
            default:
                return null;
        }
    }

    private function getMessage($type)
    {
        $messages = [
            'new_follower' => 'começou a seguir você',
            'track_update' => 'atualizou a trilha que você está seguindo',
            'comment' => 'comentou na sua trilha',
            'like' => 'curtiu sua trilha',
            'badge' => 'Você desbloqueou um novo badge',
        ];

        return $messages[$type];
    }
}
