<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function index(Request $request)
    {
        $query = Review::latest();

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $reviews = $query->paginate(10);
        return view('admin.review.index', compact('reviews'));
    }

    public function updateStatus(Request $request, Review $review)
    {
        $request->validate(['status' => 'required|in:pending,approved,rejected']);
        $review->update(['status' => $request->status]);
        return back()->with('success', 'Status ulasan berhasil diperbarui.');
    }

    public function destroy(Review $review)
    {
        $review->delete();
        return back()->with('success', 'Ulasan berhasil dihapus.');
    }
}
