@extends('layouts.app')

@section('title', 'Cerita Kami | Pituwolu')

@section('content')
<div class="pt-24 md:pt-32 pb-24 md:pb-40 bg-surface min-h-screen selection:bg-primary selection:text-on-primary">
    <div class="max-w-screen-xl mx-auto px-6 md:px-8">
        
        <!-- Header -->
        <div class="mb-16 md:mb-24 max-w-4xl">
            <h1 class="text-5xl sm:text-6xl md:text-8xl font-headline text-on-surface mb-6 md:mb-10 leading-[1.1]">
                Kisah di balik <br/>
                <span class="text-primary italic">Pituwolu.</span>
            </h1>
            <p class="text-lg md:text-xl text-on-surface-variant font-body leading-relaxed max-w-2xl">
                Tempat sederhana untuk berbagi cerita bersama dan merangkai makna menjadi sebuah kisah yang indah.
            </p>
        </div>

        <!-- Hero Image -->
        <div class="w-full aspect-square md:aspect-[21/9] rounded-[2rem] overflow-hidden mb-20 md:mb-32">
            <img src="{{ asset('cerita-kami.jpeg') }}" class="w-full h-full object-cover grayscale-[10%] hover:scale-105 transition-transform duration-1000" alt="Pituwolu Coffee Interior">
        </div>

        <!-- Story Section -->
        <div class="flex flex-col lg:flex-row gap-12 lg:gap-24 mb-24 md:mb-40">
            <div class="w-full lg:w-1/3">
                <span class="text-secondary tracking-widest font-label uppercase text-sm font-bold block lg:sticky top-32">AWAL MULA PITUWOLU</span>
                <h2 class="text-3xl md:text-4xl font-bold font-headline text-on-surface mt-4 lg:sticky top-[10rem]">Membangun Ekosistem Kopi Berkelanjutan</h2>
            </div>
            
            <div class="w-full lg:w-2/3">
                <div class="text-on-surface-variant font-body text-lg md:text-xl leading-[1.8] md:leading-[2]">
                    <p class="mb-8 md:mb-10">
                        Berdiri pada tahun 2024, Pituwolu lahir dari keinginan sederhana: "Menyatukan kecintaan terhadap gaya hidup urban modern dengan konsep rumah dengan taman yang asri dan memberikan nuansa tentram yang menciptakan berbagai moment tak terlupakan".
                    </p>
                    <p>
                        Nama <strong class="text-on-surface font-headline font-normal text-2xl">"Pituwolu"</strong> berasal dari bahasa Jawa yang melambangkan filosofi keberkahan dan amanat. Kami percaya bahwa di rumah kami bisa membawa keberkahan bagi semua.
                    </p>
                </div>
            </div>
        </div>

        <!-- Quote -->
        <div class="py-16 md:py-24 border-y border-outline-variant/40 text-center mb-24 md:mb-32 px-4">
            <div class="mb-6 flex justify-center text-[#005138] dark:text-primary">
                <span class="material-symbols-outlined text-4xl">format_quote</span>
            </div>
            <p class="font-headline text-3xl md:text-4xl lg:text-5xl text-on-surface leading-tight max-w-4xl mx-auto italic mb-10">
                "Keselarasan antara hasil Alam dan manusia selalu menciptakan hubungan yang penuh keasrian."
            </p>
            <span class="font-label text-sm md:text-base tracking-[0.2em] md:tracking-[0.3em] uppercase text-secondary font-bold">— FOUNDER PITUWOLU</span>
        </div>

        <!-- Values Section -->
        <div class="mt-20 md:mt-32">
            <div class="mb-16 md:mb-20">
                <span class="text-secondary tracking-widest font-label uppercase text-sm font-bold block mb-4">PILAR KOMITMEN</span>
                <h3 class="text-4xl md:text-5xl lg:text-6xl font-headline text-on-surface">Fondasi Kami</h3>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-12 md:gap-16 border-t border-outline-variant/40 pt-12 md:pt-16">
                <div class="group">
                    <div class="mb-8 text-[#005138] dark:text-primary">
                        <span class="material-symbols-outlined text-5xl font-light transition-transform duration-500 group-hover:-translate-y-2">park</span>
                    </div>
                    <h4 class="text-2xl md:text-3xl font-headline text-on-surface mb-4">Nuansa Alam Terbuka</h4>
                    <p class="text-on-surface-variant font-body leading-relaxed">Mengusung konsep ruang terbuka yang dipenuhi pepohonan asri, memberikan ketenangan dan kesejukan alami di setiap sudutnya.</p>
                </div>
                
                <div class="group">
                    <div class="mb-8 text-[#005138] dark:text-primary">
                        <span class="material-symbols-outlined text-5xl font-light transition-transform duration-500 group-hover:-translate-y-2">verified</span>
                    </div>
                    <h4 class="text-2xl md:text-3xl font-headline text-on-surface mb-4">100% Tersertifikasi Halal</h4>
                    <p class="text-on-surface-variant font-body leading-relaxed">Seluruh sajian menu kopi dan hidangan kami diproses dengan ketat sesuai standar Halal, demi ketenangan dan kenyamanan Anda.</p>
                </div>
                
                <div class="group">
                    <div class="mb-8 text-[#005138] dark:text-primary">
                        <span class="material-symbols-outlined text-5xl font-light transition-transform duration-500 group-hover:-translate-y-2">eco</span>
                    </div>
                    <h4 class="text-2xl md:text-3xl font-headline text-on-surface mb-4">Bahan Baku Alami</h4>
                    <p class="text-on-surface-variant font-body leading-relaxed">Kami meracik setiap sajian dari bahan baku alami terbaik, mempertahankan cita rasa murni yang langsung berasal dari alam.</p>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection
