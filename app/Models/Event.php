<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $table = 'events';

    protected $fillable = [
        'type', 'title', 'description', 'image',
        'badge', 'start_date', 'end_date', 'link',
        'is_active', 'sort_order',
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date'   => 'date',
        'is_active'  => 'boolean',
    ];

    public function scopeActive($query)
    {
        return $query->where('is_active', true)->orderBy('sort_order')->orderByDesc('created_at');
    }

    public function getTypeLabelAttribute(): string
    {
        return $this->type === 'promo' ? 'Promo' : 'Event';
    }

    public function getTypeEmojiAttribute(): string
    {
        return $this->type === 'promo' ? '🏷️' : '🎉';
    }
}
