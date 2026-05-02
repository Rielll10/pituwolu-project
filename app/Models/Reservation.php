<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    protected $fillable = [
        'name', 'phone', 'date', 'time', 'pax',
        'notes', 'status', 'cart_items', 'total_price',
    ];

    protected $casts = [
        'cart_items' => 'array',
        'date' => 'date',
    ];
}
