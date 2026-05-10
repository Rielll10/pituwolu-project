<?php

namespace App\Http\Controllers;

use App\Models\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function store(Request $request)
    {
        $data = $request->validate([
            'nama_pengulas' => 'required|string|max:100',
            'ulasan'        => 'required|string',
            'rating'        => 'nullable|integer|min:1|max:5',
        ]);

        $data['status'] = 'pending';

        Review::create($data);

        return back()->with('success', 'Terima Kasih atas ulasan anda!');
    }
}
