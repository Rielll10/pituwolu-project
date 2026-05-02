@extends('layouts.app')

@section('title', 'Galeri Estetik | Pituwolu')

@section('content')
<div class="pt-6 md:pt-8 pb-24 md:pb-32 bg-surface min-h-screen">
    <div class="max-w-screen-2xl mx-auto px-4 sm:px-6 md:px-8 text-center">
        <span class="text-secondary tracking-[0.2em] md:tracking-[0.3em] font-label font-bold uppercase text-xs mb-3 md:mb-4 block">Sudut Pituwolu</span>
        <h1 class="text-2xl sm:text-3xl md:text-6xl font-bold mt-2 mb-8 md:mb-16 font-headline text-on-surface">Kenyamanan dalam Pituwolu</h1>

        @if($galleries->count() > 0)
        <!-- Instagram Grid Layout -->
        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-2 sm:gap-4 md:gap-6 max-w-xl md:max-w-5xl lg:max-w-full mx-auto" x-data="{}">
            @foreach($galleries as $gallery)
            <div class="aspect-square relative overflow-hidden rounded-sm sm:rounded-md md:rounded-[24px] group cursor-pointer shadow-sm border border-surface-container-highest break-inside-avoid" 
                 @click="$dispatch('open-lightbox', '{{ str_starts_with($gallery->image, 'http') ? $gallery->image : Storage::url($gallery->image) }}')">
                <img src="{{ str_starts_with($gallery->image, 'http') ? $gallery->image : Storage::url($gallery->image) }}" 
                     alt="{{ $gallery->title }}" 
                     class="w-full h-full object-cover transition duration-1000 group-hover:scale-110">
                <div class="absolute inset-0 bg-black/0 group-hover:bg-black/20 transition duration-500 flex items-center justify-center">
                </div>
                @if($gallery->title)
                <div class="absolute inset-0 opacity-0 group-hover:opacity-100 transition duration-500 flex items-end justify-start p-3 sm:p-4 md:p-6 bg-gradient-to-t from-black/60 via-black/20 to-transparent">
                    <div class="text-white hidden md:block">
                        <h3 class="text-sm md:text-lg font-bold truncate">{{ $gallery->title }}</h3>
                        @if($gallery->description)
                        <p class="text-[10px] md:text-sm text-white/80 line-clamp-2">{{ $gallery->description }}</p>
                        @endif
                    </div>
                </div>
                @endif
            </div>
            @endforeach
        </div>
        @else
        <div class="text-center py-12">
            <span class="material-symbols-outlined text-6xl text-on-surface-variant mb-4 block">image_not_supported</span>
            <p class="text-on-surface-variant text-lg">Belum ada galeri yang ditambahkan.</p>
        </div>
        @endif
    </div>
</div>
@endsection
