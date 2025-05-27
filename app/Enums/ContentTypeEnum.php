<?php

namespace App\Enums;

enum ContentTypeEnum: string
{
    case VIDEO = 'video';
    case ARTICLE = 'article';
    case PODCAST = 'podcast';
    case COURSE = 'course';
    case EXERCISE = 'exercise';

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }
}