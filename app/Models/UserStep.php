<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserStep extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = 'user_steps';

    protected $fillable = [
        'user_id',
        'step_id',
        'completed_at',
        'notes',
    ];

    protected $casts = [
        'completed_at' => 'datetime',
    ];

    // Relations
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function step()
    {
        return $this->belongsTo(Step::class);
    }

    // Auxiliar
    public function markAsComplete()
    {
        $this->update(['completed_at' => now()]);
    }
}
