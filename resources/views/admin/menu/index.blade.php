@extends('admin.layouts.app')
@section('title', 'Kelola Menu')
@section('page-title', 'Menu Management')

@section('content')

<div class="bg-surface-card rounded-xl border border-outline-v/30 shadow-[0_4px_20px_rgba(75,54,33,0.04)] overflow-hidden">
    <div class="p-6 border-b border-surface-dim/50 flex justify-between items-center">
        <h2 class="font-heading font-semibold text-xl text-on-surface">Daftar Menu</h2>
        <div class="flex items-center gap-3">
            <form method="GET" action="{{ route('admin.menu.index') }}" class="flex">
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari menu..."
                       class="w-48 px-3 py-2 border border-outline-v/50 rounded-l-lg text-xs text-on-surface bg-white focus:border-pit-brown outline-none transition-all">
                <button type="submit" class="px-3 py-2 bg-surface-dim/30 border border-l-0 border-outline-v/50 rounded-r-lg text-on-surface-v hover:bg-surface-dim/60 transition-colors flex items-center justify-center">
                    <span class="material-symbols-outlined text-[16px]">search</span>
                </button>
            </form>
            <a href="{{ route('admin.menu.create') }}"
               class="px-4 py-2.5 bg-pit-primary hover:bg-pit-primary/90 text-white text-xs font-semibold rounded-lg transition-all flex items-center gap-2 shadow-sm">
                <span class="material-symbols-outlined text-[16px]">add</span> Tambah Menu
            </a>
        </div>
    </div>
    <div class="overflow-x-auto">
        <table class="w-full text-sm">
            <thead>
                <tr class="border-b-2 border-surface-dim/50">
                    <th class="px-6 py-3 text-left text-[11px] font-semibold uppercase tracking-wider text-on-surface-muted">Foto</th>
                    <th class="px-6 py-3 text-left text-[11px] font-semibold uppercase tracking-wider text-on-surface-muted">Nama Menu</th>
                    <th class="px-6 py-3 text-left text-[11px] font-semibold uppercase tracking-wider text-on-surface-muted">Kategori</th>
                    <th class="px-6 py-3 text-left text-[11px] font-semibold uppercase tracking-wider text-on-surface-muted">Harga</th>
                    <th class="px-6 py-3 text-left text-[11px] font-semibold uppercase tracking-wider text-on-surface-muted">Status</th>
                    <th class="px-6 py-3 text-left text-[11px] font-semibold uppercase tracking-wider text-on-surface-muted">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-surface-dim/30">
                @forelse($menus as $menu)
                <tr class="hover:bg-surface/50 transition-colors">
                    <td class="px-6 py-4">
                        @if($menu->foto)
                            <img src="{{ Storage::url($menu->foto) }}" alt="{{ $menu->nama_menu }}"
                                 class="w-14 h-14 object-cover rounded-xl border border-outline-v/50">
                        @else
                            <div class="w-14 h-14 bg-surface-hover rounded-xl flex items-center justify-center text-2xl border border-outline-v/50">☕</div>
                        @endif
                    </td>
                    <td class="px-6 py-4">
                        <div class="font-semibold text-on-surface">
                            {{ $menu->nama_menu }}
                            @if($menu->is_best_seller)
                            <span class="ml-1 inline-flex items-center px-2 py-0.5 rounded-full text-[10px] font-bold bg-amber-100 text-amber-700">⭐ Best Seller</span>
                            @endif
                        </div>
                        @if($menu->deskripsi)
                        <div class="text-xs text-on-surface-muted mt-1">{{ Str::limit($menu->deskripsi, 45) }}</div>
                        @endif
                    </td>
                    <td class="px-6 py-4 text-on-surface-v">{{ $menu->category->nama_kategori ?? '-' }}</td>
                    <td class="px-6 py-4">
                        <div class="font-semibold text-pit-brown">Rp {{ number_format($menu->harga, 0, ',', '.') }}</div>
                        @if($menu->is_ice_available)
                        <div class="text-[11px] text-pit-info mt-0.5">🧊 Ice +Rp {{ number_format($menu->ice_extra_price, 0, ',', '.') }}</div>
                        @endif
                    </td>
                    <td class="px-6 py-4">
                        <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-semibold
                            {{ $menu->is_active ? 'bg-pit-success-bg text-pit-success' : 'bg-pit-danger-bg text-pit-danger' }}">
                            {{ $menu->is_active ? 'Aktif' : 'Non-Aktif' }}
                        </span>
                    </td>
                    <td class="px-6 py-4">
                        <div class="flex gap-2">
                            <form method="POST" action="{{ route('admin.menu.toggleBestSeller', $menu) }}">
                                @csrf @method('PATCH')
                                <button type="submit" title="{{ $menu->is_best_seller ? 'Hapus dari Best Seller' : 'Jadikan Best Seller' }}"
                                        class="px-3 py-1.5 text-xs font-semibold rounded-lg transition-colors flex items-center gap-1
                                        {{ $menu->is_best_seller ? 'bg-amber-100 text-amber-700 hover:bg-amber-200' : 'text-on-surface-v border border-outline-v/50 hover:bg-surface-hover' }}">
                                    <span class="material-symbols-outlined text-[14px]" style="font-variation-settings: 'FILL' {{ $menu->is_best_seller ? '1' : '0' }};">star</span>
                                </button>
                            </form>
                            <a href="{{ route('admin.menu.edit', $menu) }}"
                               class="px-3 py-1.5 text-xs font-semibold text-on-surface-v border border-outline-v/50 rounded-lg hover:bg-surface-hover transition-colors flex items-center gap-1">
                                <span class="material-symbols-outlined text-[14px]">edit</span> Edit
                            </a>
                            <form method="POST" action="{{ route('admin.menu.destroy', $menu) }}"
                                  class="swal-confirm" data-swal-title="Hapus Menu?" data-swal-text="Menu {{ $menu->nama_menu }} akan dihapus permanen.">
                                @csrf @method('DELETE')
                                <button type="submit"
                                        class="px-3 py-1.5 text-xs font-semibold text-pit-danger bg-pit-danger-bg hover:bg-pit-danger-bg/80 rounded-lg transition-colors flex items-center gap-1">
                                    <span class="material-symbols-outlined text-[14px]">delete</span>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="px-6 py-12 text-center text-on-surface-muted">
                        Belum ada menu. <a href="{{ route('admin.menu.create') }}" class="text-pit-brown font-semibold hover:underline">Tambah sekarang</a>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="pagination-wrapper p-4 flex justify-center">{{ $menus->links() }}</div>
</div>

@endsection
