@extends('admin.layouts.app')
@section('title', 'Promo & Event')
@section('page-title', 'Promo & Events')

@section('content')

<div class="bg-surface-card rounded-xl border border-outline-v/30 shadow-[0_4px_20px_rgba(75,54,33,0.04)] overflow-hidden">
    <div class="p-6 border-b border-surface-dim/50 flex justify-between items-center">
        <h2 class="font-heading font-semibold text-xl text-on-surface">Daftar Promo & Event</h2>
        <div class="flex gap-3 items-center">
            <form method="GET">
                <select name="type" onchange="this.form.submit()"
                        class="px-3 py-2 border border-outline-v/50 rounded-lg text-xs text-on-surface bg-white focus:border-pit-brown outline-none transition-all">
                    <option value="">Semua Tipe</option>
                    <option value="promo" {{ request('type')=='promo' ? 'selected' : '' }}>🏷️ Promo</option>
                    <option value="event" {{ request('type')=='event' ? 'selected' : '' }}>🎉 Event</option>
                </select>
            </form>
            <a href="{{ route('admin.event.create') }}"
               class="px-4 py-2.5 bg-pit-primary hover:bg-pit-primary/90 text-white text-xs font-semibold rounded-lg transition-all flex items-center gap-2 shadow-sm">
                <span class="material-symbols-outlined text-[16px]">add_photo_alternate</span> Tambah Baru
            </a>
        </div>
    </div>
    <div class="p-6">
        @if($events->count() > 0)
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5">
            @foreach($events as $ev)
            <div class="bg-white border border-outline-v/30 rounded-2xl overflow-hidden shadow-sm hover:shadow-lg transition-all duration-300 group">
                {{-- Image --}}
                <div class="relative h-48 bg-surface-hover overflow-hidden">
                    @if($ev->image)
                        <img src="{{ Storage::url($ev->image) }}" alt="{{ $ev->title }}"
                             class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                    @else
                        <div class="w-full h-full flex items-center justify-center text-5xl text-outline-v">
                            {{ $ev->type === 'promo' ? '🏷️' : '🎉' }}
                        </div>
                    @endif

                    {{-- Type badge --}}
                    <div class="absolute top-3 left-3">
                        <span class="px-3 py-1 rounded-full text-[11px] font-bold
                            {{ $ev->type === 'promo' ? 'bg-pit-warning-bg text-pit-warning' : 'bg-pit-info-bg text-pit-info' }}">
                            {{ $ev->type === 'promo' ? '🏷️ Promo' : '🎉 Event' }}
                        </span>
                    </div>

                    {{-- Status badge --}}
                    <div class="absolute top-3 right-3">
                        <span class="px-2.5 py-1 rounded-full text-[11px] font-bold
                            {{ $ev->is_active ? 'bg-pit-success-bg text-pit-success' : 'bg-pit-danger-bg text-pit-danger' }}">
                            {{ $ev->is_active ? '● Aktif' : '○ Hidden' }}
                        </span>
                    </div>
                </div>

                {{-- Info --}}
                <div class="p-4">
                    <h4 class="text-sm font-bold text-on-surface mb-2 leading-tight">{{ $ev->title }}</h4>

                    @if($ev->start_date || $ev->end_date)
                    <div class="text-[11px] text-on-surface-muted mb-3 flex items-center gap-1">
                        <span class="material-symbols-outlined text-[14px]">calendar_today</span>
                        @if($ev->start_date) {{ $ev->start_date->format('d M Y') }} @endif
                        @if($ev->end_date) — {{ $ev->end_date->format('d M Y') }} @endif
                    </div>
                    @endif

                    {{-- Actions --}}
                    <div class="flex gap-2 border-t border-surface-dim/30 pt-3 mt-1">
                        <a href="{{ route('admin.event.edit', $ev) }}"
                           class="flex-1 py-2 text-center text-xs font-semibold text-on-surface-v border border-outline-v/50 rounded-lg hover:bg-surface-hover transition-colors flex items-center justify-center gap-1">
                            <span class="material-symbols-outlined text-[14px]">edit</span> Edit
                        </a>
                        <form method="POST" action="{{ route('admin.event.destroy', $ev) }}"
                              class="flex-1 swal-confirm" data-swal-title="Hapus Konten?" data-swal-text="Konten {{ $ev->title }} akan dihapus permanen.">
                            @csrf @method('DELETE')
                            <button type="submit"
                                    class="w-full py-2 text-center text-xs font-semibold text-pit-danger bg-pit-danger-bg hover:bg-pit-danger-bg/80 rounded-lg transition-colors flex items-center justify-center gap-1">
                                <span class="material-symbols-outlined text-[14px]">delete</span> Hapus
                            </button>
                        </form>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <div class="pagination-wrapper mt-6 flex justify-center">{{ $events->links() }}</div>

        @else
        <div class="text-center py-16">
            <div class="text-5xl mb-4">🎉</div>
            <p class="text-base font-semibold text-on-surface-v">Belum ada promo atau event.</p>
            <p class="text-sm text-on-surface-muted mt-1 mb-5">Tambahkan konten untuk ditampilkan di website.</p>
            <a href="{{ route('admin.event.create') }}"
               class="inline-flex items-center gap-2 px-5 py-2.5 bg-pit-primary hover:bg-pit-primary/90 text-white text-sm font-semibold rounded-lg transition-all shadow-sm">
                + Tambah Sekarang
            </a>
        </div>
        @endif
    </div>
</div>

@endsection
