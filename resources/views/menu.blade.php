@extends('layouts.app')

@section('title', 'Katalog Menu | Pituwolu')

@section('content')
<div class="pt-6 md:pt-8 pb-24 md:pb-32 bg-surface min-h-screen">
    <section id="menu" class="px-4 sm:px-6 md:px-8 max-w-screen-2xl mx-auto" x-data="menuLogic()">
        <div class="container mx-auto text-center">
            <span class="text-secondary font-label font-bold tracking-[0.2em] md:tracking-[0.3em] uppercase text-xs">Pilihan Menu</span>
            <h1 class="text-2xl sm:text-3xl md:text-6xl font-bold mt-3 md:mt-4 mb-8 md:mb-16 font-headline text-on-surface">Signature Drinks & Bites</h1>

            <!-- Menu Filter -->
            <div class="flex flex-wrap justify-center gap-2 sm:gap-3 md:gap-4 mb-12 md:mb-20 font-label">
                <button @click="activeFilter = 'all'"
                    :class="activeFilter === 'all' ? 'bg-primary text-on-primary shadow-lg' : 'bg-surface-container text-on-surface hover:bg-primary-container hover:text-on-primary-container shadow-sm'"
                    class="px-4 sm:px-6 md:px-8 py-2 md:py-3 rounded-full transition-all font-bold text-xs sm:text-sm tracking-wider uppercase">Semua Menu</button>
                @foreach($categories as $cat)
                <button @click="activeFilter = '{{ $cat->id }}'"
                    :class="activeFilter === '{{ $cat->id }}' ? 'bg-primary text-on-primary shadow-lg' : 'bg-surface-container text-on-surface hover:bg-primary-container hover:text-on-primary-container shadow-sm'"
                    class="px-4 sm:px-6 md:px-8 py-2 md:py-3 rounded-full transition-all font-bold text-xs sm:text-sm tracking-wider uppercase">{{ $cat->nama_kategori }}</button>
                @endforeach
            </div>

            @if($menuItems->count() > 0)
            <!-- Menu Grid — dynamic from DB -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 sm:gap-6 md:gap-10 text-left">
                @foreach($menuItems as $item)
                <div class="bg-surface-container-low border border-surface-container-highest rounded-[20px] sm:rounded-[24px] md:rounded-[32px] overflow-hidden shadow-sm hover:shadow-[0_32px_64px_rgba(23,52,24,0.08)] group transition-all duration-500 transform hover:-translate-y-2 flex flex-col items-center"
                     x-data="{ addIce: false }"
                     x-show="activeFilter === 'all' || activeFilter === '{{ $item->category_id }}'">
                    <div class="relative overflow-hidden h-48 sm:h-64 md:h-80 w-full mb-1 sm:mb-2 p-3 sm:p-4 pb-0">
                        <div class="absolute top-6 sm:top-8 right-6 sm:right-8 z-10"></div>
                        @if($item->foto)
                            <img src="{{ Storage::url($item->foto) }}" 
                                 alt="{{ $item->nama_menu }}"
                                 class="w-full h-full object-cover rounded-2xl sm:rounded-3xl transition duration-700 group-hover:scale-[1.05] cursor-zoom-in">
                        @else
                            <div class="w-full h-full rounded-2xl sm:rounded-3xl bg-surface-container flex items-center justify-center text-4xl sm:text-6xl">☕</div>
                        @endif
                    </div>
                    <div class="p-4 sm:p-6 md:p-8 pt-3 sm:pt-4 md:pt-6 flex-1 flex flex-col justify-between w-full">
                        <div>
                            <div class="flex flex-col mb-3 md:mb-4">
                                <span class="text-xs font-label font-bold text-secondary uppercase tracking-wider mb-1">{{ $item->category->nama_kategori ?? 'Uncategorized' }}</span>
                                <h3 class="text-lg sm:text-2xl md:text-3xl font-bold text-on-surface font-headline mb-2 line-clamp-2">{{ $item->nama_menu }}</h3>
                                <p class="text-on-surface-variant font-body text-xs sm:text-sm leading-relaxed line-clamp-2">{{ $item->deskripsi ?? 'Produk berkualitas dari Pituwolu' }}</p>
                            </div>
                        </div>

                        {{-- Ice Option Checkbox --}}
                        @if($item->is_ice_available)
                        <label class="flex items-center gap-2 cursor-pointer px-3 py-2 rounded-xl bg-surface-container/50 border border-surface-container-highest mb-3 select-none hover:bg-surface-container transition-colors">
                            <input type="checkbox" x-model="addIce"
                                   class="w-4 h-4 rounded accent-[#173418] cursor-pointer">
                            <span class="text-xs font-label font-semibold text-on-surface">Tambah Es</span>
                            <span class="text-xs font-label font-bold text-secondary ml-auto">(+Rp {{ number_format($item->ice_extra_price, 0, ',', '.') }})</span>
                        </label>
                        @endif

                        <div class="flex items-center justify-between mt-2 md:mt-4 border-t border-surface-variant pt-4 md:pt-6">
                            <div>
                                <span class="text-primary font-label font-bold text-base md:text-xl whitespace-nowrap"
                                      x-text="addIce ? 'Rp {{ number_format($item->harga + $item->ice_extra_price, 0, ',', '.') }}' : 'Rp {{ number_format($item->harga, 0, ',', '.') }}'"></span>
                                <div x-show="addIce" class="text-[10px] text-on-surface-variant mt-0.5 font-label">
                                    Rp {{ number_format($item->harga, 0, ',', '.') }} + Es Rp {{ number_format($item->ice_extra_price, 0, ',', '.') }}
                                </div>
                            </div>
                            <button
                                @click="addToCart({
                                    id: {{ $item->id }} + (addIce ? 10000 : 0),
                                    title: '{{ addslashes($item->nama_menu) }}' + (addIce ? ' (Ice)' : ''),
                                    price: addIce ? 'Rp {{ number_format($item->harga + $item->ice_extra_price, 0, ',', '.') }}' : 'Rp {{ number_format($item->harga, 0, ',', '.') }}',
                                    priceNumber: addIce ? {{ $item->harga + $item->ice_extra_price }} : {{ $item->harga }},
                                    image: '{{ $item->foto ? Storage::url($item->foto) : '' }}'
                                })"
                                class="bg-primary-container text-on-primary-container hover:bg-primary hover:text-on-primary w-10 h-10 md:w-12 md:h-12 rounded-full flex items-center justify-center transition-transform hover:scale-110 shadow-sm" aria-label="Add to cart">
                                <span class="material-symbols-outlined text-base md:text-lg">add_shopping_cart</span>
                            </button>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

            @else
            {{-- Fallback: belum ada menu di DB, tampilkan hardcoded --}}
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10 text-left">
                <template x-for="(item, index) in menuItems" :key="item.id">
                    <div class="bg-surface-container-low border border-surface-container-highest rounded-[32px] overflow-hidden shadow-sm hover:shadow-[0_32px_64px_rgba(23,52,24,0.08)] group transition-all duration-500 transform hover:-translate-y-2 flex flex-col items-center"
                         x-show="activeFilter === 'all' || activeFilter === item.type">
                        <div class="relative overflow-hidden h-80 w-full mb-2 p-4 pb-0">
                            <div x-show="item.badge" class="absolute top-8 right-8 z-10" style="display: none;">
                                <span x-text="item.badge" class="bg-primary text-on-primary text-[10px] font-bold px-3 py-1.5 rounded-full font-label tracking-widest uppercase shadow-md pointer-events-none"></span>
                            </div>
                            <img :src="item.image" :alt="item.title" @click="$dispatch('open-lightbox', item.image)" class="w-full h-full object-cover rounded-3xl transition duration-700 group-hover:scale-[1.05] cursor-zoom-in">
                        </div>
                        <div class="p-8 pt-6 flex-1 flex flex-col justify-between w-full">
                            <div>
                                <div class="flex flex-col mb-4">
                                    <h3 class="text-3xl font-bold text-on-surface font-headline mb-2" x-text="item.title"></h3>
                                    <p class="text-on-surface-variant font-body text-sm leading-relaxed" x-text="item.desc"></p>
                                </div>
                            </div>
                            <div class="flex items-center justify-between mt-8 border-t border-surface-variant pt-6">
                                <span class="text-primary font-label font-bold text-xl whitespace-nowrap" x-text="item.price"></span>
                                <button @click="addToCart(item)" class="bg-primary-container text-on-primary-container hover:bg-primary hover:text-on-primary w-12 h-12 rounded-full flex items-center justify-center transition-transform hover:scale-110 shadow-sm" aria-label="Add to cart">
                                    <span class="material-symbols-outlined text-lg">add_shopping_cart</span>
                                </button>
                            </div>
                        </div>
                    </div>
                </template>
            </div>
            @endif

            <div x-show="activeFilter !== 'all'" class="hidden py-12 text-center" id="empty-msg">
                <span class="material-symbols-outlined text-6xl text-on-surface-variant mb-4">sentiment_dissatisfied</span>
                <p class="text-on-surface-variant text-xl font-headline italic">Tidak ada menu yang ditemukan untuk kategori ini.</p>
            </div>
        </div>
    </section>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('alpine:init', () => {
        Alpine.data('menuLogic', () => ({
            activeFilter: 'all',
            // Fallback hardcoded menu (hanya dipakai jika DB kosong)
            menuItems: [
                { id: 1, type: 'coffee', image: 'https://images.unsplash.com/photo-1541167760496-1628856ab772?q=80&w=1937&auto=format&fit=crop', title: 'Forest Latte', price: 'Rp 32.000', priceNumber: 32000, desc: 'Signature latte dengan sentuhan ekstrak pandan alami dan gula aren spesial.', badge: 'Best Seller' },
                { id: 2, type: 'coffee', image: 'https://images.unsplash.com/photo-1495474472287-4d71bcdd2085?q=80&w=2070&auto=format&fit=crop', title: 'Pituwolu Cappuccino', price: 'Rp 28.000', priceNumber: 28000, desc: 'Perpaduan seimbang espresso premium dan susu organik berbusa lembut yang hangat.' },
                { id: 3, type: 'non-coffee', image: 'https://images.unsplash.com/photo-1597403491447-3ab08f8e44dc?q=80&w=1974&auto=format&fit=crop', title: 'Organic Matcha', price: 'Rp 35.000', priceNumber: 35000, desc: 'Teh hijau jepang organik dengan susu kedelai atau oatmilk pilihan yang sehat.', badge: 'Must Try' },
                { id: 4, type: 'snacks', image: 'https://images.unsplash.com/photo-1495147466023-ac5c588e2e94?q=80&w=1974&auto=format&fit=crop', title: 'Almond Croissant', price: 'Rp 25.000', priceNumber: 25000, desc: 'Pastry renyah dengan isian krim almond melimpah dan taburan almond panggang.', badge: 'Recommended' },
            ],
        }));
    });
</script>
@endpush
