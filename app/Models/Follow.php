<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Follow extends Model
{
    use HasFactory;

    /**
     * Os atributos que são mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'follower_id',
        'followed_id',
    ];

    public $timestamps = false;

    // Relations
    public function follower(): BelongsTo
    {
        return $this->belongsTo(User::class, 'follower_id');
    }

    public function followed(): BelongsTo
    {
        return $this->belongsTo(User::class, 'followed_id');
    }

    public static function isFollowing(int $followerId, int $followedId): bool
    {
        return self::where('follower_id', $followerId)
            ->where('followed_id', $followedId)
            ->exists();
    }

    public static function follow(int $followerId, int $followedId): Follow
    {
        return self::firstOrCreate([
            'follower_id' => $followerId,
            'followed_id' => $followedId,
        ]);
    }

    public static function unfollow(int $followerId, int $followedId): bool
    {
        return (bool) self::where('follower_id', $followerId)
            ->where('followed_id', $followedId)
            ->delete();
    }
}
