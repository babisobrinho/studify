<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'track_id',
        'comment_id',
        'reason',
        'description',
        'status',
    ];

    protected $casts = [
        'status' => 'string',
    ];

    // Relacionamentos
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function track()
    {
        return $this->belongsTo(Track::class);
    }

    public function comment()
    {
        return $this->belongsTo(Comment::class);
    }

    // Métodos auxiliares
    public function getReportableAttribute()
    {
        return $this->track_id ? $this->track : $this->comment;
    }

    public function getReportableTypeAttribute()
    {
        return $this->track_id ? 'track' : 'comment';
    }
}
