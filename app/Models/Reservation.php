<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    protected $fillable = [
        'name', 'phone', 'date', 'time', 'pax',
        'notes', 'status', 'cart_items', 'total_price',
        'order_id', 'snap_token', 'payment_status',
        'payment_type', 'transaction_id', 'paid_at',
    ];

    protected $casts = [
        'cart_items' => 'array',
        'date'       => 'date',
        'paid_at'    => 'datetime',
    ];

    /**
     * Apakah reservasi sudah lunas bayar
     */
    public function isPaid(): bool
    {
        return $this->payment_status === 'paid';
    }

    /**
     * Label badge payment status
     */
    public function paymentStatusLabel(): string
    {
        return match ($this->payment_status) {
            'paid'    => 'Lunas',
            'pending' => 'Menunggu',
            'failed'  => 'Gagal',
            'expired' => 'Kedaluwarsa',
            default   => 'Belum Bayar',
        };
    }
}
