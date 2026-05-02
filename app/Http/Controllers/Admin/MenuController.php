<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Menu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MenuController extends Controller
{
    public function index(Request $request)
    {
        $query = Menu::with('category')->latest();
        
        if ($request->has('search') && $request->search != '') {
            $query->where('nama_menu', 'like', '%' . $request->search . '%');
        }

        $menus = $query->paginate(10)->appends($request->all());
        return view('admin.menu.index', compact('menus'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('admin.menu.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nama_menu'        => 'required|string|max:150',
            'category_id'      => 'required|exists:categories,id',
            'harga'            => 'required|numeric|min:0',
            'deskripsi'        => 'nullable|string',
            'foto'             => 'nullable|image|mimes:jpg,jpeg,png,webp|max:5120',
            'is_active'        => 'boolean',
            'is_ice_available' => 'boolean',
            'ice_extra_price'  => 'nullable|integer|min:0',
        ]);

        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')->store('menu', 'public');
        }

        $data['is_active'] = $request->boolean('is_active', true);
        $data['is_ice_available'] = $request->boolean('is_ice_available');
        $data['ice_extra_price'] = $request->input('ice_extra_price', 2000);

        Menu::create($data);
        return redirect()->route('admin.menu.index')->with('success', 'Menu berhasil ditambahkan.');
    }

    public function edit(Menu $menu)
    {
        $categories = Category::all();
        return view('admin.menu.edit', compact('menu', 'categories'));
    }

    public function update(Request $request, Menu $menu)
    {
        $data = $request->validate([
            'nama_menu'        => 'required|string|max:150',
            'category_id'      => 'required|exists:categories,id',
            'harga'            => 'required|numeric|min:0',
            'deskripsi'        => 'nullable|string',
            'foto'             => 'nullable|image|mimes:jpg,jpeg,png,webp|max:5120',
            'is_active'        => 'boolean',
            'is_ice_available' => 'boolean',
            'ice_extra_price'  => 'nullable|integer|min:0',
        ]);

        if ($request->hasFile('foto')) {
            if ($menu->foto) Storage::disk('public')->delete($menu->foto);
            $data['foto'] = $request->file('foto')->store('menu', 'public');
        }

        $data['is_active'] = $request->boolean('is_active');
        $data['is_ice_available'] = $request->boolean('is_ice_available');
        $data['ice_extra_price'] = $request->input('ice_extra_price', $menu->ice_extra_price);

        $menu->update($data);
        return redirect()->route('admin.menu.index')->with('success', 'Menu berhasil diperbarui.');
    }

    public function destroy(Menu $menu)
    {
        if ($menu->foto) Storage::disk('public')->delete($menu->foto);
        $menu->delete();
        return back()->with('success', 'Menu berhasil dihapus.');
    }

    public function toggleBestSeller(Menu $menu)
    {
        $menu->update(['is_best_seller' => !$menu->is_best_seller]);
        return back()->with('success', $menu->nama_menu . ($menu->is_best_seller ? ' dijadikan Best Seller.' : ' dihapus dari Best Seller.'));
    }
}
