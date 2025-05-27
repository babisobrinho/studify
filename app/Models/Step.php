<?php

namespace App\Models;

use App\Enums\ContentTypeEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Step extends Model
{
    use HasFactory;

    protected $fillable = [
        'track_id',
        'position',
        'title',
        'description',
        'content_type',
        'content_url',
        'external_resource',
        'estimated_time',
    ];

    protected $casts = [
        'external_resource' => 'boolean',
        'content_type' => ContentTypeEnum::class,
    ];

    // Relations
    public function track()
    {
        return $this->belongsTo(Track::class);
    }

    public function userSteps()
    {
        return $this->hasMany(UserStep::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'user_steps')
            ->withPivot('completed_at', 'notes');
    }

    // Métodos auxiliares
    public function isCompletedByUser($userId)
    {
        return $this->users()->where('user_id', $userId)->exists();
    }
}
