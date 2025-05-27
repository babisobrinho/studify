<?php

namespace App\Enums;

enum DifficultyEnum: string
{
    case BEGINNER = 'beginner';
    case INTERMEDIATE = 'intermediate';
    case ADVANCED = 'advanced';

    public static function values(): array
    {
        return array_map(fn($case) => $case->value, self::cases());
    }
}