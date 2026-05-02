<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class EventController extends Controller
{
    public function index(Request $request)
    {
        $query = Event::latest();

        if ($request->filled('type')) {
            $query->where('type', $request->type);
        }

        $events = $query->paginate(12);
        return view('admin.event.index', compact('events'));
    }

    public function create()
    {
        return view('admin.event.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'type'        => 'required|in:promo,event',
            'title'       => 'required|string|max:200',
            'description' => 'nullable|string',
            'image'       => 'nullable|image|mimes:jpg,jpeg,png,webp|max:3072',
            'badge'       => 'nullable|string|max:50',
            'start_date'  => 'nullable|date',
            'end_date'    => 'nullable|date|after_or_equal:start_date',
            'link'        => 'nullable|url',
            'sort_order'  => 'nullable|integer',
            'is_active'   => 'boolean',
        ]);

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('events', 'public');
        }

        $data['is_active']  = $request->boolean('is_active', true);
        $data['sort_order'] = $data['sort_order'] ?? 0;

        Event::create($data);
        return redirect()->route('admin.event.index')->with('success', 'Promo/Event berhasil ditambahkan!');
    }

    public function edit(Event $event)
    {
        return view('admin.event.edit', compact('event'));
    }

    public function update(Request $request, Event $event)
    {
        $data = $request->validate([
            'type'        => 'required|in:promo,event',
            'title'       => 'required|string|max:200',
            'description' => 'nullable|string',
            'image'       => 'nullable|image|mimes:jpg,jpeg,png,webp|max:3072',
            'badge'       => 'nullable|string|max:50',
            'start_date'  => 'nullable|date',
            'end_date'    => 'nullable|date|after_or_equal:start_date',
            'link'        => 'nullable|url',
            'sort_order'  => 'nullable|integer',
            'is_active'   => 'boolean',
        ]);

        if ($request->hasFile('image')) {
            if ($event->image) Storage::disk('public')->delete($event->image);
            $data['image'] = $request->file('image')->store('events', 'public');
        }

        $data['is_active']  = $request->boolean('is_active');
        $data['sort_order'] = $data['sort_order'] ?? $event->sort_order;

        $event->update($data);
        return redirect()->route('admin.event.index')->with('success', 'Promo/Event berhasil diperbarui!');
    }

    public function destroy(Event $event)
    {
        if ($event->image) Storage::disk('public')->delete($event->image);
        $event->delete();
        return back()->with('success', 'Promo/Event berhasil dihapus.');
    }
}
