<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Reservation;
use Illuminate\Http\Request;

class TransaksiController extends Controller
{
    public function index(Request $request)
    {
        $query = Reservation::latest()->where('order_type', 'order');

        if ($request->filled('payment_status')) {
            $query->where('payment_status', $request->payment_status);
        }

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('order_id', 'like', "%{$search}%")
                  ->orWhere('phone', 'like', "%{$search}%");
            });
        }

        $transactions = $query->paginate(15);

        $stats = [
            'total'   => Reservation::where('order_type', 'order')->count(),
            'paid'    => Reservation::where('order_type', 'order')->where('payment_status', 'paid')->count(),
            'pending' => Reservation::where('order_type', 'order')->where('payment_status', 'pending')->count(),
            'unpaid'  => Reservation::where('order_type', 'order')->where('payment_status', 'unpaid')->count(),
            'failed'  => Reservation::where('order_type', 'order')->whereIn('payment_status', ['failed', 'expired'])->count(),
            'revenue' => Reservation::where('order_type', 'order')->where('payment_status', 'paid')->sum('total_price'),
        ];

        return view('admin.transaksi.index', compact('transactions', 'stats'));
    }
}
