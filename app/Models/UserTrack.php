<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserTrack extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = 'user_tracks';

    protected $fillable = [
        'user_id',
        'track_id',
        'progress',
        'last_accessed',
        'started_at',
        'completed_at',
    ];

    protected $casts = [
        'started_at' => 'datetime',
        'completed_at' => 'datetime',
        'last_accessed' => 'datetime',
    ];

    // Relations
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function track()
    {
        return $this->belongsTo(Track::class);
    }

    // Auxiliar
    public function updateProgress($progress)
    {
        $this->update(['progress' => $progress, 'last_accessed' => now()]);
    }

    public function withProgress(int $progress)
    {
        return $this->state(function (array $attributes) use ($progress) {
            return [
                'progress' => $progress,
                'completed_at' => $progress === 100 ? now() : null,
            ];
        });
    }

    public function inProgress()
    {
        return $this->state(function (array $attributes) {
            return [
                'progress' => $this->faker->numberBetween(1, 99),
                'completed_at' => null,
            ];
        });
    }
}