<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Pituwolu | Coffee & Resto')</title>

    <!-- 1. Theme Initialization (MUST BE FIRST) -->
    <script>
        if (localStorage.theme === 'dark' || (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark');
        }
    </script>

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Fonts from User Design -->
    <link
        href="https://fonts.googleapis.com/css2?family=Newsreader:ital,opsz,wght@0,6..72,200..800;1,6..72,200..800&family=Manrope:wght@200..800&family=Plus+Jakarta+Sans:ital,wght@0,200..800;1,200..800&display=swap"
        rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap"
        rel="stylesheet" />

    <!-- Swiper.js -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <!-- Alpine.js & Persist -->
    <script defer src="https://cdn.jsdelivr.net/npm/@alpinejs/persist@3.x.x/dist/cdn.min.js"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <script id="tailwind-config">
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    colors: {
                        "on-secondary-fixed": "var(--on-secondary-fixed)",
                        "primary-fixed-dim": "var(--primary-fixed-dim)",
                        "on-surface-variant": "var(--on-surface-variant)",
                        "on-tertiary-fixed-variant": "var(--on-tertiary-fixed-variant)",
                        "error-container": "var(--error-container)",
                        "outline": "var(--outline)",
                        "inverse-on-surface": "var(--inverse-on-surface)",
                        "surface-tint": "var(--surface-tint)",
                        "tertiary-container": "var(--tertiary-container)",
                        "secondary": "var(--secondary)",
                        "on-primary-fixed-variant": "var(--on-primary-fixed-variant)",
                        "on-secondary-fixed-variant": "var(--on-secondary-fixed-variant)",
                        "tertiary-fixed-dim": "var(--tertiary-fixed-dim)",
                        "on-primary-container": "var(--on-primary-container)",
                        "error": "var(--error)",
                        "on-primary-fixed": "var(--on-primary-fixed)",
                        "surface-container-highest": "var(--surface-container-highest)",
                        "background": "var(--background)",
                        "tertiary-fixed": "var(--tertiary-fixed)",
                        "surface": "var(--surface)",
                        "surface-container-low": "var(--surface-container-low)",
                        "surface-bright": "var(--surface-bright)",
                        "inverse-primary": "var(--inverse-primary)",
                        "on-background": "var(--on-background)",
                        "secondary-fixed": "var(--secondary-fixed)",
                        "primary": "var(--primary)",
                        "surface-dim": "var(--surface-dim)",
                        "inverse-surface": "var(--inverse-surface)",
                        "on-tertiary-container": "var(--on-tertiary-container)",
                        "on-surface": "var(--on-surface)",
                        "outline-variant": "var(--outline-variant)",
                        "surface-variant": "var(--surface-variant)",
                        "on-secondary-container": "var(--on-secondary-container)",
                        "on-primary": "var(--on-primary)",
                        "on-tertiary": "var(--on-tertiary)",
                        "on-error-container": "var(--on-error-container)",
                        "primary-fixed": "var(--primary-fixed)",
                        "surface-container": "var(--surface-container)",
                        "primary-container": "var(--primary-container)",
                        "on-secondary": "var(--on-secondary)",
                        "surface-container-lowest": "var(--surface-container-lowest)",
                        "tertiary": "var(--tertiary)",
                        "secondary-container": "var(--secondary-container)",
                        "surface-container-high": "var(--surface-container-high)",
                        "on-error": "var(--on-error)",
                        "secondary-fixed-dim": "var(--secondary-fixed-dim)",
                        "on-tertiary-fixed": "var(--on-tertiary-fixed)"
                    },
                    borderRadius: {
                        DEFAULT: "0.25rem",
                        lg: "0.5rem",
                        xl: "0.75rem",
                        full: "9999px"
                    },
                    fontFamily: {
                        headline: ["Newsreader", "serif"],
                        body: ["Manrope", "sans-serif"],
                        label: ["Plus Jakarta Sans", "sans-serif"]
                    }
                },
            },
        }
    </script>
    <style>
        :root {
            --on-secondary-fixed: #2b1700;
            --primary-fixed-dim: #add0a8;
            --on-surface-variant: #434841;
            --on-tertiary-fixed-variant: #881f00;
            --error-container: #ffdad6;
            --outline: #737970;
            --inverse-on-surface: #f3f0e9;
            --surface-tint: #476646;
            --tertiary-container: #841e00;
            --secondary: #785833;
            --on-primary-fixed-variant: #304e2f;
            --on-secondary-fixed-variant: #5e411e;
            --tertiary-fixed-dim: #ffb5a1;
            --on-primary-container: #98ba94;
            --error: #ba1a1a;
            --on-primary-fixed: #042108;
            --surface-container-highest: #e5e2db;
            --background: #fcf9f2;
            --tertiary-fixed: #ffdbd1;
            --surface: #fcf9f2;
            --surface-container-low: #f6f3ec;
            --surface-bright: #fcf9f2;
            --inverse-primary: #add0a8;
            --on-background: #1c1c18;
            --secondary-fixed: #ffddb9;
            --primary: #173418;
            --surface-dim: #dcdad3;
            --inverse-surface: #31312c;
            --on-tertiary-container: #ff967a;
            --on-surface: #1c1c18;
            --outline-variant: #c3c8be;
            --surface-variant: #e5e2db;
            --on-secondary-container: #795933;
            --on-primary: #ffffff;
            --on-tertiary: #ffffff;
            --on-error-container: #93000a;
            --primary-fixed: #c8ecc3;
            --surface-container: #f1eee7;
            --primary-container: #2d4b2d;
            --on-secondary: #ffffff;
            --surface-container-lowest: #ffffff;
            --tertiary: #5d1200;
            --secondary-container: #fed2a3;
            --surface-container-high: #ebe8e1;
            --on-error: #ffffff;
            --secondary-fixed-dim: #e9bf91;
            --on-tertiary-fixed: #3c0800;
        }

        .dark {
            --primary: #add0a8;
            --surface-tint: #add0a8;
            --on-primary: #173418;
            --primary-container: #2d4b2d;
            --on-primary-container: #c8ecc3;
            --secondary: #e9bf91;
            --on-secondary: #442b09;
            --secondary-container: #5e411e;
            --on-secondary-container: #ffddb9;
            --tertiary: #ffb5a1;
            --on-tertiary: #310700;
            --tertiary-container: #5d1200;
            --on-tertiary-container: #ffdbd1;
            --error: #ffb4ab;
            --on-error: #690005;
            --error-container: #93000a;
            --on-error-container: #ffdad6;
            --background: #121411;
            --on-background: #e2e3dd;
            --surface: #121411;
            --on-surface: #e2e3dd;
            --surface-variant: #434841;
            --on-surface-variant: #c3c8be;
            --outline: #8c9288;
            --outline-variant: #434841;
            --inverse-surface: #e2e3dd;
            --inverse-on-surface: #2f312d;
            --inverse-primary: #476646;
            --primary-fixed: #c8ecc3;
            --on-primary-fixed: #042108;
            --primary-fixed-dim: #add0a8;
            --on-primary-fixed-variant: #304e2f;
            --secondary-fixed: #ffddb9;
            --on-secondary-fixed: #2b1700;
            --secondary-fixed-dim: #e9bf91;
            --on-secondary-fixed-variant: #5e411e;
            --tertiary-fixed: #ffdbd1;
            --on-tertiary-fixed: #3c0800;
            --tertiary-fixed-dim: #ffb5a1;
            --on-tertiary-fixed-variant: #881f00;
            --surface-dim: #121411;
            --surface-bright: #383a36;
            --surface-container-lowest: #0c0f0c;
            --surface-container-low: #1a1c19;
            --surface-container: #1e201d;
            --surface-container-high: #282b27;
            --surface-container-highest: #333532;
        }

        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
        }

        .serif-italic {
            font-family: 'Newsreader';
            font-style: italic;
        }

        .no-scrollbar::-webkit-scrollbar {
            display: none;
        }

        .loader {
            border-top-color: #173418;
            animation: spinner 1.5s linear infinite;
        }

        @keyframes spinner {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }

        /* Testimonial Marquee Animation */
        .marquee {
            width: 100vw;
            max-width: 100%;
            overflow: hidden;
            position: relative;
        }

        .marquee-content {
            display: flex;
            width: max-content;
            animation: marquee 30s linear infinite;
            gap: 2rem;
        }

        .marquee-content:hover {
            animation-play-state: paused;
        }

        @keyframes marquee {
            0% {
                transform: translateX(0);
            }

            100% {
                transform: translateX(-50%);
            }
        }

        @keyframes fadeInUp {
            from { opacity: 0; transform: translate(-50%, 20px); }
            to   { opacity: 1; transform: translate(-50%, 0); }
        }
    </style>
    @stack('styles')
