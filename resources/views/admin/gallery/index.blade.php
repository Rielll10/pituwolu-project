@extends('admin.layouts.app')
@section('title', 'Kelola Galeri | Admin Pituwolu')
@section('page-title', 'Kelola Galeri')

@section('content')

<div class="bg-surface-card rounded-xl border border-outline-v/30 shadow-[0_4px_20px_rgba(75,54,33,0.04)] overflow-hidden">
    <div class="p-6 border-b border-surface-dim/50 flex justify-between items-center">
        <h2 class="font-heading font-semibold text-xl text-on-surface">Daftar Galeri</h2>
        <a href="{{ route('admin.gallery.create') }}"
           class="px-4 py-2.5 bg-pit-primary hover:bg-pit-primary/90 text-white text-xs font-semibold rounded-lg transition-all flex items-center gap-2 shadow-sm">
            <span class="material-symbols-outlined text-[16px]">add</span> Tambah Galeri
        </a>
    </div>
    <div class="overflow-x-auto">
        <table class="w-full text-sm">
            <thead>
                <tr class="border-b-2 border-surface-dim/50">
                    <th class="px-6 py-3 text-left text-[11px] font-semibold uppercase tracking-wider text-on-surface-muted">Foto</th>
                    <th class="px-6 py-3 text-left text-[11px] font-semibold uppercase tracking-wider text-on-surface-muted">Judul</th>
                    <th class="px-6 py-3 text-left text-[11px] font-semibold uppercase tracking-wider text-on-surface-muted">Deskripsi</th>
                    <th class="px-6 py-3 text-center text-[11px] font-semibold uppercase tracking-wider text-on-surface-muted">Urutan</th>
                    <th class="px-6 py-3 text-left text-[11px] font-semibold uppercase tracking-wider text-on-surface-muted">Status</th>
                    <th class="px-6 py-3 text-left text-[11px] font-semibold uppercase tracking-wider text-on-surface-muted">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-surface-dim/30">
                @forelse($galleries as $gallery)
                <tr class="hover:bg-surface/50 transition-colors">
                    <td class="px-6 py-4">
                        @if($gallery->image)
                            @if(str_starts_with($gallery->image, 'http'))
                                <img src="{{ $gallery->image }}" alt="{{ $gallery->title }}"
                                     class="w-14 h-14 object-cover rounded-xl border border-outline-v/50">
                            @else
                                <img src="{{ Storage::url($gallery->image) }}" alt="{{ $gallery->title }}"
                                     class="w-14 h-14 object-cover rounded-xl border border-outline-v/50">
                            @endif
                        @else
                            <div class="w-14 h-14 bg-surface-hover rounded-xl flex items-center justify-center text-on-surface-muted border border-outline-v/50">
                                <span class="material-symbols-outlined">image</span>
                            </div>
                        @endif
                    </td>
                    <td class="px-6 py-4">
                        <div class="font-semibold text-on-surface">{{ $gallery->title }}</div>
                    </td>
                    <td class="px-6 py-4">
                        <span class="text-xs text-on-surface-muted">{{ Str::limit($gallery->description, 40) }}</span>
                    </td>
                    <td class="px-6 py-4 text-center">
                        <span class="font-semibold text-pit-brown">#{{ $gallery->sort_order }}</span>
                    </td>
                    <td class="px-6 py-4">
                        <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-semibold
                            {{ $gallery->is_active ? 'bg-pit-success-bg text-pit-success' : 'bg-pit-danger-bg text-pit-danger' }}">
                            {{ $gallery->is_active ? 'Aktif' : 'Non-Aktif' }}
                        </span>
                    </td>
                    <td class="px-6 py-4">
                        <div class="flex gap-2">
                            <a href="{{ route('admin.gallery.edit', $gallery) }}"
                               class="px-3 py-1.5 text-xs font-semibold text-on-surface-v border border-outline-v/50 rounded-lg hover:bg-surface-hover transition-colors flex items-center gap-1">
                                <span class="material-symbols-outlined text-[14px]">edit</span> Edit
                            </a>
                            <form method="POST" action="{{ route('admin.gallery.destroy', $gallery) }}"
                                  class="swal-confirm" data-swal-title="Hapus Galeri?" data-swal-text="Galeri {{ $gallery->title }} akan dihapus permanen.">
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
                        Belum ada galeri. <a href="{{ route('admin.gallery.create') }}" class="text-pit-brown font-semibold hover:underline">Tambah sekarang</a>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="pagination-wrapper p-4 flex justify-center">{{ $galleries->links() }}</div>
</div>

@endsection