@extends('admin.layouts.app')
@section('title', 'Dashboard')
@section('page-title', 'Dashboard Overview')

@section('content')

{{-- Bento Grid Stats --}}
<div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">

    {{-- Total Menu --}}
    <div class="bg-surface-card rounded-xl p-6 border border-outline-v/30 shadow-[0_4px_20px_rgba(75,54,33,0.04)] relative overflow-hidden group hover:shadow-[0_8px_30px_rgba(75,54,33,0.08)] transition-all duration-300">
        <div class="absolute top-0 right-0 w-32 h-32 bg-sec-container/20 rounded-bl-full -mr-8 -mt-8 transition-transform group-hover:scale-110 duration-500"></div>
        <div class="flex justify-between items-start mb-4 relative z-10">
            <div class="bg-sec-container text-sec-on p-3 rounded-lg">
                <span class="material-symbols-outlined">restaurant_menu</span>
            </div>
        </div>
        <div class="relative z-10">
            <h3 class="text-xs font-medium text-on-surface-muted uppercase tracking-wider mb-1">Total Menu</h3>
            <div class="text-4xl font-bold text-on-surface font-heading">{{ $stats['total_menu'] }}</div>
            <p class="text-xs text-on-surface-muted mt-2">Item menu aktif</p>
        </div>
    </div>

    {{-- Ulasan Pending --}}
    <div class="bg-surface-card rounded-xl p-6 border border-outline-v/30 shadow-[0_4px_20px_rgba(75,54,33,0.04)] relative overflow-hidden group hover:shadow-[0_8px_30px_rgba(75,54,33,0.08)] transition-all duration-300">
        <div class="absolute top-0 right-0 w-32 h-32 bg-tert-container/10 rounded-bl-full -mr-8 -mt-8 transition-transform group-hover:scale-110 duration-500"></div>
        <div class="flex justify-between items-start mb-4 relative z-10">
            <div class="bg-tert-container text-tert-on p-3 rounded-lg">
                <span class="material-symbols-outlined">rate_review</span>
            </div>
            @if($stats['pending_review'] > 0)
            <span class="flex items-center text-pit-danger text-xs font-semibold bg-pit-danger-bg px-2 py-1 rounded">
                <span class="material-symbols-outlined text-[14px] mr-1">info</span>
                Action Needed
            </span>
            @endif
        </div>
        <div class="relative z-10">
            <h3 class="text-xs font-medium text-on-surface-muted uppercase tracking-wider mb-1">Ulasan Pending</h3>
            <div class="text-4xl font-bold text-on-surface font-heading">{{ $stats['pending_review'] }}</div>
            <p class="text-xs text-on-surface-muted mt-2">Menunggu moderasi</p>
        </div>
    </div>

    {{-- Promo & Event --}}
    <div class="bg-surface-card rounded-xl p-6 border border-outline-v/30 shadow-[0_4px_20px_rgba(75,54,33,0.04)] relative overflow-hidden group hover:shadow-[0_8px_30px_rgba(75,54,33,0.08)] transition-all duration-300">
        <div class="absolute top-0 right-0 w-32 h-32 bg-pri-fixed/30 rounded-bl-full -mr-8 -mt-8 transition-transform group-hover:scale-110 duration-500"></div>
        <div class="flex justify-between items-start mb-4 relative z-10">
            <div class="bg-pri-fixed text-pri-on-fixed p-3 rounded-lg">
                <span class="material-symbols-outlined">campaign</span>
            </div>
        </div>
        <div class="relative z-10">
            <h3 class="text-xs font-medium text-on-surface-muted uppercase tracking-wider mb-1">Promo & Event</h3>
            <div class="text-4xl font-bold text-on-surface font-heading">{{ $stats['total_event'] }}</div>
            <p class="text-xs text-on-surface-muted mt-2">Kampanye aktif saat ini</p>
        </div>
    </div>
</div>

{{-- Recent Reviews --}}
<div class="bg-surface-card rounded-xl border border-outline-v/30 shadow-[0_4px_20px_rgba(75,54,33,0.04)] overflow-hidden">
    <div class="p-6 border-b border-surface-dim/50 flex justify-between items-center">
        <h2 class="font-heading font-semibold text-xl text-on-surface">Ulasan Terbaru</h2>
        <a href="{{ route('admin.review.index') }}"
           class="px-4 py-2 bg-surface-hover hover:bg-surface-dim text-on-surface text-xs font-semibold rounded-lg transition-colors flex items-center gap-2">
            Lihat Semua
            <span class="material-symbols-outlined text-[18px]">arrow_forward</span>
        </a>
    </div>
    <div class="divide-y divide-surface-dim/30">
        @forelse($latest_review as $rv)
        <div class="p-6 hover:bg-surface/50 transition-colors flex gap-5 items-start">
            <div class="w-12 h-12 rounded-full bg-tert-container text-tert-on flex items-center justify-center shrink-0 font-heading font-semibold text-lg">
                {{ strtoupper(substr($rv->nama_pengulas, 0, 1)) }}
            </div>
            <div class="flex-1">
                <div class="flex justify-between items-start mb-1">
                    <div>
                        <h4 class="text-xs font-semibold text-on-surface">{{ $rv->nama_pengulas }}</h4>
                        @if($rv->rating)
                        <div class="flex text-sec-on text-sm mt-1">
                            @for($i = 1; $i <= 5; $i++)
                                <span class="material-symbols-outlined {{ $i <= $rv->rating ? 'fill' : '' }}" style="font-size:16px;">star</span>
                            @endfor
                        </div>
                        @endif
                    </div>
                    <span class="text-xs text-on-surface-muted">{{ $rv->created_at->diffForHumans() }}</span>
                </div>
                <p class="text-sm text-on-surface-v mt-2 leading-relaxed">
                    {{ Str::limit($rv->ulasan, 120) }}
                </p>
                <div class="mt-3 flex gap-3">
                    <span class="text-xs font-semibold px-3 py-1 rounded
                        {{ $rv->status === 'approved' ? 'text-pit-success bg-pit-success-bg' : ($rv->status === 'rejected' ? 'text-pit-danger bg-pit-danger-bg' : 'text-pit-warning bg-pit-warning-bg') }}">
                        {{ ucfirst($rv->status) }}
                    </span>
                </div>
            </div>
        </div>
        @empty
        <div class="p-10 text-center text-on-surface-muted text-sm">
            Belum ada ulasan.
        </div>
        @endforelse
    </div>
</div>

@endsection
