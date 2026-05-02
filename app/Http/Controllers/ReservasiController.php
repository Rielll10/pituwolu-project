<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use Illuminate\Http\Request;

class ReservasiController extends Controller
{
    public function store(Request $request)
    {
        $data = $request->validate([
            'name'        => 'required|string|max:100',
            'phone'       => 'required|string|max:20',
            'date'        => 'required|date',
            'time'        => 'required',
            'pax'         => 'required|string',
            'notes'       => 'nullable|string',
            'cart_items'  => 'nullable|string',
            'total_price' => 'nullable|numeric',
        ]);

        $data['cart_items']  = $data['cart_items'] ? json_decode($data['cart_items'], true) : null;
        $data['total_price'] = $data['total_price'] ?? 0;
        $data['status']      = 'pending';

        Reservation::create($data);

        // Buat pesan WhatsApp
        $cartItems  = $data['cart_items'] ?? [];
        $totalPrice = $data['total_price'];

        $message = "*Halo Pituwolu Coffee!* %0A%0A";
        $message .= "Saya ingin melakukan reservasi dengan detail berikut:%0A";
        $message .= "Nama: {$data['name']}%0A";
        $message .= "Tanggal: {$data['date']}%0A";
        $message .= "Waktu: {$data['time']}%0A";
        $message .= "Kapasitas: {$data['pax']}%0A";

        if (!empty($data['notes'])) {
            $message .= "Catatan Khusus: {$data['notes']}%0A";
        }

        $message .= "%0A--- *PESANAN MENU* ---%0A";

        if (!empty($cartItems)) {
            foreach ($cartItems as $item) {
                $subtotal = ($item['priceNumber'] ?? 0) * ($item['quantity'] ?? 1);
                $message .= "- {$item['quantity']}x {$item['title']} = Rp " . number_format($subtotal, 0, ',', '.') . "%0A";
            }
            $message .= "%0A*Estimasi Total: Rp " . number_format($totalPrice, 0, ',', '.') . "*%0A";
        } else {
            $message .= "(Belum ada menu yang dipesan. Akan pesan langsung di lokasi)%0A";
        }

        $message .= "%0AMohon informasinya atas ketersediaan meja. Terima kasih! ☕🌿";

        $waNumber = '6285810229923';
        $waLink   = "https://wa.me/{$waNumber}?text={$message}";

        return redirect($waLink);
    }
}
