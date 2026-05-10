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
                    <p class="text-xs font-semibold text-on-surface-variant font-label">Pesan Menu (Opsional)</p>
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

        <div class="w-full max-w-3xl mx-auto" x-data="reservasiLogic()">
            
            <!-- Reservation & Checkout Form -->
            <div class="bg-surface-container border border-surface-container-highest p-6 sm:p-8 md:p-12 rounded-[20px] sm:rounded-[32px] md:rounded-[40px] shadow-sm relative overflow-hidden">
                <!-- Decoration -->
                <div class="absolute top-0 right-0 w-32 sm:w-40 h-32 sm:h-40 bg-primary/10 rounded-bl-full pointer-events-none"></div>
                
                <h2 class="text-2xl sm:text-3xl lg:text-4xl font-bold font-headline mb-6 md:mb-8 border-b pb-4 md:pb-6 border-surface-variant text-on-surface">Formulir Reservasi</h2>
                
                <form id="reservasi-form" class="space-y-6 md:space-y-8 relative z-10 font-body">
                    @csrf
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
                                    <option>1 Orang</option>
                                    <option>2 Orang</option>
                                    <option>3 Orang</option>
                                    <option>4 Orang</option>
                                    <option>5 Orang</option>
                                    <option>6 Orang</option>
                                    <option>7 Orang</option>
                                    <option>8 Orang</option>
                                    <option>Lebih dari 8 Orang</option>
                                </select>
                            </div>
                            <div class="md:col-span-2">
                                <label class="block text-xs md:text-sm font-bold text-on-surface mb-2 font-label">Waktu Kedatangan</label>
                                <input type="time" name="time" x-model="form.time" id="input-time" class="w-full px-4 md:px-5 py-3 md:py-4 rounded-lg md:rounded-2xl bg-surface-container-lowest border border-outline-variant focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition text-on-surface text-sm md:text-base" required>
                            </div>
                        </div>
                    </div>

                    <div class="space-y-3 md:space-y-4 pt-4 md:pt-6 border-t border-surface-variant">
                        <div class="flex items-center gap-3">
                            <input type="checkbox" id="wants-menu" x-model="wantsMenu" class="w-5 h-5 text-primary bg-surface border-outline-variant rounded focus:ring-primary">
                            <label for="wants-menu" class="text-sm md:text-base font-bold text-on-surface cursor-pointer">Apakah ingin sekalian pesan menu? (Opsional)</label>
                        </div>
                        
                        <!-- Menu Selection (Visible if wantsMenu is true) -->
                        <div x-show="wantsMenu" x-transition.opacity.duration.300ms class="mt-4 bg-surface-container-low p-4 md:p-6 rounded-2xl border border-outline-variant/30">
                            <h4 class="text-sm md:text-base font-bold text-on-surface mb-4 font-label">Katalog Menu:</h4>
                            
                            <!-- Search -->
                            <input type="text" x-model="menuSearch" placeholder="Cari minuman atau camilan..." class="w-full mb-4 md:mb-6 px-4 md:px-5 py-3 text-sm md:text-base rounded-lg md:rounded-xl border border-outline-variant bg-surface-container-lowest focus:outline-none focus:ring-2 focus:ring-primary">

                            <div class="max-h-[500px] overflow-y-auto pr-2 custom-scrollbar">
                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 text-left">
                                    <template x-for="menu in filteredMenus" :key="menu.id">
                                        <div x-data="{ addIce: false }" class="bg-surface-container-lowest border border-surface-container-highest rounded-2xl overflow-hidden shadow-sm hover:shadow-md flex flex-col items-center transition duration-300">
                                            <div class="relative w-full h-32 sm:h-40 bg-surface-container border-b border-surface-container-highest">
                                                <template x-if="menu.image_url">
                                                    <img :src="menu.image_url" :alt="menu.nama_menu" class="w-full h-full object-cover">
                                                </template>
                                                <template x-if="!menu.image_url">
                                                    <div class="w-full h-full flex items-center justify-center text-4xl">☕</div>
                                                </template>
                                            </div>
                                            <div class="p-4 w-full flex flex-col flex-1">
                                                <p class="text-[10px] font-label font-bold text-secondary uppercase tracking-wider mb-1 line-clamp-1" x-text="menu.category?.nama_kategori || 'Menu'"></p>
                                                <h3 class="text-sm md:text-base font-bold text-on-surface font-headline mb-1 line-clamp-2" x-text="menu.nama_menu"></h3>
                                                <p class="text-xs text-on-surface-variant font-body line-clamp-2 mb-3" x-text="menu.deskripsi || 'Sajian spesial dari Pituwolu'"></p>
                                                
                                                <template x-if="menu.is_ice_available">
                                                    <label class="flex items-center gap-2 cursor-pointer px-2 py-1.5 rounded-lg bg-surface-container/50 border border-surface-container-highest mb-2 select-none hover:bg-surface-container transition-colors">
                                                        <input type="checkbox" x-model="addIce" class="w-3 h-3 rounded accent-[#173418] cursor-pointer">
                                                        <span class="text-[10px] font-label font-semibold text-on-surface">Tambah Es</span>
                                                        <span class="text-[10px] font-label font-bold text-secondary ml-auto" x-text="'(+' + formatRupiah(menu.ice_extra_price) + ')'"></span>
                                                    </label>
                                                </template>

                                                <div class="mt-auto pt-3 border-t border-surface-variant flex items-center justify-between">
                                                    <div>
                                                        <span class="text-sm font-bold text-primary" x-text="formatRupiah(addIce ? (menu.harga + menu.ice_extra_price) : menu.harga)"></span>
                                                        <div x-show="addIce" class="text-[9px] text-on-surface-variant font-label mt-0.5" x-text="formatRupiah(menu.harga) + ' + Es'"></div>
                                                    </div>
                                                    
                                                    <!-- Qty Controls -->
                                                    <div class="flex items-center gap-2">
                                                        <template x-if="getQty(menu.id, addIce) === 0">
                                                            <button type="button" @click="incrementQty(menu, addIce)" class="px-3 py-1.5 bg-primary text-on-primary text-xs font-bold rounded-lg hover:bg-primary/90 transition shadow-sm font-label tracking-wider">TAMBAH</button>
                                                        </template>
                                                        <template x-if="getQty(menu.id, addIce) > 0">
                                                            <div class="flex items-center gap-1 bg-surface-container-high rounded-lg p-1 border border-outline-variant/30">
                                                                <button type="button" @click="decrementQty(menu, addIce)" class="w-6 h-6 rounded flex items-center justify-center bg-surface text-on-surface hover:bg-surface-variant shadow-sm transition">
                                                                    <span class="material-symbols-outlined text-sm">remove</span>
                                                                </button>
                                                                <span class="text-xs font-bold w-6 text-center text-on-surface" x-text="getQty(menu.id, addIce)"></span>
                                                                <button type="button" @click="incrementQty(menu, addIce)" class="w-6 h-6 rounded flex items-center justify-center bg-primary text-on-primary shadow-sm transition">
                                                                    <span class="material-symbols-outlined text-sm">add</span>
                                                                </button>
                                                            </div>
                                                        </template>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </template>
                                </div>
                                <div x-show="filteredMenus.length === 0" class="py-8 text-center text-on-surface-variant text-sm font-body">Menu tidak ditemukan.</div>
                            </div>
                            
                            <div class="mt-6 flex justify-between items-center border-t-2 border-surface-variant pt-4">
                                <span class="text-sm md:text-base font-bold text-on-surface-variant">Total Pesanan Tambahan:</span>
                                <span class="text-lg md:text-xl font-bold text-primary font-headline" x-text="formatRupiah(totalMenuPrice)"></span>
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

                    <!-- Submit CTA -->
                    <div class="pt-4">
                        <button type="button" id="submit-button" @click="submitReservasi()"
                            class="w-full mt-4 md:mt-6 py-4 md:py-5 bg-primary text-on-primary font-bold font-label text-xs sm:text-sm tracking-wider rounded-full flex items-center justify-center space-x-2 md:space-x-3 hover:scale-[1.02] shadow-xl shadow-primary/20 transition transform duration-300">
                            <span class="material-symbols-outlined text-xl md:text-2xl">send</span>
                            <span>KONFIRMASI RESERVASI VIA WA</span>
                        </button>

                        <!-- Loading state -->
                        <div id="submit-loading" class="hidden w-full mt-4 md:mt-6 py-4 md:py-5 bg-primary/50 text-on-primary font-bold font-label text-xs sm:text-sm tracking-wider rounded-full flex items-center justify-center space-x-2 md:space-x-3">
                            <svg class="animate-spin h-5 w-5 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 22 6.477 22 12h-4zm2 6.477A8 8 0 0112 4.063V0C6.477 0 0 6.477 0 12h4z"></path>
                            </svg>
                            <span>MEMPROSES...</span>
                        </div>

                        <!-- Error message -->
                        <div id="submit-error" class="hidden mt-4 p-4 bg-red-50 border border-red-200 rounded-2xl text-red-700 text-sm text-center"></div>

                        <p class="text-xs text-center text-on-surface-variant mt-3 md:mt-4 leading-relaxed font-label tracking-wide">Data reservasi Anda akan dikirim langsung ke WhatsApp Pituwolu Coffee untuk konfirmasi admin.</p>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
    document.addEventListener('alpine:init', () => {
        Alpine.data('reservasiLogic', () => ({
            form: {
                name: '',
                phone: '',
                date: '',
                time: '',
                pax: '1 Orang',
                notes: ''
            },
            wantsMenu: false,
            menuSearch: '',
            menus: @json(isset($menus) ? collect($menus)->map(function($m) {
                $m->image_url = $m->foto ? Storage::url($m->foto) : null;
                $m->load('category');
                return $m;
            }) : []),
            selectedMenus: {}, // format: { menu_id: quantity }

            get filteredMenus() {
                if (this.menuSearch.trim() === '') {
                    return this.menus;
                }
                const lowerCaseSearch = this.menuSearch.toLowerCase();
                return this.menus.filter(menu => menu.nama_menu.toLowerCase().includes(lowerCaseSearch));
            },

            getVariantId(menuId, isIce) {
                return isIce ? menuId + '_ice' : menuId + '';
            },

            getQty(menuId, isIce) {
                const vid = this.getVariantId(menuId, isIce);
                return this.selectedMenus[vid]?.quantity || 0;
            },

            incrementQty(menu, isIce) {
                const vid = this.getVariantId(menu.id, isIce);
                if (!this.selectedMenus[vid]) {
                    this.selectedMenus[vid] = {
                        menu_id: menu.id,
                        is_ice: isIce,
                        quantity: 0
                    };
                }
                this.selectedMenus[vid].quantity++;
            },

            decrementQty(menu, isIce) {
                const vid = this.getVariantId(menu.id, isIce);
                if (this.selectedMenus[vid] && this.selectedMenus[vid].quantity > 0) {
                    this.selectedMenus[vid].quantity--;
                    if (this.selectedMenus[vid].quantity === 0) {
                        delete this.selectedMenus[vid];
                    }
                }
            },

            get totalMenuPrice() {
                let total = 0;
                for (const vid in this.selectedMenus) {
                    const item = this.selectedMenus[vid];
                    const menu = this.menus.find(m => m.id === item.menu_id);
                    if (menu) {
                        const price = item.is_ice ? (menu.harga + menu.ice_extra_price) : menu.harga;
                        total += price * item.quantity;
                    }
                }
                return total;
            },

            formatRupiah(number) {
                return new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR', minimumFractionDigits: 0 }).format(number);
            },

            async submitReservasi() {
                // Validasi form
                const name  = document.getElementById('input-name').value.trim();
                const phone = document.getElementById('input-phone').value.trim();
                const date  = document.getElementById('input-date').value;
                const time  = document.getElementById('input-time').value;

                if (!name || !phone || !date || !time) {
                    document.getElementById('submit-error').textContent = 'Harap lengkapi semua field wajib (Nama, WhatsApp, Tanggal, Jam).';
                    document.getElementById('submit-error').classList.remove('hidden');
                    return;
                }

                document.getElementById('submit-error').classList.add('hidden');
                document.getElementById('submit-button').classList.add('hidden');
                document.getElementById('submit-loading').classList.remove('hidden');

                // Siapkan data menu yang dipesan (bila ada)
                const cartItems = [];
                if (this.wantsMenu) {
                    for (const vid in this.selectedMenus) {
                        const item = this.selectedMenus[vid];
                        const menu = this.menus.find(m => m.id === item.menu_id);
                        if (menu && item.quantity > 0) {
                            const isIce = item.is_ice;
                            const title = menu.nama_menu + (isIce ? ' (Ice)' : '');
                            const price = isIce ? (menu.harga + menu.ice_extra_price) : menu.harga;
                            const cartId = isIce ? menu.id + 10000 : menu.id;

                            cartItems.push({
                                id: cartId,
                                title: title,
                                priceNumber: price,
                                quantity: item.quantity
                            });
                        }
                    }
                }

                const formData = new FormData();
                formData.append('_token', document.querySelector('[name="_token"]').value);
                formData.append('name', name);
                formData.append('phone', phone);
                formData.append('date', date);
                formData.append('time', time);
                formData.append('pax', document.getElementById('input-pax').value);
                formData.append('notes', document.querySelector('[name="notes"]').value);
                formData.append('cart_items', JSON.stringify(cartItems));

                try {
                    const response = await fetch('/reservasi', {
                        method: 'POST',
                        body: formData,
                    });

                    const data = await response.json();

                    if (data.error) {
                        throw new Error(data.error);
                    }

                    if (data.status === 'success' && data.wa_link) {
                        // Redirect langsung ke WA
                        window.location.href = data.wa_link;
                    }

                } catch (error) {
                    document.getElementById('submit-button').classList.remove('hidden');
                    document.getElementById('submit-loading').classList.add('hidden');
                    document.getElementById('submit-error').textContent = 'Terjadi kesalahan: ' + error.message;
                    document.getElementById('submit-error').classList.remove('hidden');
                }
            }
        }));
    });
</script>
<style>
    .custom-scrollbar::-webkit-scrollbar {
        width: 6px;
    }
    .custom-scrollbar::-webkit-scrollbar-track {
        background: transparent;
    }
    .custom-scrollbar::-webkit-scrollbar-thumb {
        background-color: rgb(200, 200, 200);
        border-radius: 20px;
    }
</style>
@endpush