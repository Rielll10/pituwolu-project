@extends('layouts.app')

@section('title', 'Reservasi | Pituwolu')

@section('content')
<div class="pt-6 md:pt-8 pb-24 md:pb-32 bg-surface min-h-screen relative overflow-hidden">
    <!-- Decorative background elements -->
    <div class="absolute top-20 left-0 w-48 sm:w-64 h-48 sm:h-64 bg-primary-container rounded-full opacity-20 blur-3xl -z-0"></div>
    <div class="absolute bottom-20 right-0 w-64 sm:w-96 h-64 sm:h-96 bg-secondary-container rounded-full opacity-20 blur-3xl -z-0"></div>

    <div class="max-w-screen-2xl mx-auto px-4 sm:px-6 md:px-8 relative z-10">
        
        <div class="text-center mb-8 md:mb-16 lg:mb-24">
            <span class="text-secondary font-bold tracking-[0.2em] md:tracking-[0.3em] font-label uppercase text-xs mb-3 md:mb-4 block">Layanan Pituwolu</span>
            <h1 class="text-2xl sm:text-3xl md:text-6xl font-bold font-headline text-on-surface">Reservasi Meja</h1>
            <p class="text-on-surface-variant font-body mt-4 md:mt-6 max-w-2xl mx-auto text-sm md:text-lg leading-relaxed shadow-sm px-2">Kami siap menyambut kedatangan Anda. Selesaikan pesanan Anda dan tentukan waktu kunjungan terbaik Anda untuk pengalaman tak terlupakan.</p>
        </div>

        <div class="w-full max-w-3xl mx-auto" x-data="checkoutLogic()">
            
            <!-- Reservation & Checkout Form -->
            <div class="bg-surface-container border border-surface-container-highest p-6 sm:p-8 md:p-12 rounded-[20px] sm:rounded-[32px] md:rounded-[40px] shadow-sm relative overflow-hidden">
                <!-- Decoration -->
                <div class="absolute top-0 right-0 w-32 sm:w-40 h-32 sm:h-40 bg-primary/10 rounded-bl-full pointer-events-none"></div>
                
                <h2 class="text-2xl sm:text-3xl lg:text-4xl font-bold font-headline mb-6 md:mb-8 border-b pb-4 md:pb-6 border-surface-variant text-on-surface">Formulir Reservasi</h2>
                
                <!-- Cart Indicator -->
                <div class="bg-surface-container-low rounded-2xl sm:rounded-3xl p-4 md:p-6 mb-8 md:mb-10 border border-surface-container-highest shadow-sm flex flex-col sm:flex-row justify-between items-center gap-4 transition-all hover:border-outline/30">
                    <div class="mb-0 text-center sm:text-left">
                        <p class="text-on-surface-variant font-medium text-xs md:text-sm mb-1 font-label">Status Keranjang Anda</p>
                        <p class="font-bold text-lg md:text-xl text-on-surface font-headline">
                            <span x-text="totalItems" class="text-secondary"></span> Item Terpilih
                        </p>
                    </div>
                    <div class="text-center sm:text-right">
                        <p class="text-on-surface-variant font-medium text-xs md:text-sm mb-1 font-label">Estimasi Total Biaya</p>
                        <p class="text-2xl md:text-3xl font-bold text-primary font-headline" x-text="formatRupiah(totalPrice)"></p>
                    </div>
                </div>

                <form method="POST" action="{{ route('reservasi.store') }}" class="space-y-6 md:space-y-8 relative z-10 font-body" x-on:submit="collectCart">
                    @csrf
                    <input type="hidden" name="cart_items" id="cart-items-input">
                    <input type="hidden" name="total_price" id="total-price-input">
                    <div class="space-y-3 md:space-y-4">
                        <h3 class="text-lg md:text-xl font-bold font-headline text-on-surface flex items-center gap-2 mb-4 md:mb-6"><span class="material-symbols-outlined text-secondary text-xl md:text-2xl">person</span> Informasi Data Diri</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 md:gap-6">
                            <div>
                                <label class="block text-xs md:text-sm font-bold text-on-surface mb-2 font-label">Nama Pemesan</label>
                                <input type="text" name="name" x-model="form.name" class="w-full px-4 md:px-5 py-3 md:py-4 rounded-lg md:rounded-2xl bg-surface-container-lowest border border-outline-variant focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition text-on-surface text-sm md:text-base" placeholder="Contoh: Budi Santoso" required>
                            </div>
                            <div>
                                <label class="block text-xs md:text-sm font-bold text-on-surface mb-2 font-label">Nomor WhatsApp Valid</label>
                                <input type="tel" name="phone" x-model="form.phone" class="w-full px-4 md:px-5 py-3 md:py-4 rounded-lg md:rounded-2xl bg-surface-container-lowest border border-outline-variant focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition text-on-surface text-sm md:text-base" placeholder="0812..." required>
                            </div>
                        </div>
                    </div>

                    <div class="space-y-3 md:space-y-4 pt-4 md:pt-6">
                        <h3 class="text-lg md:text-xl font-bold font-headline text-on-surface flex items-center gap-2 mb-4 md:mb-6"><span class="material-symbols-outlined text-secondary text-xl md:text-2xl">event_seat</span> Detail Kunjungan</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 md:gap-6">
                            <div>
                                <label class="block text-xs md:text-sm font-bold text-on-surface mb-2 font-label">Tanggal Kedatangan</label>
                                <input type="date" name="date" x-model="form.date" class="w-full px-4 md:px-5 py-3 md:py-4 rounded-lg md:rounded-2xl bg-surface-container-lowest border border-outline-variant focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition text-on-surface text-sm md:text-base" required>
                            </div>
                            <div>
                                <label class="block text-xs md:text-sm font-bold text-on-surface mb-2 font-label">Kapasitas Orang</label>
                                <select name="pax" x-model="form.pax" class="w-full px-4 md:px-5 py-3 md:py-4 rounded-lg md:rounded-2xl bg-surface-container-lowest border border-outline-variant focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition text-on-surface text-sm md:text-base appearance-none">
                                    <option>1 Orang (Meja Personal)</option>
                                    <option>2 Orang (Meja Pasangan)</option>
                                    <option>3 - 4 Orang (Meja Grup Kecil)</option>
                                    <option>5 - 8 Orang (Meja Komunal)</option>
                                    <option>Lebih dari 8 (Reservasi VIP/Acara)</option>
                                </select>
                            </div>
                            <div class="md:col-span-2">
                                <label class="block text-xs md:text-sm font-bold text-on-surface mb-2 font-label">Waktu Kedatangan</label>
                                <input type="time" name="time" x-model="form.time" class="w-full px-4 md:px-5 py-3 md:py-4 rounded-lg md:rounded-2xl bg-surface-container-lowest border border-outline-variant focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition text-on-surface text-sm md:text-base" required>
                            </div>
                        </div>
                    </div>

                    <div class="space-y-3 md:space-y-4 pt-4 md:pt-6">
                        <h3 class="text-lg md:text-xl font-bold font-headline text-on-surface flex items-center gap-2 mb-4 md:mb-6"><span class="material-symbols-outlined text-secondary text-xl md:text-2xl">speaker_notes</span> Pesan Tambahan</h3>
                        <div>
                            <label class="block text-xs md:text-sm font-bold text-on-surface mb-2 font-label">Catatan Khusus (Opsional)</label>
                            <textarea name="notes" x-model="form.notes" rows="3" class="w-full px-4 md:px-5 py-3 md:py-4 rounded-lg md:rounded-2xl bg-surface-container-lowest border border-outline-variant focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition text-on-surface text-sm md:text-base resize-none" placeholder="Berikan catatan, contoh: Minta meja dekat jendela atau rayakan ulang tahun..."></textarea>
                        </div>
                    </div>
                    
                    <button type="submit" class="w-full mt-8 md:mt-10 py-4 md:py-5 bg-primary text-on-primary font-bold font-label text-xs sm:text-sm tracking-wider rounded-full flex items-center justify-center space-x-2 md:space-x-3 hover:scale-[1.02] shadow-xl shadow-primary/20 transition transform duration-300">
                        <i class="fab fa-whatsapp text-xl md:text-2xl"></i>
                        <span>KIRIM RESERVASI VIA WHATSAPP</span>
                    </button>
                    <p class="text-xs text-center text-on-surface-variant mt-4 md:mt-6 leading-relaxed font-label tracking-wide">Data reservasi tersimpan & dikirim ke admin Pituwolu via WhatsApp.</p>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('alpine:init', () => {
        Alpine.data('checkoutLogic', () => ({
            form: {
                name: '',
                phone: '',
                date: '',
                time: '',
                pax: '1 Orang (Meja Personal)',
                notes: ''
            },

            get cart() {
                // Baca langsung dari localStorage dengan key yang sama seperti di cartState
                return JSON.parse(localStorage.getItem('pituwolu_cart') || '[]');
            },

            get totalItems() {
                return this.cart.reduce((total, item) => total + item.quantity, 0);
            },

            get totalPrice() {
                return this.cart.reduce((total, item) => total + (item.priceNumber * item.quantity), 0);
            },

            formatRupiah(number) {
                return new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR', minimumFractionDigits: 0 }).format(number);
            },

            collectCart() {
                // Ambil cart dari localStorage dengan key yang benar
                const cart = JSON.parse(localStorage.getItem('pituwolu_cart') || '[]');
                const totalPrice = cart.reduce((s, i) => s + (i.priceNumber * i.quantity), 0);
                document.getElementById('cart-items-input').value = JSON.stringify(cart);
                document.getElementById('total-price-input').value = totalPrice;
                // Form submit berlanjut normal ke Laravel
            }
        }));
    });
</script>
@endpushgy7v