</head>

<body
    class="bg-background text-on-surface font-body selection:bg-secondary-container selection:text-on-secondary-container transition-colors duration-300"
    x-data="cartState()">

    <!-- Loading Animation -->
    <div id="loading-screen" class="fixed inset-0 z-[100] flex items-center justify-center bg-surface">
        <div class="flex flex-col items-center gap-4">
            <div class="relative w-10 h-10">
                <!-- Background track -->
                <div class="absolute inset-0 rounded-full border-[1.5px] border-surface-variant/30"></div>
                <!-- Single Spinning Ring -->
                <div
                    class="absolute inset-0 rounded-full border-[1.5px] border-t-primary border-r-primary border-transparent animate-[spin_1s_linear_infinite]">
                </div>
            </div>
            <h2
                class="text-primary font-headline text-xs font-bold italic tracking-[0.4em] uppercase animate-pulse opacity-70 ml-1">
                PITUWOLU</h2>
        </div>
    </div>

    <!-- Mobile Menu Overlay -->
    <div x-show="isMobileMenuOpen" 
         x-transition:enter="transition ease-out duration-300 transform"
         x-transition:enter-start="-translate-y-full"
         x-transition:enter-end="translate-y-0"
         class="fixed inset-0 z-[999] flex flex-col pt-32 px-8 space-y-8 overflow-y-auto pb-20 bg-[#173418] dark:bg-[#0c0f0c] text-white"
         style="display: none;">
        
        <button @click="isMobileMenuOpen = false" class="absolute top-8 right-8 p-3 rounded-full bg-white/20 text-white shadow-xl">
            <span class="material-symbols-outlined text-4xl font-bold">close</span>
        </button>

        <div class="flex flex-col space-y-8">
            <a href="/" class="text-4xl font-headline font-bold text-white tracking-wide">Beranda</a>
            <a href="/about" class="text-4xl font-headline font-bold text-white tracking-wide">Tentang Kami</a>
            <a href="/menu" class="text-4xl font-headline font-bold text-white tracking-wide">Menu</a>
            <a href="/gallery" class="text-4xl font-headline font-bold text-white tracking-wide">Galeri</a>
            <a href="/contact" class="text-4xl font-headline font-bold text-white tracking-wide">Kontak</a>
            

            <a href="/reservasi" class="bg-[#e9bf91] text-[#2b1700] text-center w-full py-6 rounded-full font-black font-label text-2xl shadow-2xl">RESERVASI</a>

            <!-- Mobile Socials -->
            <div class="mt-auto pt-10 border-t border-white/5 flex justify-center gap-4 pb-12">
                <a href="https://www.instagram.com/pituwolu.coffee?igsh=MWN5dDl2MWYzY3l6ZQ==" target="_blank" class="w-12 h-12 rounded-full bg-white/5 flex items-center justify-center text-white hover:bg-primary transition-colors"><i class="fab fa-instagram text-xl"></i></a>
                <a href="https://www.facebook.com/share/18KinaY9AL/" target="_blank" class="w-12 h-12 rounded-full bg-white/5 flex items-center justify-center text-white hover:bg-primary transition-colors"><i class="fab fa-facebook-f text-xl"></i></a>
                <a href="https://www.tiktok.com/@pituwoluu.coffee?_r=1&_t=ZS-95zpk3Bi28j" target="_blank" class="w-12 h-12 rounded-full bg-white/5 flex items-center justify-center text-white hover:bg-primary transition-colors"><i class="fab fa-tiktok text-xl"></i></a>
                <a href="https://wa.me/6285810229923" target="_blank" class="w-12 h-12 rounded-full bg-white/5 flex items-center justify-center text-white hover:bg-primary transition-colors"><i class="fab fa-whatsapp text-xl"></i></a>
            </div>
        </div>
    </div>

    <!-- Main Navigation Bar -->
    <nav id="navbar" @scroll.window="scrolled = (window.pageYOffset > 50)" 
         :class="scrolled ? (isDark ? 'bg-[#0c0f0c]/80 backdrop-blur-md shadow-md shadow-black/30' : 'bg-emerald-950/40 backdrop-blur-md shadow-md') : (isDark ? 'bg-[#0c0f0c]' : 'bg-[#132c14]')" 
         class="fixed top-0 w-full z-50 transition-all duration-500 py-3 md:py-3">
        <div class="flex justify-between items-center w-full px-4 sm:px-5 md:px-6 max-w-screen-2xl mx-auto">
            <!-- Logo -->
            <a class="flex items-center gap-2 sm:gap-3 font-headline text-xl sm:text-2xl md:text-3xl font-bold text-emerald-50 shrink-0" href="/">
                <img src="{{ asset('logo header.png') }}?v={{ @filemtime(public_path('logo header.png')) }}" alt="Logo" class="w-auto h-8 md:h-10 rounded-full bg-white/10 p-1 shadow-lg">
                <span class="text-lg sm:text-xl md:text-2xl">Pituwolu</span>
            </a>
            
            <!-- Desktop Links -->
            <div class="hidden lg:flex items-center gap-4 xl:gap-8">
                <a class="{{ request()->is('/') ? 'text-white border-b-2 border-[#add0a8] pb-1' : 'text-white/80 hover:text-white' }} font-bold font-body text-xs xl:text-sm transition-all" href="/">Beranda</a>
                <a class="{{ request()->is('about*') ? 'text-white border-b-2 border-[#add0a8] pb-1' : 'text-white/80 hover:text-white' }} font-bold font-body text-xs xl:text-sm transition-all" href="/about">Tentang Kami</a>
                <a class="{{ request()->is('menu*') ? 'text-white border-b-2 border-[#add0a8] pb-1' : 'text-white/80 hover:text-white' }} font-bold font-body text-xs xl:text-sm transition-all" href="/menu">Menu

                </a>
                <a class="{{ request()->is('gallery*') ? 'text-white border-b-2 border-[#add0a8] pb-1' : 'text-white/80 hover:text-white' }} font-bold font-body text-xs xl:text-sm transition-all" href="/gallery">Galeri</a>
                <a class="{{ request()->is('contact*') ? 'text-white border-b-2 border-[#add0a8] pb-1' : 'text-white/80 hover:text-white' }} font-bold font-body text-xs xl:text-sm transition-all" href="/contact">Kontak</a>
                <a class="bg-[#9B6B43] text-white px-5 xl:px-8 py-2 md:py-2.5 rounded-full font-label text-xs xl:text-sm font-bold shadow-lg hover:scale-105 transition-transform" href="/reservasi">Reservasi</a>
            </div>
            
            <!-- Icons -->
            <div class="flex items-center gap-2 md:gap-4 text-emerald-50">
                <button @click="isCartOpen = true" class="relative material-symbols-outlined hover:scale-110 transition-transform p-2 bg-white/5 rounded-full text-xl md:text-2xl">
                    shopping_cart
                    <span x-show="totalItems > 0" x-text="totalItems" class="absolute top-0 right-0 flex h-5 md:h-6 w-5 md:w-6 items-center justify-center rounded-full bg-secondary dark:bg-[#132c14] text-[10px] md:text-xs font-bold text-primary dark:text-[#9B6B43] shadow-lg"></span>
                </button>
                <button @click="isMobileMenuOpen = true" class="lg:hidden p-2 bg-white/10 rounded-xl transition-colors">
                    <span class="material-symbols-outlined text-2xl md:text-3xl">menu</span>
                </button>
            </div>
        </div>
    </nav>

    <main class="{{ request()->is('/') ? '' : 'pt-16 md:pt-24 lg:pt-32' }} min-h-screen\">
        @yield('content')
    </main>

    <!-- Slide-Over Cart Drawer -->
        <div x-show="isCartOpen" class="relative z-[70]" aria-labelledby="slide-over-title" role="dialog"
            aria-modal="true" style="display: none;">
            <div x-show="isCartOpen" x-transition.opacity
                class="fixed inset-0 bg-on-surface/40 transition-opacity backdrop-blur-sm"></div>
            <div class="fixed inset-0 overflow-hidden">
                <div class="absolute inset-0 overflow-hidden">
                    <div class="pointer-events-none fixed inset-y-0 right-0 flex max-w-full pl-10">
                        <div x-show="isCartOpen" @click.away="isCartOpen = false"
                            x-transition:enter="transform transition ease-in-out duration-500 sm:duration-700"
                            x-transition:enter-start="translate-x-full" x-transition:enter-end="translate-x-0"
                            x-transition:leave="transform transition ease-in-out duration-500 sm:duration-700"
                            x-transition:leave-start="translate-x-0" x-transition:leave-end="translate-x-full"
                            class="pointer-events-auto w-screen max-w-md">
                            <div class="flex h-full flex-col bg-surface shadow-2xl divide-y divide-surface-variant">
                                <div
                                    class="flex items-center justify-between px-4 py-6 sm:px-6 bg-surface-container-low">
                                    <h2 class="text-2xl font-headline font-bold text-on-surface tracking-tight"
                                        id="slide-over-title">Keranjang Anda</h2>
                                    <div class="ml-3 flex h-7 items-center">
                                        <button type="button" @click="isCartOpen = false"
                                            class="relative -m-2 p-2 text-on-surface-variant hover:text-on-surface transition rounded-full hover:bg-surface-variant">
                                            <span class="material-symbols-outlined">close</span>
                                        </button>
                                    </div>
                                </div>

                                <!-- Internal Content -->
                                <div class="flex-1 overflow-y-auto px-4 py-6 sm:px-6">
                                    <div class="flow-root">
                                        <ul role="list" class="-my-6 divide-y divide-surface-variant">
                                            <template x-for="(item, index) in cart" :key="item.id">
                                                <li class="flex py-6 group">
                                                    <div
                                                        class="h-24 w-24 flex-shrink-0 overflow-hidden rounded-2xl bg-surface-container-lowest shadow-sm">
                                                        <img :src="item.image" alt=""
                                                            class="h-full w-full object-cover object-center transition transform group-hover:scale-110 duration-500">
                                                    </div>
                                                    <div class="ml-4 flex flex-1 flex-col">
                                                        <div>
                                                            <div
                                                                class="flex justify-between text-base font-bold font-headline text-on-surface">
                                                                <h3 x-text="item.title"
                                                                    class="line-clamp-2 pr-2 text-xl"></h3>
                                                                <p class="ml-4 text-primary font-label whitespace-nowrap"
                                                                    x-text="formatRupiah(item.priceNumber * item.quantity)">
                                                                </p>
                                                            </div>
                                                        </div>
                                                        <div
                                                            class="flex flex-1 items-end justify-between font-label mt-4">
                                                            <div
                                                                class="flex items-center rounded-xl border border-outline-variant p-1 bg-surface-container-low">
                                                                <button @click="updateQuantity(item.id, -1)"
                                                                    class="w-8 h-8 rounded-lg text-on-surface-variant flex items-center justify-center hover:bg-surface hover:shadow-sm transition"><span
                                                                        class="material-symbols-outlined text-sm">remove</span></button>
                                                                <span
                                                                    class="w-8 text-center text-on-surface font-bold text-sm"
                                                                    x-text="item.quantity"></span>
                                                                <button @click="updateQuantity(item.id, 1)"
                                                                    class="w-8 h-8 rounded-lg text-on-surface-variant flex items-center justify-center hover:bg-surface hover:shadow-sm transition"><span
                                                                        class="material-symbols-outlined text-sm">add</span></button>
                                                            </div>
                                                            <button type="button" @click="removeFromCart(item.id)"
                                                                class="font-bold text-xs tracking-wider text-error hover:text-on-error-container transition flex items-center bg-error-container/30 hover:bg-error-container px-4 py-2 rounded-xl">
                                                                HAPUS
                                                            </button>
                                                        </div>
                                                    </div>
                                                </li>
                                            </template>
                                            <div x-show="cart.length === 0" class="py-20 text-center">
                                                <div
                                                    class="w-24 h-24 bg-surface-container rounded-full flex items-center justify-center mx-auto mb-6 text-on-surface-variant">
                                                    <span
                                                        class="material-symbols-outlined text-4xl">shopping_basket</span>
                                                </div>
                                                <p class="text-on-surface font-headline text-2xl mb-2">Keranjang Kosong
                                                </p>
                                                <p class="text-sm font-body text-on-surface-variant">Mari temukan rasa
                                                    baru di menu kami.</p>
                                            </div>
                                        </ul>
                                    </div>
                                </div>

                                <!-- Bottom Action -->
                                <div class="px-4 py-6 sm:px-6 bg-surface-container-low">
                                    <div class="flex justify-between font-headline text-on-surface mb-2">
                                        <p class="font-bold text-xl">Total Estimasi</p>
                                        <p class="font-bold text-secondary text-2xl tracking-tight"
                                            x-text="formatRupiah(totalPrice)"></p>
                                    </div>
                                    <p class="text-xs text-on-surface-variant font-body text-center">Pajak dan layanan
                                        dihitung di kasir.</p>
                                    <div class="mt-6">
                                        <a href="/order"
                                            class="flex w-full items-center justify-center rounded-full bg-primary px-6 py-4 font-label font-bold tracking-wider text-sm text-on-primary shadow-xl shadow-primary/20 hover:scale-105 transition transform duration-300">
                                            CHECKOUT SEKARANG
                                        </a>
                                    </div>
                                    <div class="mt-6 flex justify-center">
                                        <button type="button" @click="isCartOpen = false"
                                            class="text-sm font-label font-bold tracking-wider text-on-surface-variant border-b border-outline-variant hover:text-primary transition pb-1">
                                            KEMBALI KE MENU
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <!-- Footer -->
        <footer
            class="bg-surface-container-low dark:bg-[#0d1f0e] border-t border-surface-container-highest dark:border-[#1a3a1b] pt-10 md:pt-16 pb-6 md:pb-8 mt-12 md:mt-20 relative z-10 transition-colors">
            <div
                class="max-w-screen-2xl mx-auto px-4 sm:px-6 md:px-8 lg:px-12 flex flex-col md:flex-row justify-between gap-8 md:gap-10 lg:gap-12 font-body">

                <!-- Left Side -->
                <div class="flex flex-col flex-1 justify-between min-h-[100px] md:min-h-[120px]">
                    <a class="flex items-center text-xl sm:text-2xl md:text-3xl font-headline italic text-on-surface font-bold group w-max"
                        href="/">
                        <img src="{{ asset('logo footer.png') }}?v={{ @filemtime(public_path('logo footer.png')) }}"
                            alt="Pituwolu" class="h-8 md:h-12 w-auto object-contain transition-transform"
                            onerror="this.style.display='none'">
                        <span class="-ml-2 md:-ml-3">Pituwolu</span>
                    </a>
                    <div class="mt-auto pt-6 md:pt-8">
                        <p class="text-on-surface-variant font-label text-xs md:text-sm">© {{ date('Y') }} Pituwolu Coffee & Resto
                            All rights reserved.</p>
                    </div>
                </div>

                <!-- Middle: Tautan Cepat -->
                <div class="flex flex-col items-start w-full md:w-auto">
                    <h3 class="font-bold text-on-surface font-label text-xs md:text-sm mb-3 md:mb-4 tracking-wider md:tracking-widest uppercase">Tautan Cepat</h3>
                    <ul class="flex flex-col gap-2">
                        <li><a href="/" class="text-xs md:text-sm text-on-surface-variant hover:text-primary font-body transition-colors duration-200 flex items-center gap-2 group"><span class="material-symbols-outlined text-xs opacity-0 group-hover:opacity-100 transition-all -translate-x-1 group-hover:translate-x-0 text-primary">arrow_forward</span>Beranda</a></li>
                        <li><a href="/about" class="text-xs md:text-sm text-on-surface-variant hover:text-primary font-body transition-colors duration-200 flex items-center gap-2 group"><span class="material-symbols-outlined text-xs opacity-0 group-hover:opacity-100 transition-all -translate-x-1 group-hover:translate-x-0 text-primary">arrow_forward</span>Tentang Kami</a></li>
                        <li><a href="/menu" class="text-xs md:text-sm text-on-surface-variant hover:text-primary font-body transition-colors duration-200 flex items-center gap-2 group"><span class="material-symbols-outlined text-xs opacity-0 group-hover:opacity-100 transition-all -translate-x-1 group-hover:translate-x-0 text-primary">arrow_forward</span>Menu</a></li>
                        <li><a href="/gallery" class="text-xs md:text-sm text-on-surface-variant hover:text-primary font-body transition-colors duration-200 flex items-center gap-2 group"><span class="material-symbols-outlined text-xs opacity-0 group-hover:opacity-100 transition-all -translate-x-1 group-hover:translate-x-0 text-primary">arrow_forward</span>Galeri</a></li>
                        <li><a href="/contact" class="text-xs md:text-sm text-on-surface-variant hover:text-primary font-body transition-colors duration-200 flex items-center gap-2 group"><span class="material-symbols-outlined text-xs opacity-0 group-hover:opacity-100 transition-all -translate-x-1 group-hover:translate-x-0 text-primary">arrow_forward</span>Kontak</a></li>
                        <li><a href="/reservasi" class="text-xs md:text-sm text-on-surface-variant hover:text-primary font-body transition-colors duration-200 flex items-center gap-2 group"><span class="material-symbols-outlined text-xs opacity-0 group-hover:opacity-100 transition-all -translate-x-1 group-hover:translate-x-0 text-primary">arrow_forward</span>Reservasi</a></li>
                    </ul>
                </div>

                <!-- Right Side: Connect With Us -->
                <div class="flex flex-col items-start md:items-end w-full md:w-auto">
                    <h3 class="font-bold text-on-surface font-label text-xs md:text-sm mb-3 md:mb-4 text-left md:text-right tracking-wider md:tracking-widest uppercase">Connect With Us</h3>
                    <div class="flex gap-2">
                        <a href="https://www.instagram.com/pituwolu.coffee?igsh=MWN5dDl2MWYzY3l6ZQ==" target="_blank" title="Instagram"
                            class="w-9 md:w-10 h-9 md:h-10 rounded-full bg-surface-variant dark:bg-[#1a3a1b] text-on-surface flex items-center justify-center hover:bg-primary hover:text-on-primary transition-all duration-300 shadow-sm hover:scale-110 text-xs md:text-sm">
                            <i class="fab fa-instagram"></i>
                        </a>
                        <a href="https://www.facebook.com/share/18KinaY9AL/" target="_blank" title="Facebook"
                            class="w-9 md:w-10 h-9 md:h-10 rounded-full bg-surface-variant dark:bg-[#1a3a1b] text-on-surface flex items-center justify-center hover:bg-primary hover:text-on-primary transition-all duration-300 shadow-sm hover:scale-110 text-xs md:text-sm">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a href="https://www.tiktok.com/@pituwoluu.coffee?_r=1&_t=ZS-95zpk3Bi28j" target="_blank" title="TikTok"
                            class="w-9 md:w-10 h-9 md:h-10 rounded-full bg-surface-variant dark:bg-[#1a3a1b] text-on-surface flex items-center justify-center hover:bg-primary hover:text-on-primary transition-all duration-300 shadow-sm hover:scale-110 text-xs md:text-sm">
                            <i class="fab fa-tiktok"></i>
                        </a>
                        <a href="https://wa.me/6285810229923" target="_blank" title="WhatsApp"
                            class="w-9 md:w-10 h-9 md:h-10 rounded-full bg-surface-variant dark:bg-[#1a3a1b] text-on-surface flex items-center justify-center hover:bg-primary hover:text-on-primary transition-all duration-300 shadow-sm hover:scale-110 text-xs md:text-sm">
                            <i class="fab fa-whatsapp"></i>
                        </a>
                    </div>
                </div>

            </div>
        </footer>

        <script>
            // Loading Screen
            window.addEventListener('load', () => {
                const loader = document.getElementById('loading-screen');
                setTimeout(() => {
                    loader.style.opacity = '0';
                    loader.style.transition = 'opacity 0.6s ease-in-out';
                    setTimeout(() => loader.classList.add('hidden'), 600);
                }, 800);
            });

            // Global Alpine State with Persist
            document.addEventListener('alpine:init', () => {
                Alpine.data('cartState', () => ({
                    isCartOpen: false,
                    isMobileMenuOpen: false,
                    isDark: document.documentElement.classList.contains('dark'),
                    scrolled: window.pageYOffset > 50,
                    cart: Alpine.$persist([]).as('pituwolu_cart'),

                    get totalItems() {
                        return this.cart.reduce((total, item) => total + item.quantity, 0);
                    },

                    get totalPrice() {
                        return this.cart.reduce((total, item) => total + (item.priceNumber * item.quantity), 0);
                    },

                    addToCart(item) {
                        const existingItem = this.cart.find(i => i.id === item.id);
                        if (existingItem) {
                            existingItem.quantity += 1;
                        } else {
                            // handle prices like "Rp 32.000"
                            const priceString = String(item.price);
                            const priceNumber = parseInt(priceString.replace(/[^0-9]/g, ''), 10);
                            this.cart.push({
                                ...item,
                                quantity: 1,
                                priceNumber: item.priceNumber || priceNumber || 0
                            });
                        }
                        // Show toast instead of opening cart
                        this.showAddedToast(item.title);
                    },

                    showAddedToast(title) {
                        const toast = document.createElement('div');
                        toast.className = 'fixed bottom-20 left-1/2 -translate-x-1/2 z-[80] bg-primary text-on-primary px-6 py-3 rounded-full shadow-2xl font-label font-bold text-sm flex items-center gap-2 animate-[fadeInUp_0.3s_ease-out]';
                        toast.innerHTML = '<span class="material-symbols-outlined text-base">check_circle</span> ' + title + ' ditambahkan!';
                        document.body.appendChild(toast);
                        setTimeout(() => {
                            toast.style.opacity = '0';
                            toast.style.transition = 'opacity 0.4s';
                            setTimeout(() => toast.remove(), 400);
                        }, 1800);
                    },

                    updateQuantity(id, change) {
                        const item = this.cart.find(i => i.id === id);
                        if (item) {
                            item.quantity += change;
                            if (item.quantity <= 0) {
                                this.removeFromCart(id);
                            }
                        }
                    },

                    removeFromCart(id) {
                        this.cart = this.cart.filter(i => i.id !== id);
                    },

                    formatRupiah(number) {
                        return new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR', minimumFractionDigits: 0 }).format(number);
                    },

                    toggleTheme() {
                        document.documentElement.classList.toggle('dark');
                        this.isDark = document.documentElement.classList.contains('dark');
                        localStorage.theme = this.isDark ? 'dark' : 'light';
                    }
                }));
            });

        </script>
        <!-- Global Lightbox Component -->
        <div x-data="{ lightboxOpen: false, lightboxSrc: '' }"
            @open-lightbox.window="lightboxSrc = $event.detail; lightboxOpen = true" x-show="lightboxOpen"
            x-transition.opacity.duration.300ms
            class="fixed inset-0 z-[100] bg-black/95 flex items-center justify-center p-4 backdrop-blur-sm"
            style="display: none;">

            <button @click="lightboxOpen = false"
                class="absolute top-6 right-6 text-white hover:text-gray-300 transition-colors z-[110]">
                <span class="material-symbols-outlined text-4xl">close</span>
            </button>

            <img :src="lightboxSrc" @click.outside="lightboxOpen = false" alt="Expanded image"
                class="max-w-full max-h-[90vh] object-contain rounded-xl shadow-2xl transform transition-transform duration-300 cursor-zoom-out"
                :class="lightboxOpen ? 'scale-100' : 'scale-95'">
        </div>

        <!-- Floating Dark Mode Toggle -->
        <button @click="toggleTheme" class="fixed bottom-6 right-6 z-[90] w-14 h-14 rounded-full bg-surface-container-high text-on-surface shadow-2xl border border-outline-variant hover:scale-110 hover:bg-surface-container-highest transition-all duration-300 flex items-center justify-center" aria-label="Toggle Theme">
            <span class="material-symbols-outlined text-2xl transition-transform duration-500" :class="isDark ? 'rotate-[360deg]' : 'rotate-0'" x-text="isDark ? 'light_mode' : 'dark_mode'"></span>
        </button>

        @stack('scripts')
</body>

</html>