@extends('layouts.app')

@section('title', 'Hubungi Kami | Pituwolu')

@section('content')
<div class="pt-6 md:pt-8 pb-24 md:pb-32 bg-surface min-h-screen relative overflow-hidden">
    <!-- Decorative background elements -->
    <div class="absolute top-20 left-0 w-48 sm:w-64 h-48 sm:h-64 bg-primary-container rounded-full opacity-20 blur-3xl -z-0"></div>
    <div class="absolute bottom-20 right-0 w-64 sm:w-96 h-64 sm:h-96 bg-secondary-container rounded-full opacity-20 blur-3xl -z-0"></div>

    <div class="max-w-screen-2xl mx-auto px-4 sm:px-6 md:px-8 relative z-10">
        
        <div class="text-center mb-8 md:mb-16 lg:mb-24">
            <span class="text-secondary font-bold tracking-[0.2em] md:tracking-[0.3em] font-label uppercase text-xs mb-3 md:mb-4 block">Layanan Pituwolu</span>
            <h1 class="text-2xl sm:text-3xl md:text-6xl font-bold font-headline text-on-surface">Hubungi Kami</h1>
            <p class="text-on-surface-variant font-body mt-4 md:mt-6 max-w-2xl mx-auto text-sm md:text-lg leading-relaxed shadow-sm px-2">Hubungi kami untuk informasi lebih lanjut atau berikan ulasan Anda tentang pengalaman di Pituwolu.</p>
        </div>

        <div class="flex flex-col lg:flex-row gap-6 md:gap-8 lg:gap-10 xl:gap-16 max-w-7xl mx-auto">
            
            <!-- Sidemenu & Maps Info -->
            <div class="w-full lg:w-[50%] flex flex-col">
                <!-- Location Panel + Maps -->
                <div class="bg-surface-container p-6 sm:p-8 md:p-10 rounded-[20px] sm:rounded-[32px] md:rounded-[40px] shadow-sm border border-surface-container-highest flex flex-col gap-6 md:gap-8">
                    <div class="flex items-center space-x-3 md:space-x-4">
                        <div class="w-12 sm:w-14 md:w-16 h-12 sm:h-14 md:h-16 rounded-full bg-secondary-container text-on-secondary-container flex items-center justify-center text-2xl md:text-3xl shrink-0 shadow-sm border-2 border-secondary/20">
                            <span class="material-symbols-outlined text-error">pin_drop</span>
                        </div>
                        <h3 class="text-xl sm:text-2xl md:text-3xl font-bold font-headline text-on-surface">Kunjungi Pituwolu</h3>
                    </div>
                    <div class="space-y-6 md:space-y-8 font-body">
                        <div class="flex items-start space-x-5 group">
                            <span class="material-symbols-outlined text-primary mt-1 shrink-0">location_on</span>
                            <div>
                                <p class="font-bold text-on-surface group-hover:text-primary transition font-headline text-lg">Alamat Kedai</p>
                                <p class="text-on-surface-variant mt-2 leading-relaxed text-sm">Jl. Abdul Wahab Gg. Nangka No.68, Sawangan, Kec. Sawangan, Kota Depok, Jawa Barat 16511</p>
                                <a href="https://maps.app.goo.gl/wGpBMm4ynNciprMn9" target="_blank" class="inline-flex items-center gap-1 text-primary text-xs font-bold font-label mt-2 hover:underline">
                                    <span class="material-symbols-outlined text-[14px]">map</span> Lihat Rute
                                </a>
                            </div>
                        </div>
                        <div class="w-full h-px bg-surface-variant"></div>
                        <div class="flex items-start space-x-5 group">
                            <span class="material-symbols-outlined text-primary mt-1 shrink-0">schedule</span>
                            <div>
                                <p class="font-bold text-on-surface group-hover:text-primary transition font-headline text-lg">Jam Operasional</p>
                                <p class="text-on-surface-variant mt-2 leading-relaxed text-sm">Setiap Hari : 10:00 - 23:00 WIB</p>
                            </div>
                        </div>
                        <div class="w-full h-px bg-surface-variant"></div>
                        <div class="flex items-start space-x-5 group">
                            <span class="material-symbols-outlined text-primary mt-1 shrink-0">chat</span>
                            <div>
                                <p class="font-bold text-on-surface group-hover:text-primary transition font-headline text-lg">WhatsApp Business</p>
                                <p class="text-on-surface-variant mt-2 leading-relaxed text-sm hover:underline">
                                    <a href="https://wa.me/6285810229923" target="_blank">+62 858-1022-9923</a>
                                </p>
                            </div>
                        </div>
                        <div class="w-full h-px bg-surface-variant"></div>
                        <div class="flex items-start space-x-5 group">
                            <span class="material-symbols-outlined text-primary mt-1 shrink-0">mail</span>
                            <div>
                                <p class="font-bold text-on-surface group-hover:text-primary transition font-headline text-lg">Email Dukungan</p>
                                <p class="text-on-surface-variant mt-2 leading-relaxed text-sm hover:underline"><a href="mailto:pituwolu.perjaka3@gmail.com">pituwolu.perjaka3@gmail.com</a></p>
                            </div>
                        </div>
                    </div>

                    <!-- Embedded Maps -->
                    <div class="w-full h-[200px] sm:h-[260px] md:h-[300px] rounded-[16px] sm:rounded-[20px] md:rounded-[24px] overflow-hidden relative border border-surface-container-highest shadow-sm group">
                        <a href="https://maps.app.goo.gl/wGpBMm4ynNciprMn9" target="_blank" class="absolute inset-0 bg-primary/0 group-hover:bg-primary/20 transition z-20 flex items-center justify-center duration-500 cursor-pointer">
                            <span class="opacity-0 group-hover:opacity-100 bg-black/70 text-white font-label text-sm px-5 py-2.5 rounded-full font-bold shadow-lg transition-opacity duration-500 backdrop-blur-sm flex items-center gap-2 transform translate-y-4 group-hover:translate-y-0">
                                <span class="material-symbols-outlined text-[18px]">open_in_new</span> Buka di Google Maps
                            </span>
                        </a>
                        <iframe src="https://maps.google.com/maps?q=Pituwolu+Coffee+Sawangan+Depok&t=&z=15&ie=UTF8&iwloc=&output=embed"
                            width="100%" height="100%" class="absolute inset-0 w-full h-full grayscale-[20%] group-hover:grayscale-0 transition duration-700 pointer-events-none" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                    </div>
                </div>
            </div>


            <!-- User Feedback Form -->
            <div class="w-full lg:w-[50%]">
                <div class="bg-surface-container p-8 md:p-10 rounded-[40px] shadow-sm border border-surface-container-highest h-full flex flex-col" x-data="feedbackLogic()">
                    <div class="flex items-center space-x-4 mb-8">
                        <div class="w-12 h-12 rounded-full bg-primary-container text-on-primary-container flex items-center justify-center text-xl shrink-0 shadow-sm border-2 border-primary/20">
                            <span class="material-symbols-outlined" style="font-variation-settings: 'FILL' 1;">star</span>
                        </div>
                        <h3 class="text-2xl font-bold font-headline text-on-surface">Ulasan Anda</h3>
                    </div>

                    @if(session('success'))
                    <div class="mb-6 px-5 py-4 rounded-2xl font-body text-sm font-medium flex items-center gap-2" style="background:#f0fdf4; border:1px solid #bbf7d0; color:#166534;">
                        <span class="material-symbols-outlined" style="color:#16a34a;">check_circle</span>
                        {{ session('success') }}
                    </div>
                    @endif

                    <form method="POST" action="{{ route('review.store') }}" class="space-y-6 font-body flex-1 flex flex-col" x-on:submit="prepareRating($event)">
                        @csrf
                        <input type="hidden" name="rating" x-bind:value="rating" id="rating-input">
                        <div>
                            <label class="block text-sm font-bold text-on-surface mb-2 font-label">Nama Anda (Opsional)</label>
                            <input type="text" name="nama_pengulas" class="w-full px-5 py-4 rounded-2xl bg-surface-container-lowest border border-outline-variant focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition text-on-surface" placeholder="Kosongkan untuk menampilkan Guest" value="{{ old('nama_pengulas') }}">
                        </div>
                        <div>
                            <label class="block text-sm font-bold text-on-surface mb-3 font-label">Beri Rating Bintang (1-5)</label>
                            <div class="flex items-center gap-2">
                                <template x-for="i in 5" :key="i">
                                    <button type="button" @click="rating = i" class="focus:outline-none transition-transform hover:scale-110 group">
                                        <span class="material-symbols-outlined text-3xl transition-colors duration-300" 
                                              :class="rating >= i ? 'text-secondary' : 'text-outline hover:text-secondary/50'" 
                                              :style="rating >= i ? 'font-variation-settings: \'FILL\' 1;' : 'font-variation-settings: \'FILL\' 0;'">star</span>
                                    </button>
                                </template>
                                <span class="ml-4 font-label text-xs tracking-widest font-bold text-on-surface-variant bg-surface-variant px-3 py-1 rounded-full border border-outline-variant" x-text="rating > 0 ? rating + ' BINTANG' : 'BELUM DINILAI'"></span>
                            </div>
                        </div>
                        <div class="flex-1">
                            <label class="block text-sm font-bold text-on-surface mb-2 font-label">Pesan & Masukan</label>
                            <textarea name="ulasan" rows="6" class="w-full h-32 px-5 py-4 rounded-2xl bg-surface-container-lowest border border-outline-variant focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition text-on-surface resize-none" placeholder="Ceritakan pengalaman Pituwolu Kalian di sini..." required>{{ old('ulasan') }}</textarea>
                        </div>
                        <button type="submit" class="mt-auto w-full py-4 bg-primary text-on-primary font-bold font-label text-sm tracking-wider rounded-2xl flex items-center justify-center space-x-2 hover:scale-[1.02] transition transform duration-300 shadow-[0_8px_16px_rgba(23,52,24,0.2)]">
                            <span>KIRIM TANGGAPAN</span>
                            <span class="material-symbols-outlined text-sm">send</span>
                        </button>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('alpine:init', () => {
        Alpine.data('feedbackLogic', () => ({
            rating: 0,
            prepareRating(e) {
                if (this.rating === 0) {
                    e.preventDefault();
                    alert('Mohon klik dan berikan rating (bintang) terlebih dahulu!');
                    return;
                }
                document.getElementById('rating-input').value = this.rating;
            }
        }));
    });
</script>
@endpush
