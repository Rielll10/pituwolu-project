<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    protected $table = 'menus';

    protected $fillable = [
        'category_id', 'nama_menu', 'deskripsi',
        'harga', 'is_ice_available', 'ice_extra_price',
        'foto', 'is_active', 'is_best_seller',
    ];

    protected $casts = [
        'is_ice_available' => 'boolean',
        'is_best_seller'   => 'boolean',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
