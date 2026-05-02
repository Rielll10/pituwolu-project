<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Gallery;
use App\Models\Menu;
use App\Models\Review;

class HomeController extends Controller
{
    public function index()
    {
        $promos  = Event::active()->where('type', 'promo')->get();
        $events  = Event::active()->where('type', 'event')->get();
        $reviews = Review::where('status', 'approved')->latest()->get();
        $bestSellers = Menu::with('category')
            ->where('is_active', true)
            ->where('is_best_seller', true)
            ->get();

        return view('index', compact('promos', 'events', 'reviews', 'bestSellers'));
    }

    public function menu()
    {
        $menuItems  = Menu::with('category')->where('is_active', true)->get();
        $categories = \App\Models\Category::whereHas('menus', fn($q) => $q->where('is_active', true))->get();

        return view('menu', compact('menuItems', 'categories'));
    }

    public function gallery()
    {
        $galleries = Gallery::active()->get();
        return view('gallery', compact('galleries'));
    }
}
