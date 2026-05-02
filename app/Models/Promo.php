<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Promo extends Model
{
    protected $table = 'promos';

    protected $fillable = [
        'title', 'description', 'image', 'badge',
        'link', 'end_date', 'is_active', 'sort_order',
    ];

    protected $casts = [
        'end_date' => 'date',
        'is_active' => 'boolean',
    ];

    public function scopeActive($query)
    {
        return $query->where('is_active', true)->orderBy('sort_order')->orderByDesc('created_at');
    }
}
