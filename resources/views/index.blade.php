@extends('layouts.app')

@section('content')
    <!-- Hero Section -->
    <header class="relative min-h-screen flex items-center pt-16 md:pt-20 overflow-hidden">
        <div class="absolute inset-0 z-0">
            <img class="w-full h-full object-cover"
                alt="Pituwolu Coffee Interior"
                src="{{ asset('banner.png') }}?v={{ @filemtime(public_path('banner.png')) }}" />
            <div class="absolute inset-0 bg-gradient-to-r from-primary/90 via-primary/40 to-transparent"></div>
        </div>
        <div class="relative z-10 max-w-screen-2xl mx-auto px-5 sm:px-6 md:px-8 w-full">
            <div class="max-w-2xl">
                <h1 class="font-headline text-4xl sm:text-5xl md:text-7xl lg:text-8xl text-white dark:text-[#F5E6D3] leading-[1.1] mb-4 md:mb-8">
                    Setiap Langkah, Menuai Kisah <br />
                    <span class="serif-italic font-light"></span>
                </h1>
                <p class="text-[#F5E6D3] drop-shadow-md text-base sm:text-lg md:text-xl font-body max-w-lg mb-6 md:mb-10 leading-relaxed font-medium">
                   Tempat sederhana untuk berbagi cerita bersama dan merangkai makna menjadi sebuah kisah yang indah
                </p>
                <div class="flex flex-col sm:flex-row gap-3 sm:gap-4">
                    <a href="/menu"
                        class="bg-primary text-on-primary px-6 sm:px-10 py-3.5 md:py-4 rounded-full font-label font-bold text-sm hover:translate-y-[-4px] transition-all shadow-xl inline-block text-center">
                        LIHAT MENU
                    </a>
                    <a href="/about"
                        class="bg-white/10 backdrop-blur-md text-white border border-white/20 px-6 sm:px-10 py-3.5 md:py-4 rounded-full font-label font-bold text-sm hover:bg-white/20 transition-all inline-block text-center">
                        TENTANG KAMI
                    </a>
                </div>
            </div>
        </div>
    </header>

    <!-- Sekilas Tentang Pituwolu Section -->
    <section class="relative bg-surface py-20 lg:py-32 overflow-hidden" id="about-preview">
        <!-- Watermark -->
        <div class="absolute top-10 left-0 w-full flex justify-center pointer-events-none opacity-[0.03] z-0 overflow-hidden">
            <h2 class="text-[12vw] font-headline font-black whitespace-nowrap tracking-widest text-on-surface">our story our story</h2>
        </div>

        <div class="max-w-screen-xl mx-auto px-6 md:px-8 relative z-10">
            <!-- Title -->
            <h2 class="text-4xl sm:text-5xl md:text-6xl lg:text-7xl font-headline font-bold text-[#0D4C38] dark:text-primary mb-10 md:mb-16">
                Our Story
            </h2>

            <div class="flex flex-col lg:flex-row gap-10 md:gap-16 lg:gap-20 items-center">
                <!-- Foto di Kiri -->
                <div class="w-full lg:w-1/2 relative shrink-0">
                    <img src="{{ asset('cerita-kami.jpeg') }}"
                        alt="Pituwolu Coffee Interior"
                        class="w-full h-auto aspect-square md:aspect-[4/3] object-cover rounded-[2.5rem] md:rounded-[3rem] shadow-lg">
                </div>

                <!-- Teks di Kanan -->
                <div class="w-full lg:w-1/2 flex flex-col justify-center">
                    <div class="space-y-6 text-on-surface-variant font-body text-base lg:text-[17px] leading-[1.8] mb-8 md:mb-10">
                        <p>
                            Berdiri pada tahun 2024, Pituwolu lahir dari keinginan sederhana: "Menyatukan kecintaan terhadap gaya hidup urban modern dengan konsep rumah dengan taman yang asri dan memberikan nuansa tentram yang menciptakan berbagai moment tak terlupakan".
                        </p>
                        <p>
                            Nama <strong class="text-on-surface font-headline font-normal">"Pituwolu"</strong> berasal dari bahasa Jawa yang melambangkan filosofi keberkahan dan amanat. Kami percaya bahwa di rumah kami bisa membawa keberkahan bagi semua.
                        </p>
                    </div>
                    <div>
                        <a href="/about"
                            class="inline-flex items-center gap-2 bg-[#0D4C38] text-white px-8 py-3.5 rounded-full font-body font-semibold text-[15px] hover:bg-[#093628] hover:shadow-xl transition-all duration-300">
                            Selengkapnya <span class="material-symbols-outlined text-[16px] font-bold">chevron_right</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Best Sellers Section -->
    <section class="py-20 md:py-32 bg-surface overflow-hidden">
        <div class="max-w-screen-2xl mx-auto px-6 md:px-8">
            <div class="flex flex-col md:flex-row justify-between items-start md:items-end mb-12 md:mb-20 gap-6">
                <div>
                    <h2 class="font-label text-secondary tracking-widest text-sm font-bold mb-4">FAVORITES</h2>
                    <h3 class="font-headline text-4xl md:text-5xl text-on-surface">Menu Best Seller Kami</h3>
                </div>
                <a class="text-on-surface-variant font-label text-sm border-b border-outline/30 pb-1 hover:text-primary transition-colors"
                    href="/menu">LIHAT SEMUA MENU</a>
            </div>

            <!-- Swiper Container for Best Sellers -->
            <div class="swiper bestseller-swiper pb-16 overflow-visible">
                <div class="swiper-wrapper">
                    @forelse($bestSellers as $bs)
                    <div class="swiper-slide !h-auto" x-data="{ addIce: false }">
                        <div class="group flex flex-col h-full transition-transform duration-500">
                            <div class="aspect-[4/5] rounded-3xl overflow-hidden mb-6 bg-surface-container-low relative w-full border border-surface-container-highest">
                                @if($bs->foto)
                                    <img class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700"
                                         src="{{ Storage::url($bs->foto) }}" alt="{{ $bs->nama_menu }}" />
                                @else
                                    <div class="w-full h-full flex items-center justify-center text-6xl bg-surface-container">☕</div>
                                @endif
                                <div class="absolute top-4 right-4 bg-primary text-on-primary font-label text-[10px] font-bold px-3 py-1 rounded-full">
                                    BEST SELLER</div>
                            </div>
                            <div class="flex flex-col flex-grow">
                                <span class="text-xs font-label font-bold text-secondary uppercase tracking-wider mb-1">{{ $bs->category->nama_kategori ?? '' }}</span>
                                <h4 class="font-headline text-2xl mb-1 text-on-surface">{{ $bs->nama_menu }}</h4>
                                <p class="text-on-surface-variant font-body text-sm mb-4 flex-grow">{{ Str::limit($bs->deskripsi, 60) }}</p>

                                {{-- Ice Option Checkbox --}}
                                @if($bs->is_ice_available)
                                <label class="flex items-center gap-2 cursor-pointer px-3 py-2 rounded-xl bg-surface-container/50 border border-surface-container-highest mb-3 select-none hover:bg-surface-container transition-colors w-full">
                                    <input type="checkbox" x-model="addIce"
                                           class="w-4 h-4 rounded accent-[#173418] cursor-pointer">
                                    <span class="text-xs font-label font-semibold text-on-surface">Tambah Es</span>
                                    <span class="text-[10px] font-label font-bold text-secondary ml-auto">(+Rp {{ number_format($bs->ice_extra_price, 0, ',', '.') }})</span>
                                </label>
                                @endif

                                <div class="flex items-center justify-between mt-auto pt-4 border-t border-surface-variant">
                                    <div>
                                        <p class="text-primary font-label font-bold text-lg" x-text="addIce ? 'Rp {{ number_format($bs->harga + $bs->ice_extra_price, 0, ',', '.') }}' : 'Rp {{ number_format($bs->harga, 0, ',', '.') }}'"></p>
                                        <div x-show="addIce" class="text-[10px] text-on-surface-variant mt-0.5 font-label">
                                            Rp {{ number_format($bs->harga, 0, ',', '.') }} + Es
                                        </div>
                                    </div>
                                    <button @click="addToCart({ 
                                            id: {{ $bs->id }} + (addIce ? 10000 : 0), 
                                            title: '{{ addslashes($bs->nama_menu) }}' + (addIce ? ' (Ice)' : ''), 
                                            price: addIce ? 'Rp {{ number_format($bs->harga + $bs->ice_extra_price, 0, ',', '.') }}' : 'Rp {{ number_format($bs->harga, 0, ',', '.') }}', 
                                            priceNumber: addIce ? {{ $bs->harga + $bs->ice_extra_price }} : {{ $bs->harga }}, 
                                            image: '{{ $bs->foto ? Storage::url($bs->foto) : '' }}' 
                                        })"
                                        class="bg-primary-container text-on-primary-container hover:bg-primary hover:text-on-primary w-10 h-10 rounded-full flex items-center justify-center transition-colors shadow-sm"
                                        aria-label="Add to cart">
                                        <span class="material-symbols-outlined text-sm">add_shopping_cart</span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    @empty
                    {{-- Fallback hardcoded when no best sellers set --}}
                    <div class="swiper-slide !h-auto" x-data>
                        <div class="group flex flex-col h-full">
                            <div class="aspect-[4/5] rounded-3xl overflow-hidden mb-6 bg-surface-container-low relative w-full border border-surface-container-highest">
                                <img class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700"
                                     src="https://images.unsplash.com/photo-1541167760496-1628856ab772?q=80&w=600&auto=format&fit=crop" alt="Forest Latte" />
                                <div class="absolute top-4 right-4 bg-primary text-on-primary font-label text-[10px] font-bold px-3 py-1 rounded-full">MUST TRY</div>
                            </div>
                            <div class="flex flex-col flex-grow">
                                <h4 class="font-headline text-2xl mb-1 text-on-surface">Forest Latte</h4>
                                <p class="text-on-surface-variant font-body text-sm mb-4 flex-grow">House-made matcha with botanical infusions</p>
                                <div class="flex items-center justify-between mt-auto pt-2">
                                    <p class="text-primary font-label font-bold text-lg">Rp 38.000</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="swiper-slide !h-auto" x-data>
                        <div class="group flex flex-col h-full">
                            <div class="aspect-[4/5] rounded-3xl overflow-hidden mb-6 bg-surface-container-low relative w-full border border-surface-container-highest">
                                <img class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700"
                                     src="https://images.unsplash.com/photo-1495147466023-ac5c588e2e94?q=80&w=600&auto=format&fit=crop" alt="Almond Croissant" />
                            </div>
                            <div class="flex flex-col flex-grow">
                                <h4 class="font-headline text-2xl mb-1 text-on-surface">Almond Croissant</h4>
                                <p class="text-on-surface-variant font-body text-sm mb-4 flex-grow">Double-baked with artisanal almond cream</p>
                                <div class="flex items-center justify-between mt-auto pt-2">
                                    <p class="text-primary font-label font-bold text-lg">Rp 32.000</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforelse
                </div>
                <!-- Controls -->
                <div class="flex justify-center items-center gap-6 mt-12">
                    <button
                        class="swiper-prev-best w-12 h-12 rounded-full border border-outline/20 flex items-center justify-center text-on-surface-variant hover:bg-primary hover:text-on-primary hover:border-primary transition-all">
                        <span class="material-symbols-outlined">west</span>
                    </button>
                    <div class="swiper-pagination-best !static !w-auto"></div>
                    <button
                        class="swiper-next-best w-12 h-12 rounded-full border border-outline/20 flex items-center justify-center text-on-surface-variant hover:bg-primary hover:text-on-primary hover:border-primary transition-all">
                        <span class="material-symbols-outlined">east</span>
                    </button>
                </div>
            </div>

        </div>
    </section>

    <!-- Promo & Acara Section Revamped -->
    <section class="py-20 md:py-32 bg-surface overflow-hidden relative">

        <!-- WATERMARK BG untuk PROMO -->
        <div
            class="absolute top-10 left-0 w-full flex justify-center pointer-events-none opacity-[0.03] z-0 overflow-hidden">
            <h2 class="text-[12vw] font-headline font-black whitespace-nowrap tracking-widest uppercase">
            </h2>
        </div>

        <!-- PROMO SECTION -->
        <div class="max-w-screen-2xl mx-auto px-6 md:px-8 relative z-10 mb-32">
            <div class="flex flex-col items-center mb-12 text-center">
                <h3 class="font-headline text-5xl md:text-6xl text-on-surface font-black mb-4">Promo di Pituwolu</h3>
                <p class="text-on-surface-variant font-body text-lg">Temukan berbagai promo menarik dari kami!</p>
            </div>

            @if($promos->count() > 0)
            <!-- Swiper Container for PROMO -->
            <div class="swiper promo-swiper pb-16 overflow-visible">
                <div class="swiper-wrapper">
                    @foreach($promos as $promo)
                        {{-- Dynamic Promo Card from DB --}}
                        <div class="swiper-slide !w-[85vw] md:!w-[450px] !h-auto">
                            @if($promo->link)
                                <a href="{{ $promo->link }}" target="_blank" class="block relative rounded-[40px] overflow-hidden group shadow-sm hover:shadow-xl transition-all duration-500 bg-surface-container cursor-pointer">
                            @else
                                <div @click="$dispatch('open-lightbox', '{{ Storage::url($promo->image) }}')" class="relative rounded-[40px] overflow-hidden group shadow-sm hover:shadow-xl transition-all duration-500 bg-surface-container cursor-zoom-in">
                            @endif
                            
                                @if ($promo->image)
                                    <img src="{{ Storage::url($promo->image) }}" alt="{{ $promo->title }}"
                                        class="block w-full h-auto group-hover:scale-105 transition-transform duration-500">
                                @endif
                                
                                @if ($promo->end_date)
                                    <div class="absolute bottom-6 right-6 z-20">
                                        <span class="bg-black/50 backdrop-blur-md text-white px-4 py-2 rounded-full font-label text-xs font-bold shadow-lg">
                                            s/d {{ $promo->end_date->format('d M') }}
                                        </span>
                                    </div>
                                @endif
                                
                            @if($promo->link)
                                </a>
                            @else
                                </div>
                            @endif
                        </div>
                    @endforeach
                </div>
                <!-- Pagination -->
                <div class="swiper-pagination !static !mt-8"></div>
            </div>
            @else
            <div class="w-full flex justify-center py-10">
                <div class="text-center bg-surface-container border border-outline-variant/30 px-8 py-16 md:py-24 rounded-[40px] w-full max-w-3xl mx-auto shadow-sm flex flex-col items-center justify-center">
                    <div class="w-24 h-24 bg-primary-container/50 rounded-full flex items-center justify-center mb-6 shadow-inner mx-auto border border-primary/10">
                        <span class="material-symbols-outlined text-5xl text-primary" style="font-variation-settings: 'FILL' 1;">campaign</span>
                    </div>
                    <h4 class="font-headline text-3xl md:text-4xl text-on-surface font-bold mb-3">Promo Coming Soon</h4>
                    <p class="text-on-surface-variant font-body text-lg max-w-md mx-auto">Belum ada promo aktif saat ini. Nantikan penawaran spesial dan kejutan menarik dari Pituwolu!</p>
                </div>
            </div>
            @endif
        </div>

        <!-- WATERMARK BG untuk KESERUAN -->
        <div
            class="absolute bottom-[20%] left-0 w-full flex justify-center pointer-events-none opacity-[0.03] z-0 overflow-hidden">
            <h2 class="text-[12vw] font-headline font-black whitespace-nowrap tracking-widest uppercase"></h2>
        </div>

        <!-- KESERUAN SECTION -->
        <div class="max-w-screen-2xl mx-auto px-6 md:px-8 relative z-10">
            <div class="flex flex-col items-center mb-12 text-center">
                <h3 class="font-headline text-5xl md:text-6xl text-on-surface font-black mb-4">Keseruan di Pituwolu</h3>
                <p class="text-on-surface-variant font-body text-lg">Jadwal live music, acara nobar, hingga sesi komunitas.
                </p>
            </div>

            @if($events->count() > 0)
            <!-- Swiper Container for KESERUAN -->
            <div class="swiper event-swiper pb-16 overflow-visible">
                <div class="swiper-wrapper">
                    @foreach($events as $ev)
                        {{-- Dynamic Event Card from DB --}}
                        <div class="swiper-slide !w-[85vw] md:!w-[450px] !h-auto">
                            @if($ev->link)
                                <a href="{{ $ev->link }}" target="_blank" class="block relative rounded-[40px] overflow-hidden group shadow-sm hover:shadow-xl transition-all duration-500 bg-surface-container cursor-pointer">
                            @else
                                <div @click="$dispatch('open-lightbox', '{{ Storage::url($ev->image) }}')" class="relative rounded-[40px] overflow-hidden group shadow-sm hover:shadow-xl transition-all duration-500 bg-surface-container cursor-zoom-in">
                            @endif
                            
                                @if ($ev->image)
                                    <img src="{{ Storage::url($ev->image) }}" alt="{{ $ev->title }}"
                                        class="block w-full h-auto group-hover:scale-105 transition-transform duration-500">
                                @endif
                                
                                @if ($ev->start_date)
                                    <div class="absolute bottom-6 right-6 z-20">
                                        <span class="bg-black/50 backdrop-blur-md text-white px-4 py-2 rounded-full font-label text-xs font-bold shadow-lg">
                                            {{ $ev->start_date->format('d M') }}
                                        </span>
                                    </div>
                                @endif
                                
                            @if($ev->link)
                                </a>
                            @else
                                </div>
                            @endif
                        </div>
                    @endforeach
                </div>
                <!-- Pagination -->
                <div class="swiper-pagination-events !static !mt-8 text-center"></div>
            </div>
            @else
            <div class="w-full flex justify-center py-10">
                <div class="text-center bg-surface-container border border-outline-variant/30 px-8 py-16 md:py-24 rounded-[40px] w-full max-w-3xl mx-auto shadow-sm flex flex-col items-center justify-center">
                    <div class="w-24 h-24 bg-primary-container/50 rounded-full flex items-center justify-center mb-6 shadow-inner mx-auto border border-primary/10">
                        <span class="material-symbols-outlined text-5xl text-primary" style="font-variation-settings: 'FILL' 1;">event_available</span>
                    </div>
                    <h4 class="font-headline text-3xl md:text-4xl text-on-surface font-bold mb-3">Event Coming Soon</h4>
                    <p class="text-on-surface-variant font-body text-lg max-w-md mx-auto">Jadwal acara Pituwolu belum tersedia. Pantau terus untuk info live music dan event seru lainnya!</p>
                </div>
            </div>
            @endif
        </div>

    </section>



    <!-- Sudut Gallery Preview Section -->
    <section class="py-24 md:py-32 bg-surface-container-low" id="gallery-preview">
        <div class="max-w-screen-2xl mx-auto px-6 md:px-8">
            
            <!-- Instagram CTA Header -->
            <div class="flex flex-col items-center mb-16 text-center">
                <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-primary-container text-on-primary-container font-label text-xs font-bold tracking-widest uppercase mb-6 shadow-sm">
                    <i class="fab fa-instagram text-lg"></i>
                    <span>@PITUWOLU.COFFEE</span>
                </div>
                <h2 class="font-headline text-4xl md:text-5xl lg:text-6xl text-on-surface mb-6 leading-tight">Ikuti Jejak Galeri Kami</h2>
                <p class="text-on-surface-variant font-body text-base md:text-lg max-w-2xl mx-auto mb-8">Setiap sudut kedai, setiap cangkir kopi, memiliki cerita. Bagikan momen Anda dan ikuti kami di Instagram untuk update setiap harinya.</p>
                <a href="https://www.instagram.com/pituwolu.coffee?igsh=MWN5dDl2MWYzY3l6ZQ== " target="_blank" class="bg-primary text-on-primary px-8 py-4 rounded-full font-label font-bold text-sm hover:scale-105 transition-transform shadow-[0_12px_24px_rgba(45,75,45,0.3)] inline-flex items-center gap-3 mb-4">
                    <i class="fab fa-instagram text-xl"></i> FOLLOW INSTAGRAM KAMI
                </a>
            </div>

            <!-- Foolproof Square Grid Gallery -->
            <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-4 gap-2 sm:gap-4 md:gap-6 mb-16 max-w-xl md:max-w-3xl lg:max-w-full mx-auto">
                @php
                    $gals = \App\Models\Gallery::active()->limit(4)->get();
                    
                    // Fallback placeholders array
                    $placeholders = [
                        'https://images.unsplash.com/photo-1554118811-1e0d58224f24?q=80&w=600&auto=format&fit=crop',
                        'https://images.unsplash.com/photo-1497935586351-b67a49e012bf?q=80&w=600&auto=format&fit=crop',
                        'https://images.unsplash.com/photo-1509042239860-f550ce710b93?q=80&w=600&auto=format&fit=crop',
                        'https://images.unsplash.com/photo-1600093463592-8e36ae95ef56?q=80&w=600&auto=format&fit=crop',
                        'https://images.unsplash.com/photo-1511920170033-f8396924c348?q=80&w=600&auto=format&fit=crop',
                        'https://images.unsplash.com/photo-1495474472287-4d71bcdd2085?q=80&w=600&auto=format&fit=crop'
                    ];
                @endphp
                
                @foreach($gals as $gal)
                    <div class="aspect-square rounded-sm sm:rounded-md md:rounded-[24px] overflow-hidden group shadow-sm border border-surface-container-highest relative cursor-pointer" @click="$dispatch('open-lightbox', '{{ str_starts_with($gal->image, 'http') ? $gal->image : Storage::url($gal->image) }}')">
                        <img src="{{ str_starts_with($gal->image, 'http') ? $gal->image : Storage::url($gal->image) }}" 
                             alt="{{ $gal->title }}" 
                             class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                        <div class="absolute inset-0 bg-black/0 group-hover:bg-black/20 transition duration-500"></div>
                    </div>
                @endforeach

                {{-- Fill empty slots if less than 4 galleries exist to maintain beautiful grid --}}
                @for($i = $gals->count(); $i < 4; $i++)
                    <div class="aspect-square rounded-sm sm:rounded-md md:rounded-[24px] overflow-hidden group shadow-sm border border-surface-container-highest relative bg-surface-container cursor-pointer" @click="$dispatch('open-lightbox', '{{ $placeholders[$i] }}')">
                        <img src="{{ $placeholders[$i] }}" 
                             class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700" alt="Pituwolu Ambient">
                        <div class="absolute inset-0 bg-black/0 group-hover:bg-black/20 transition duration-500"></div>
                    </div>
                @endfor
            </div>

            <!-- View More Link -->
            <div class="flex justify-center mt-8">
                <a class="text-on-surface font-label font-bold text-sm md:text-base border-b-2 border-primary/50 pb-1 hover:text-primary hover:border-primary transition-colors inline-flex items-center gap-2 group"
                    href="/gallery">
                    LIHAT GALERI LENGKAP PADA HALAMAN GALERI <span class="material-symbols-outlined text-lg group-hover:translate-x-1 transition-transform">arrow_forward</span>
                </a>
            </div>

        </div>
    </section>

    <!-- Testimonial Carousel Section -->
    <section class="py-28 md:py-40 bg-surface-container-lowest border-t border-surface-variant relative overflow-hidden">
        <div class="max-w-screen-2xl mx-auto px-6 md:px-8">
            <div class="flex flex-col items-center mb-16 text-center">
                <h2 class="font-label text-secondary tracking-[0.3em] text-xs font-bold mb-4 uppercase">Testimoni</h2>
                <h3 class="font-headline text-4xl md:text-5xl text-on-surface capitalize">Apa Kata Mereka Tentang Pituwolu</h3>
            </div>

            <!-- Testimoni Swiper Carousel -->
            <div class="swiper testimoni-swiper px-0">
                <div class="swiper-wrapper">
                    @forelse($reviews as $review)
                    <div class="swiper-slide">
                        <div class="bg-surface-container p-6 md:p-8 rounded-[28px] shadow-sm border border-surface-container-highest h-full">
                            <div class="flex text-tertiary mb-3">
                                @for ($i = 1; $i <= 5; $i++)
                                    <span class="material-symbols-outlined text-lg"
                                        style="font-variation-settings: 'FILL' {{ $i <= ($review->rating ?? 5) ? '1' : '0' }};">star</span>
                                @endfor
                            </div>
                            <p class="text-on-surface-variant leading-relaxed text-sm mb-4 line-clamp-3">"{{ $review->ulasan }}"</p>
                            <div class="flex items-center gap-3 pt-2">
                                <div
                                    class="w-10 h-10 rounded-full bg-secondary-container flex items-center justify-center font-bold font-headline text-xs text-on-secondary-container shrink-0">
                                    {{ strtoupper(substr($review->nama_pengulas ?? 'G', 0, 1)) }}
                                </div>
                                <div class="min-w-0">
                                    <p class="font-bold text-on-surface text-sm truncate">{{ $review->nama_pengulas ?? 'Guest' }}</p>
                                    <p class="text-xs text-on-surface-variant">{{ $review->created_at->format('d M Y') }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    @empty
                    <!-- Fallback testimonials -->
                    <div class="swiper-slide">
                        <div class="bg-surface-container p-6 md:p-8 rounded-[28px] shadow-sm border border-surface-container-highest h-full">
                            <div class="flex text-tertiary mb-3">
                                <span class="material-symbols-outlined text-lg" style="font-variation-settings: 'FILL' 1;">star</span>
                                <span class="material-symbols-outlined text-lg" style="font-variation-settings: 'FILL' 1;">star</span>
                                <span class="material-symbols-outlined text-lg" style="font-variation-settings: 'FILL' 1;">star</span>
                                <span class="material-symbols-outlined text-lg" style="font-variation-settings: 'FILL' 1;">star</span>
                                <span class="material-symbols-outlined text-lg" style="font-variation-settings: 'FILL' 1;">star</span>
                            </div>
                            <p class="text-on-surface-variant leading-relaxed text-sm mb-4 line-clamp-3">"Tempat ternyaman untuk kerja di akhir pekan. Barista selalu ramah dan Forest Latte-nya luar biasa enak!"</p>
                            <div class="flex items-center gap-3 pt-2">
                                <div class="w-10 h-10 rounded-full bg-secondary-container flex items-center justify-center font-bold font-headline text-xs text-on-secondary-container shrink-0">A</div>
                                <div class="min-w-0">
                                    <p class="font-bold text-on-surface text-sm truncate">Andi Setiawan</p>
                                    <p class="text-xs text-on-surface-variant">Freelancer</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="bg-surface-container p-6 md:p-8 rounded-[28px] shadow-sm border border-surface-container-highest h-full">
                            <div class="flex text-tertiary mb-3">
                                <span class="material-symbols-outlined text-lg" style="font-variation-settings: 'FILL' 1;">star</span>
                                <span class="material-symbols-outlined text-lg" style="font-variation-settings: 'FILL' 1;">star</span>
                                <span class="material-symbols-outlined text-lg" style="font-variation-settings: 'FILL' 1;">star</span>
                                <span class="material-symbols-outlined text-lg" style="font-variation-settings: 'FILL' 1;">star</span>
                                <span class="material-symbols-outlined text-lg" style="font-variation-settings: 'FILL' 1;">star_half</span>
                            </div>
                            <p class="text-on-surface-variant leading-relaxed text-sm mb-4 line-clamp-3">"Desain interior yang sungguh aesthetic. Saya betah berlama-lama baca buku di sini. Croissant-nya juga pas banget."</p>
                            <div class="flex items-center gap-3 pt-2">
                                <div class="w-10 h-10 rounded-full bg-primary-container flex items-center justify-center font-bold font-headline text-xs text-on-primary-container shrink-0">K</div>
                                <div class="min-w-0">
                                    <p class="font-bold text-on-surface text-sm truncate">Kirana Maharani</p>
                                    <p class="text-xs text-on-surface-variant">Mahasiswi</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="bg-surface-container p-6 md:p-8 rounded-[28px] shadow-sm border border-surface-container-highest h-full">
                            <div class="flex text-tertiary mb-3">
                                <span class="material-symbols-outlined text-lg" style="font-variation-settings: 'FILL' 1;">star</span>
                                <span class="material-symbols-outlined text-lg" style="font-variation-settings: 'FILL' 1;">star</span>
                                <span class="material-symbols-outlined text-lg" style="font-variation-settings: 'FILL' 1;">star</span>
                                <span class="material-symbols-outlined text-lg" style="font-variation-settings: 'FILL' 1;">star</span>
                                <span class="material-symbols-outlined text-lg" style="font-variation-settings: 'FILL' 1;">star</span>
                            </div>
                            <p class="text-on-surface-variant leading-relaxed text-sm mb-4 line-clamp-3">"Setiap sudutnya Instagramable banget, dan kopi hitam klasiknya memang juara! Favorit untuk nongkrong bareng teman."</p>
                            <div class="flex items-center gap-3 pt-2">
                                <div class="w-10 h-10 rounded-full bg-tertiary-container flex items-center justify-center font-bold font-headline text-xs text-on-tertiary-container shrink-0">B</div>
                                <div class="min-w-0">
                                    <p class="font-bold text-on-surface text-sm truncate">Budi Santoso</p>
                                    <p class="text-xs text-on-surface-variant">Wirausaha</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforelse
                </div>

                <!-- Pagination -->
                <div class="testimoni-swiper-pagination !static !mt-8 text-center"></div>
            </div>
        </div>
    </section>    

    <!-- Testimonial Marquee Section -->
    <section class="py-24 bg-surface-container-lowest overflow-hidden border-t border-surface-variant hidden">
        <div class="flex flex-col items-center mb-16 text-center px-6">
            <h2 class="font-label text-secondary tracking-[0.3em] text-xs font-bold mb-4 uppercase">Testimoni</h2>
            <h3 class="font-headline text-4xl md:text-5xl text-on-surface">Apa Kata Mereka</h3>
        </div>

        <div class="marquee font-body">
            <div class="marquee-content">
                @forelse($reviews as $review)
                    {{-- Dynamic review from DB (original set) --}}
                    <div
                        class="w-80 bg-surface-container p-8 rounded-[32px] shadow-sm shrink-0 border border-surface-container-highest">
                        <div class="flex text-tertiary mb-4">
                            @for ($i = 1; $i <= 5; $i++)
                                <span class="material-symbols-outlined"
                                    style="font-variation-settings: 'FILL' {{ $i <= ($review->rating ?? 5) ? '1' : '0' }};">star</span>
                            @endfor
                        </div>
                        <p class="text-on-surface-variant leading-relaxed text-sm mb-6">"{{ $review->ulasan }}"</p>
                        <div class="flex items-center gap-3">
                            <div
                                class="w-10 h-10 rounded-full bg-secondary-container flex items-center justify-center font-bold font-headline text-on-secondary-container">
                                {{ strtoupper(substr($review->nama_pengulas ?? 'G', 0, 1)) }}
                            </div>
                            <div>
                                <p class="font-bold text-on-surface text-sm">{{ $review->nama_pengulas ?? 'Guest' }}</p>
                                <p class="text-xs text-on-surface-variant">{{ $review->created_at->format('d M Y') }}</p>
                            </div>
                        </div>
                    </div>
                @empty
                    {{-- Fallback hardcoded reviews --}}
                    <div
                        class="w-80 bg-surface-container p-8 rounded-[32px] shadow-sm shrink-0 border border-surface-container-highest">
                        <div class="flex text-tertiary mb-4">
                            <span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1;">star</span>
                            <span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1;">star</span>
                            <span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1;">star</span>
                            <span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1;">star</span>
                            <span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1;">star</span>
                        </div>
                        <p class="text-on-surface-variant leading-relaxed text-sm mb-6">"Tempat ternyaman untuk kerja di
                            akhir pekan. Barista selalu ramah dan Forest Latte-nya luar biasa enak!"</p>
                        <div class="flex items-center gap-3">
                            <div
                                class="w-10 h-10 rounded-full bg-secondary-container flex items-center justify-center font-bold font-headline text-on-secondary-container">
                                A</div>
                            <div>
                                <p class="font-bold text-on-surface text-sm">Andi Setiawan</p>
                                <p class="text-xs text-on-surface-variant">Freelancer</p>
                            </div>
                        </div>
                    </div>
                    <div
                        class="w-80 bg-surface-container p-8 rounded-[32px] shadow-sm shrink-0 border border-surface-container-highest">
                        <div class="flex text-tertiary mb-4">
                            <span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1;">star</span>
                            <span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1;">star</span>
                            <span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1;">star</span>
                            <span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1;">star</span>
                            <span class="material-symbols-outlined"
                                style="font-variation-settings: 'FILL' 1;">star_half</span>
                        </div>
                        <p class="text-on-surface-variant leading-relaxed text-sm mb-6">"Desain interior yang sungguh
                            aesthetic. Saya betah berlama-lama baca buku di sini. Croissant-nya juga pas banget."</p>
                        <div class="flex items-center gap-3">
                            <div
                                class="w-10 h-10 rounded-full bg-primary-container flex items-center justify-center font-bold font-headline text-on-primary-container">
                                K</div>
                            <div>
                                <p class="font-bold text-on-surface text-sm">Kirana Maharani</p>
                                <p class="text-xs text-on-surface-variant">Mahasiswi</p>
                            </div>
                        </div>
                    </div>
                    <div
                        class="w-80 bg-surface-container p-8 rounded-[32px] shadow-sm shrink-0 border border-surface-container-highest">
                        <div class="flex text-tertiary mb-4">
                            <span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1;">star</span>
                            <span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1;">star</span>
                            <span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1;">star</span>
                            <span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1;">star</span>
                            <span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1;">star</span>
                        </div>
                        <p class="text-on-surface-variant leading-relaxed text-sm mb-6">"Setiap sudutnya Instagramable
                            banget, dan kopi hitam klasiknya memang juara! Favorit untuk nongkrong bareng teman."</p>
                        <div class="flex items-center gap-3">
                            <div
                                class="w-10 h-10 rounded-full bg-tertiary-container flex items-center justify-center font-bold font-headline text-on-tertiary-container">
                                B</div>
                            <div>
                                <p class="font-bold text-on-surface text-sm">Budi Santoso</p>
                                <p class="text-xs text-on-surface-variant">Wirausaha</p>
                            </div>
                        </div>
                    </div>
                    <div
                        class="w-80 bg-surface-container p-8 rounded-[32px] shadow-sm shrink-0 border border-surface-container-highest">
                        <div class="flex text-tertiary mb-4">
                            <span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1;">star</span>
                            <span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1;">star</span>
                            <span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1;">star</span>
                            <span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1;">star</span>
                            <span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1;">star</span>
                        </div>
                        <p class="text-on-surface-variant leading-relaxed text-sm mb-6">"Beneran 'Fresh Mind' kalau habis
                            dari sini. Pelayanannya top, kebersihannya luar biasa. Pasti akan balik lagi!"</p>
                        <div class="flex items-center gap-3">
                            <div
                                class="w-10 h-10 rounded-full bg-secondary-container flex items-center justify-center font-bold font-headline text-on-secondary-container">
                                N</div>
                            <div>
                                <p class="font-bold text-on-surface text-sm">Nabila R.</p>
                                <p class="text-xs text-on-surface-variant">Karyawan</p>
                            </div>
                        </div>
                    </div>
                @endforelse
            </div>

            <!-- Navigation -->
            <div class="flex items-center justify-center gap-4 mt-8">
                <button class="testimoni-swiper-button-prev w-12 h-12 rounded-full border border-on-surface/20 flex items-center justify-center hover:bg-primary hover:text-on-primary hover:border-primary transition-all">
                    <span class="material-symbols-outlined">arrow_back</span>
                </button>
                <div class="testimoni-swiper-pagination flex gap-2"></div>
                <button class="testimoni-swiper-button-next w-12 h-12 rounded-full border border-on-surface/20 flex items-center justify-center hover:bg-primary hover:text-on-primary hover:border-primary transition-all">
                    <span class="material-symbols-outlined">arrow_forward</span>
                </button>
            </div>
        </div>
    </section>

    <!-- Pinned Quote Section -->
    <section class="py-24 md:py-40 bg-surface relative overflow-hidden">
        <div class="absolute top-0 left-0 w-full h-full opacity-5 pointer-events-none flex items-center justify-center -z-0">
            <div class="text-[20vw] font-headline font-black leading-none italic opacity-10 text-on-surface">Pituwolu</div>
        </div>
        <div class="max-w-4xl mx-auto px-6 md:px-8 text-center relative z-10">
            <img src="{{ asset('logo header.png') }}?v={{ @filemtime(public_path('logo header.png')) }}"
                alt="Pituwolu Logo"
                class="h-28 w-auto mx-auto mb-8 rounded-[40px] drop-shadow-[0_16px_32px_rgba(23,52,24,0.15)] bg-surface-container border border-surface-container-highest p-1 mix-blend-multiply dark:mix-blend-normal"
                onerror="this.style.display='none'">
            <blockquote class="font-headline text-3xl md:text-4xl lg:text-5xl text-on-surface leading-tight mb-8 md:mb-12">
                "Semoga kita <span class="serif-italic text-pit-brown underline decoration-pit-brown/30 decoration-4 underline-offset-8">P/W</span> selalu."
            </blockquote>
            <p class="font-label text-xs md:text-sm tracking-widest font-bold text-on-surface-variant">— PITUWOLU COFFEE</p>
        </div>
    </section>

@endsection
@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            // Testimoni Carousel
            const testimoniSwiper = new Swiper('.testimoni-swiper', {
                slidesPerView: 1,
                spaceBetween: 20,
                grabCursor: true,
                breakpoints: {
                    640: {
                        slidesPerView: 2,
                    },
                    1024: {
                        slidesPerView: 3,
                    },
                },
                pagination: {
                    el: '.testimoni-swiper-pagination',
                    clickable: true,
                    type: 'bullets',
                },
                autoplay: {
                    delay: 5000,
                    disableOnInteraction: false,
                },
            });




            const promoSwiper = new Swiper('.promo-swiper', {
                slidesPerView: 'auto',
                centeredSlides: false,
                spaceBetween: 30,
                grabCursor: true,
                pagination: {
                    el: '.swiper-pagination',
                    clickable: true,
                },
                breakpoints: {
                    640: {
                        slidesPerView: 'auto',
                        centeredSlides: false,
                    },
                    1024: {
                        slidesPerView: 3,
                        centeredSlides: false,
                    }
                }
            });

            const eventSwiper = new Swiper('.event-swiper', {
                slidesPerView: 'auto',
                centeredSlides: false,
                spaceBetween: 30,
                grabCursor: true,
                pagination: {
                    el: '.swiper-pagination-events',
                    clickable: true,
                },
                breakpoints: {
                    640: {
                        slidesPerView: 'auto',
                        centeredSlides: false,
                    },
                    1024: {
                        slidesPerView: 3,
                        centeredSlides: false,
                    }
                }
            });

            const bestsellerSwiper = new Swiper('.bestseller-swiper', {
                slidesPerView: 'auto',
                spaceBetween: 24,
                grabCursor: true,
                observer: true,
                observeParents: true,
                navigation: {
                    nextEl: '.swiper-next-best',
                    prevEl: '.swiper-prev-best',
                },
                pagination: {
                    el: '.swiper-pagination-best',
                    clickable: true,
                },
                breakpoints: {
                    1024: {
                        slidesPerView: 4,
                        spaceBetween: 32,
                    }
                }
            });
        });

        document.addEventListener('alpine:init', () => {
            // Best seller logic removed - now rendered from DB
        });
    </script>
@endpush
