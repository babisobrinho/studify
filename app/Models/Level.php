<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Level extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'min_experience',
        'max_experience',
        'badge_image',
        'description',
    ];

    protected $casts = [
        'min_experience' => 'integer',
        'max_experience' => 'integer',
    ];

    // Relations
    public function users(): HasMany
    {
        return $this->hasMany(User::class);
    }

    // Helper to get current level based on experience
    public static function findForExperience(int $experience): ?Level
    {
        return static::where('min_experience', '<=', $experience)
            ->where(function($query) use ($experience) {
                $query->where('max_experience', '>=', $experience)
                    ->orWhereNull('max_experience');
            })
            ->orderBy('min_experience', 'desc')
            ->first();
    }

    public function getBadgeImageUrlAttribute(): string
    {
        return asset('storage/' . $this->badge_image);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('min_experience');
    }
}
