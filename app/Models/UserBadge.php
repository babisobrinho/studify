<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserBadge extends Model
{
    use HasFactory;

    public $timestamps = false;
    
    /**
     * Os atributos que são mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'badge_id',
        'earned_at',
    ];

    /**
     * Os atributos que devem ser convertidos para tipos nativos.
     *
     * @var array
     */
    protected $casts = [
        'earned_at' => 'datetime',
    ];

    /**
     * Obtém o usuário associado a esta conquista
     *
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Obtém o badge associado a esta conquista
     *
     * @return BelongsTo
     */
    public function badge(): BelongsTo
    {
        return $this->belongsTo(Badge::class);
    }

    /**
     * Verifica se um usuário já possui um badge específico
     *
     * @param int $userId
     * @param int $badgeId
     * @return bool
     */
    public static function hasBadge(int $userId, int $badgeId): bool
    {
        return self::where('user_id', $userId)
            ->where('badge_id', $badgeId)
            ->exists();
    }

    /**
     * Concede um badge a um usuário
     *
     * @param int $userId
     * @param int $badgeId
     * @return UserBadge
     */
    public static function awardBadge(int $userId, int $badgeId): UserBadge
    {
        return self::firstOrCreate([
            'user_id' => $userId,
            'badge_id' => $badgeId,
        ], [
            'earned_at' => now(),
        ]);
    }

    /**
     * Remove um badge de um usuário
     *
     * @param int $userId
     * @param int $badgeId
     * @return bool
     */
    public static function revokeBadge(int $userId, int $badgeId): bool
    {
        return (bool) self::where('user_id', $userId)
            ->where('badge_id', $badgeId)
            ->delete();
    }
}
