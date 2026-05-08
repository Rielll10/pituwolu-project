<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Midtrans\Config as MidtransConfig;
use Midtrans\Snap;
use Midtrans\Notification;

class ReservasiController extends Controller
{
    public function __construct()
    {
        MidtransConfig::$serverKey    = config('midtrans.server_key');
        MidtransConfig::$isProduction = config('midtrans.is_production');
        MidtransConfig::$isSanitized  = config('midtrans.is_sanitized');
        MidtransConfig::$is3ds        = config('midtrans.is_3ds');
    }

    /**
     * Step 1: Validasi & simpan reservasi, lalu buat Snap Token
     */
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

        $cartItems  = $data['cart_items'] ? json_decode($data['cart_items'], true) : [];
        $totalPrice = (int) ($data['total_price'] ?? 0);

        // Jika total_price = 0, tetap charge minimum Rp 1.000 untuk bisa diproses
        if ($totalPrice <= 0) {
            $totalPrice = 1000;
        }

        $orderId = 'PW-' . strtoupper(Str::random(6));

        $reservation = Reservation::create([
            'order_id'       => $orderId,
            'name'           => $data['name'],
            'phone'          => $data['phone'],
            'date'           => $data['date'],
            'time'           => $data['time'],
            'pax'            => $data['pax'],
            'notes'          => $data['notes'] ?? null,
            'cart_items'     => $cartItems,
            'total_price'    => $totalPrice,
            'status'         => 'pending',
            'payment_status' => 'unpaid',
        ]);

        // Buat Snap Token Midtrans
        $params = [
            'transaction_details' => [
                'order_id'     => $orderId,
                'gross_amount' => $totalPrice,
            ],
            'customer_details' => [
                'first_name' => $data['name'],
                'phone'      => $data['phone'],
            ],
            'item_details' => $this->buildItemDetails($cartItems, $totalPrice),
            'callbacks' => [
                'finish' => route('reservasi.finish'),
            ],
        ];

        try {
            $snapToken = Snap::getSnapToken($params);
            $reservation->update(['snap_token' => $snapToken]);

            return response()->json([
                'snap_token'     => $snapToken,
                'order_id'       => $orderId,
                'reservation_id' => $reservation->id,
                'client_key'     => config('midtrans.client_key'),
                'snap_url'       => config('midtrans.snap_url'),
            ]);
        } catch (\Exception $e) {
            $reservation->delete();
            return response()->json(['error' => 'Gagal membuat transaksi: ' . $e->getMessage()], 500);
        }
    }

    /**
     * Step 2: Halaman sukses setelah payment
     */
    public function finish(Request $request)
    {
        $orderId = $request->query('order_id');

        if (!$orderId) {
            return redirect('/reservasi')->with('error', 'Data transaksi tidak ditemukan.');
        }

        $reservation = Reservation::where('order_id', $orderId)->first();

        if (!$reservation) {
            return redirect('/reservasi')->with('error', 'Reservasi tidak ditemukan.');
        }

        // Jika sudah paid, bangun WA link dan kirim ke view
        $waLink = null;
        if ($reservation->payment_status === 'paid') {
            $waLink = $this->buildWhatsAppLink($reservation);
        }

        return view('reservasi-status', compact('reservation', 'waLink'));
    }

    /**
     * Webhook dari Midtrans (payment notification)
     */
    public function webhook(Request $request)
    {
        $notification = new Notification();

        $orderId           = $notification->order_id;
        $transactionStatus = $notification->transaction_status;
        $fraudStatus       = $notification->fraud_status;
        $paymentType       = $notification->payment_type;
        $transactionId     = $notification->transaction_id;

        $reservation = Reservation::where('order_id', $orderId)->first();

        if (!$reservation) {
            return response()->json(['status' => 'not_found'], 404);
        }

        $paymentStatus = match (true) {
            ($transactionStatus === 'capture' && $fraudStatus === 'accept') => 'paid',
            ($transactionStatus === 'settlement')                           => 'paid',
            ($transactionStatus === 'pending')                              => 'pending',
            ($transactionStatus === 'deny')                                 => 'failed',
            ($transactionStatus === 'expire')                               => 'expired',
            ($transactionStatus === 'cancel')                               => 'failed',
            default                                                         => $reservation->payment_status,
        };

        $updateData = [
            'payment_status' => $paymentStatus,
            'payment_type'   => $paymentType,
            'transaction_id' => $transactionId,
        ];

        if ($paymentStatus === 'paid') {
            $updateData['status']  = 'confirmed';
            $updateData['paid_at'] = now();
        }

        $reservation->update($updateData);

        return response()->json(['status' => 'ok']);
    }

    // ──────────────────────────────────────────────────────────────
    // Private helpers
    // ──────────────────────────────────────────────────────────────

    private function buildItemDetails(array $cartItems, int $totalPrice): array
    {
        if (empty($cartItems)) {
            return [[
                'id'    => 'RESERVATION-FEE',
                'price' => $totalPrice,
                'quantity' => 1,
                'name'  => 'Biaya Reservasi Pituwolu Coffee',
            ]];
        }

        $items      = [];
        $itemsTotal = 0;

        foreach ($cartItems as $item) {
            $price    = (int) ($item['priceNumber'] ?? 0);
            $qty      = (int) ($item['quantity'] ?? 1);
            $subtotal = $price * $qty;
            $itemsTotal += $subtotal;

            $items[] = [
                'id'       => Str::slug($item['title'] ?? 'menu'),
                'price'    => $price,
                'quantity' => $qty,
                'name'     => substr($item['title'] ?? 'Menu', 0, 50),
            ];
        }

        // Sesuaikan jika ada selisih
        if ($itemsTotal !== $totalPrice && !empty($items)) {
            $items[0]['price'] += ($totalPrice - $itemsTotal);
        }

        return $items;
    }

    private function buildWhatsAppLink(Reservation $reservation): string
    {
        $cartItems  = $reservation->cart_items ?? [];
        $totalPrice = $reservation->total_price;
        $dateStr    = $reservation->date instanceof \Carbon\Carbon
                        ? $reservation->date->format('d M Y')
                        : \Carbon\Carbon::parse($reservation->date)->format('d M Y');

        $message  = "Halo Pituwolu Coffee! %0A%0A";
        $message .= "Saya sudah melakukan pembayaran untuk reservasi berikut:%0A";
        $message .= "Kode: {$reservation->order_id}%0A";
        $message .= "Nama: {$reservation->name}%0A";
        $message .= "Tanggal: {$dateStr}%0A";
        $message .= "Waktu: {$reservation->time}%0A";

        if (!empty($reservation->notes)) {
            $message .= "Catatan: {$reservation->notes}%0A";
        }

        if (!empty($cartItems)) {
            $message .= "%0A--- PESANAN MENU ---%0A";
            foreach ($cartItems as $item) {
                $qty = $item['quantity'] ?? 1;
                $title = $item['title'] ?? 'Menu';
                $message .= "- {$qty}x {$title}%0A";
            }
        }

        $message .= "%0AStatus: LUNAS (Midtrans)%0A%0A";
        $message .= "Mohon segera diproses. Terima kasih!";

        $waNumber = '6289653931071';
        return "https://wa.me/{$waNumber}?text={$message}";
    }
}
