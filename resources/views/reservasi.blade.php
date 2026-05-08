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
            <p class="text-on-surface-variant font-body mt-4 md:mt-6 max-w-2xl mx-auto text-sm md:text-lg leading-relaxed shadow-sm px-2">Isi formulir, selesaikan pembayaran, dan reservasi Anda otomatis dikonfirmasi. Simpel, aman, dan terpercaya.</p>
        </div>

        <!-- Alur Reservasi -->
        <div class="w-full max-w-3xl mx-auto mb-10 md:mb-14">
            <div class="grid grid-cols-3 gap-2 text-center">
                <div class="flex flex-col items-center gap-2">
                    <div class="w-10 h-10 rounded-full bg-primary text-on-primary flex items-center justify-center font-bold text-sm shadow-lg shadow-primary/30">1</div>
                    <p class="text-xs font-semibold text-on-surface font-label">Isi Formulir</p>
                </div>
                <div class="flex flex-col items-center gap-2">
                    <div class="w-10 h-10 rounded-full bg-secondary/20 text-secondary flex items-center justify-center font-bold text-sm">2</div>
                    <p class="text-xs font-semibold text-on-surface-variant font-label">Bayar Sekarang</p>
                </div>
                <div class="flex flex-col items-center gap-2">
                    <div class="w-10 h-10 rounded-full bg-secondary/20 text-secondary flex items-center justify-center font-bold text-sm">3</div>
                    <p class="text-xs font-semibold text-on-surface-variant font-label">Konfirmasi WA</p>
                </div>
            </div>
            <div class="relative mt-4">
                <div class="absolute top-1/2 left-[16.5%] right-[16.5%] h-0.5 bg-gradient-to-r from-primary via-secondary/40 to-secondary/20 -translate-y-1/2"></div>
            </div>
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
                        <p class="text-on-surface-variant font-medium text-xs md:text-sm mb-1 font-label">Total Pembayaran</p>
                        <p class="text-2xl md:text-3xl font-bold text-primary font-headline" x-text="formatRupiah(totalPrice)"></p>
                    </div>
                </div>

                <form id="reservasi-form" class="space-y-6 md:space-y-8 relative z-10 font-body">
                    @csrf
                    <input type="hidden" name="cart_items" id="cart-items-input">
                    <input type="hidden" name="total_price" id="total-price-input">
                    <div class="space-y-3 md:space-y-4">
                        <h3 class="text-lg md:text-xl font-bold font-headline text-on-surface flex items-center gap-2 mb-4 md:mb-6"><span class="material-symbols-outlined text-secondary text-xl md:text-2xl">person</span> Informasi Data Diri</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 md:gap-6">
                            <div>
                                <label class="block text-xs md:text-sm font-bold text-on-surface mb-2 font-label">Nama Pemesan</label>
                                <input type="text" name="name" x-model="form.name" id="input-name" class="w-full px-4 md:px-5 py-3 md:py-4 rounded-lg md:rounded-2xl bg-surface-container-lowest border border-outline-variant focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition text-on-surface text-sm md:text-base" placeholder="Contoh: Budi Santoso" required>
                            </div>
                            <div>
                                <label class="block text-xs md:text-sm font-bold text-on-surface mb-2 font-label">Nomor WhatsApp Valid</label>
                                <input type="tel" name="phone" x-model="form.phone" id="input-phone" class="w-full px-4 md:px-5 py-3 md:py-4 rounded-lg md:rounded-2xl bg-surface-container-lowest border border-outline-variant focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition text-on-surface text-sm md:text-base" placeholder="0812..." required>
                            </div>
                        </div>
                    </div>

                    <div class="space-y-3 md:space-y-4 pt-4 md:pt-6">
                        <h3 class="text-lg md:text-xl font-bold font-headline text-on-surface flex items-center gap-2 mb-4 md:mb-6"><span class="material-symbols-outlined text-secondary text-xl md:text-2xl">event_seat</span> Detail Kunjungan</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 md:gap-6">
                            <div>
                                <label class="block text-xs md:text-sm font-bold text-on-surface mb-2 font-label">Tanggal Kedatangan</label>
                                <input type="date" name="date" x-model="form.date" id="input-date" class="w-full px-4 md:px-5 py-3 md:py-4 rounded-lg md:rounded-2xl bg-surface-container-lowest border border-outline-variant focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition text-on-surface text-sm md:text-base" required>
                            </div>
                            <div>
                                <label class="block text-xs md:text-sm font-bold text-on-surface mb-2 font-label">Kapasitas Orang</label>
                                <select name="pax" x-model="form.pax" id="input-pax" class="w-full px-4 md:px-5 py-3 md:py-4 rounded-lg md:rounded-2xl bg-surface-container-lowest border border-outline-variant focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition text-on-surface text-sm md:text-base appearance-none">
                                    <option>1 Orang (Meja Personal)</option>
                                    <option>2 Orang (Meja Pasangan)</option>
                                    <option>3 - 4 Orang (Meja Grup Kecil)</option>
                                    <option>5 - 8 Orang (Meja Komunal)</option>
                                    <option>Lebih dari 8 (Reservasi VIP/Acara)</option>
                                </select>
                            </div>
                            <div class="md:col-span-2">
                                <label class="block text-xs md:text-sm font-bold text-on-surface mb-2 font-label">Waktu Kedatangan</label>
                                <input type="time" name="time" x-model="form.time" id="input-time" class="w-full px-4 md:px-5 py-3 md:py-4 rounded-lg md:rounded-2xl bg-surface-container-lowest border border-outline-variant focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition text-on-surface text-sm md:text-base" required>
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

                    <!-- Payment CTA -->
                    <div class="pt-4">
                        <button type="button" id="pay-button" @click="submitAndPay()"
                            class="w-full mt-4 md:mt-6 py-4 md:py-5 bg-primary text-on-primary font-bold font-label text-xs sm:text-sm tracking-wider rounded-full flex items-center justify-center space-x-2 md:space-x-3 hover:scale-[1.02] shadow-xl shadow-primary/20 transition transform duration-300">
                            <span class="material-symbols-outlined text-xl md:text-2xl">payment</span>
                            <span>LANJUT KE PEMBAYARAN</span>
                        </button>

                        <!-- Loading state -->
                        <div id="payment-loading" class="hidden w-full mt-4 md:mt-6 py-4 md:py-5 bg-primary/50 text-on-primary font-bold font-label text-xs sm:text-sm tracking-wider rounded-full flex items-center justify-center space-x-2 md:space-x-3">
                            <svg class="animate-spin h-5 w-5 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 22 6.477 22 12h-4zm2 6.477A8 8 0 0112 4.063V0C6.477 0 0 6.477 0 12h4z"></path>
                            </svg>
                            <span>MEMPROSES...</span>
                        </div>

                        <!-- Error message -->
                        <div id="payment-error" class="hidden mt-4 p-4 bg-red-50 border border-red-200 rounded-2xl text-red-700 text-sm text-center"></div>


                        <p class="text-xs text-center text-on-surface-variant mt-3 md:mt-4 leading-relaxed font-label tracking-wide">Pembayaran aman & terenkripsi oleh Midtrans. Setelah bayar, konfirmasi otomatis dikirim via WhatsApp.</p>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Midtrans Snap JS -->
