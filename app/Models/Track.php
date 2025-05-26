<?php

namespace App\Models;

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
    ];

    protected $casts = [
        'is_official' => 'boolean',
        'is_public' => 'boolean',
    ];

    // Relacionamentos
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'track_tags');
    }

    public function steps()
    {
        return $this->hasMany(Step::class)->orderBy('position');
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'user_tracks')
            ->withPivot('progress', 'last_accessed', 'started_at', 'completed_at');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    public function reports()
    {
        return $this->hasMany(Report::class);
    }

    // Scopes
    public function scopeOfficial($query)
    {
        return $query->where('is_official', true);
    }

    public function scopePublic($query)
    {
        return $query->where('is_public', true);
    }

    // Métodos auxiliares
    public function getProgressForUser($userId)
    {
        $userTrack = $this->users()->where('user_id', $userId)->first();
        return $userTrack ? $userTrack->pivot->progress : 0;
    }
}
