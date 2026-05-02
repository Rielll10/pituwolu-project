<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\Menu;
use App\Models\Reservation;
use App\Models\Review;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'total_reservasi'   => Reservation::count(),
            'pending_reservasi' => Reservation::where('status', 'pending')->count(),
            'total_menu'        => Menu::count(),
            'total_review'      => Review::count(),
            'pending_review'    => Review::where('status', 'pending')->count(),
            'total_event'       => Event::count(),
        ];

        $latest_reservasi = Reservation::latest()->take(5)->get();
        $latest_review    = Review::latest()->take(5)->get();

        return view('admin.dashboard', compact('stats', 'latest_reservasi', 'latest_review'));
    }
}