<script src="{{ config('midtrans.snap_url') }}" data-client-key="{{ config('midtrans.client_key') }}"></script>
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

            async submitAndPay() {
                // Validasi form
                const name  = document.getElementById('input-name').value.trim();
                const phone = document.getElementById('input-phone').value.trim();
                const date  = document.getElementById('input-date').value;
                const time  = document.getElementById('input-time').value;

                if (!name || !phone || !date || !time) {
                    document.getElementById('payment-error').textContent = 'Harap lengkapi semua field yang wajib diisi.';
                    document.getElementById('payment-error').classList.remove('hidden');
                    return;
                }

                document.getElementById('payment-error').classList.add('hidden');
                document.getElementById('pay-button').classList.add('hidden');
                document.getElementById('payment-loading').classList.remove('hidden');

                // Kumpulkan cart
                const cart       = JSON.parse(localStorage.getItem('pituwolu_cart') || '[]');
                const totalPrice = cart.reduce((s, i) => s + (i.priceNumber * i.quantity), 0);

                const formData = new FormData();
                formData.append('_token', document.querySelector('[name="_token"]').value);
                formData.append('name',        name);
                formData.append('phone',       phone);
                formData.append('date',        date);
                formData.append('time',        time);
                formData.append('pax',         document.getElementById('input-pax').value);
                formData.append('notes',       document.querySelector('[name="notes"]').value);
                formData.append('cart_items',  JSON.stringify(cart));
                formData.append('total_price', totalPrice);

                try {
                    const response = await fetch('/reservasi', {
                        method: 'POST',
                        body: formData,
                    });

                    const data = await response.json();

                    if (data.error) {
                        throw new Error(data.error);
                    }

                    // Buka Midtrans Snap
                    window.snap.pay(data.snap_token, {
                        onSuccess: function(result) {
                            // Redirect ke halaman finish dengan order_id
                            window.location.href = '/reservasi/finish?order_id=' + data.order_id;
                        },
                        onPending: function(result) {
                            window.location.href = '/reservasi/finish?order_id=' + data.order_id;
                        },
                        onError: function(result) {
                            document.getElementById('pay-button').classList.remove('hidden');
                            document.getElementById('payment-loading').classList.add('hidden');
                            document.getElementById('payment-error').textContent = 'Pembayaran gagal. Silakan coba lagi.';
                            document.getElementById('payment-error').classList.remove('hidden');
                        },
                        onClose: function() {
                            document.getElementById('pay-button').classList.remove('hidden');
                            document.getElementById('payment-loading').classList.add('hidden');
                        }
                    });

                } catch (error) {
                    document.getElementById('pay-button').classList.remove('hidden');
                    document.getElementById('payment-loading').classList.add('hidden');
                    document.getElementById('payment-error').textContent = 'Terjadi kesalahan: ' + error.message;
                    document.getElementById('payment-error').classList.remove('hidden');
                }
            }
        }));
    });
</script>
@endpush