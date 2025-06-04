<?php

namespace App\Models;

use App\Enums\DifficultyEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Track extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'title',
        'slug',
        'description',
        'is_official',
        'is_public',
        'difficulty',
        'cover_image',
        'contributors_count'
    ];

    protected $casts = [
        'is_official' => 'boolean',
        'is_public' => 'boolean',
        'difficulty' => DifficultyEnum::class,
    ];

    // Relations
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'track_tags');
    }

    public function steps()
    {
        return $this->hasMany(Step::class)->orderBy('position');
    }

    public function userTracks()
    {
        return $this->hasMany(UserTrack::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class)->whereNull('parent_id');
    }

    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    public function reports()
    {
        return $this->hasMany(Report::class);
    }

    public function certificates()
    {
        return $this->hasMany(Certificate::class);
    }

    public function ratings()
    {
        return $this->hasMany(Rating::class);
    }

    // Helpers
    public function getAverageRatingAttribute()
    {
        return $this->ratings()->avg('rating');
    }

    // Métodos auxiliares
    public function scopeOfficial($query)
    {
        return $query->where('is_official', true);
    }

    public function scopePublic($query)
    {
        return $query->where('is_public', true);
    }

    public function getDifficultyLabelAttribute()
    {
        return match($this->difficulty) {
            DifficultyEnum::BEGINNER => 'Iniciante',
            DifficultyEnum::INTERMEDIATE => 'Intermediário',
            DifficultyEnum::ADVANCED => 'Avançado',
        };
    }
}