@extends('admin.layouts.app')
@section('title', 'Tambah Promo/Event')
@section('page-title', 'Tambah Promo / Event')

@section('content')

<div class="max-w-2xl">
    <a href="{{ route('admin.event.index') }}" class="text-pit-brown hover:text-pit-primary flex items-center gap-2 text-sm font-medium mb-6 transition-colors">
        <span class="material-symbols-outlined text-[18px]">arrow_back</span> Kembali
    </a>

    <div class="bg-surface-card rounded-xl border border-outline-v/30 shadow-[0_4px_20px_rgba(75,54,33,0.04)] overflow-hidden">
        <div class="p-6 border-b border-surface-dim/50">
            <h2 class="font-heading font-semibold text-xl text-on-surface">Form Tambah Promo / Event</h2>
        </div>
        <div class="p-6">
            @if($errors->any())
            <div class="mb-5 px-4 py-3 rounded-xl bg-pit-danger-bg text-pit-danger text-sm border border-pit-danger/20">
                <ul class="list-none space-y-1">@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul>
            </div>
            @endif

            <form method="POST" action="{{ route('admin.event.store') }}" enctype="multipart/form-data">
                @csrf

                {{-- Type selector --}}
                <div class="mb-5">
                    <label class="block text-sm font-semibold text-on-surface mb-2">Tipe Konten <span class="text-pit-danger">*</span></label>
                    <div class="grid grid-cols-2 gap-3">
                        <label class="cursor-pointer">
                            <input type="radio" name="type" value="promo" {{ old('type','event')==='promo' ? 'checked':'' }} class="hidden" id="type-promo">
                            <div id="card-promo" onclick="selectType('promo')"
                                 class="border-2 border-outline-v/50 rounded-xl p-4 text-center transition-all hover:border-pit-brown cursor-pointer">
                                <div class="text-3xl mb-2">🏷️</div>
                                <div class="font-bold text-sm text-on-surface">Promo</div>
                                <div class="text-[11px] text-on-surface-muted">Diskon, potongan harga</div>
                            </div>
                        </label>
                        <label class="cursor-pointer">
                            <input type="radio" name="type" value="event" {{ old('type','event')==='event' ? 'checked':'' }} class="hidden" id="type-event">
                            <div id="card-event" onclick="selectType('event')"
                                 class="border-2 border-pit-brown bg-surface/50 rounded-xl p-4 text-center transition-all cursor-pointer">
                                <div class="text-3xl mb-2">🎉</div>
                                <div class="font-bold text-sm text-on-surface">Event / Keseruan</div>
                                <div class="text-[11px] text-on-surface-muted">Live music, acara khusus</div>
                            </div>
                        </label>
                    </div>
                </div>

                {{-- Title --}}
                <div class="mb-5">
                    <label class="block text-sm font-semibold text-on-surface mb-2">Nama Promo / Event <span class="text-on-surface-muted font-normal">(Hanya untuk Internal Admin)</span> <span class="text-pit-danger">*</span></label>
                    <input type="text" name="title"
                           class="w-full px-4 py-3 border border-outline-v/50 rounded-lg text-sm text-on-surface bg-white focus:border-pit-brown focus:ring-2 focus:ring-pit-brown/20 outline-none transition-all"
                           value="{{ old('title') }}" placeholder="Contoh: Promo Ramadan (Untuk identifikasi)" required>
                </div>

                {{-- Dates --}}
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-5">
                    <div>
                        <label class="block text-sm font-semibold text-on-surface mb-2">Tanggal Mulai <span class="text-on-surface-muted font-normal">(opsional)</span></label>
                        <input type="date" name="start_date"
                               class="w-full px-4 py-3 border border-outline-v/50 rounded-lg text-sm text-on-surface bg-white focus:border-pit-brown focus:ring-2 focus:ring-pit-brown/20 outline-none transition-all"
                               value="{{ old('start_date') }}">
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-on-surface mb-2">Tanggal Selesai <span class="text-on-surface-muted font-normal">(opsional)</span></label>
                        <input type="date" name="end_date"
                               class="w-full px-4 py-3 border border-outline-v/50 rounded-lg text-sm text-on-surface bg-white focus:border-pit-brown focus:ring-2 focus:ring-pit-brown/20 outline-none transition-all"
                               value="{{ old('end_date') }}">
                    </div>
                </div>

                {{-- Link & Sort --}}
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-5">
                    <div>
                        <label class="block text-sm font-semibold text-on-surface mb-2">Link <span class="text-on-surface-muted font-normal">(Instagram, dll)</span></label>
                        <input type="url" name="link"
                               class="w-full px-4 py-3 border border-outline-v/50 rounded-lg text-sm text-on-surface bg-white focus:border-pit-brown focus:ring-2 focus:ring-pit-brown/20 outline-none transition-all"
                               value="{{ old('link') }}" placeholder="https://instagram.com/pituwolucoffee">
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-on-surface mb-2">Urutan Tampil</label>
                        <input type="number" name="sort_order"
                               class="w-full px-4 py-3 border border-outline-v/50 rounded-lg text-sm text-on-surface bg-white focus:border-pit-brown focus:ring-2 focus:ring-pit-brown/20 outline-none transition-all"
                               value="{{ old('sort_order', 0) }}" min="0" placeholder="0">
                        <p class="text-[11px] text-on-surface-muted mt-1">Angka kecil = tampil lebih dulu</p>
                    </div>
                </div>

                {{-- Image Upload --}}
                <div class="mb-5">
                    <label class="block text-sm font-semibold text-on-surface mb-2">Gambar / Foto <span class="text-pit-danger">*</span></label>
                    <div id="drop-zone" onclick="document.getElementById('image-input').click()"
                         class="border-2 border-dashed border-pit-brown/40 rounded-xl p-8 text-center cursor-pointer bg-surface/50 hover:border-pit-brown transition-all"
                         ondragover="event.preventDefault(); this.classList.add('border-pit-brown', 'bg-pit-warning-bg/30');"
                         ondragleave="this.classList.remove('border-pit-brown', 'bg-pit-warning-bg/30');"
                         ondrop="handleDrop(event)">
                        <div id="drop-placeholder">
                            <div class="text-4xl mb-2">📸</div>
                            <p class="text-sm font-semibold text-on-surface-v">Klik atau drag & drop gambar di sini</p>
                            <p class="text-xs text-on-surface-muted mt-1">JPG, PNG, WebP — Max 3MB</p>
                        </div>
                        <div id="image-preview" class="hidden">
                            <img id="preview-img" src="" alt="Preview" class="max-h-56 mx-auto rounded-xl object-cover shadow-md">
                            <p class="text-xs text-on-surface-muted mt-2">Klik untuk ganti gambar</p>
                        </div>
                    </div>
                    <input type="file" id="image-input" name="image" accept="image/*" class="hidden">
                </div>

                {{-- Active --}}
                <div class="mb-6">
                    <label class="flex items-center gap-3 cursor-pointer px-4 py-3 border border-outline-v/30 rounded-lg bg-surface/50 hover:bg-surface-hover transition-colors">
                        <input type="checkbox" name="is_active" value="1" checked class="w-4 h-4 rounded accent-pit-brown">
                        <div>
                            <div class="text-sm font-bold text-on-surface">Tampilkan di Website (Aktif)</div>
                            <div class="text-[11px] text-on-surface-muted">Jika dicentang, konten akan muncul di halaman website</div>
                        </div>
                    </label>
                </div>

                <div class="flex gap-3 pt-2">
                    <a href="{{ route('admin.event.index') }}"
                       class="flex-1 py-3 text-center text-sm font-semibold text-on-surface-v border border-outline-v/50 rounded-lg hover:bg-surface-hover transition-colors">
                        Batal
                    </a>
                    <button type="submit"
                            class="flex-1 py-3 text-sm font-semibold text-white bg-pit-primary hover:bg-pit-primary/90 rounded-lg transition-all flex items-center justify-center gap-2 shadow-sm">
                        <span class="material-symbols-outlined text-[18px]">save</span> Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@push('scripts')
<script>
    function selectType(type) {
        document.getElementById('type-promo').checked = (type === 'promo');
        document.getElementById('type-event').checked = (type === 'event');
        const promoCard = document.getElementById('card-promo');
        const eventCard = document.getElementById('card-event');
        if (type === 'promo') {
            promoCard.classList.add('border-pit-brown', 'bg-surface/50');
            promoCard.classList.remove('border-outline-v/50');
            eventCard.classList.remove('border-pit-brown', 'bg-surface/50');
            eventCard.classList.add('border-outline-v/50');
        } else {
            eventCard.classList.add('border-pit-brown', 'bg-surface/50');
            eventCard.classList.remove('border-outline-v/50');
            promoCard.classList.remove('border-pit-brown', 'bg-surface/50');
            promoCard.classList.add('border-outline-v/50');
        }
    }

    function showPreview(file) {
        if (!file) return;
        const reader = new FileReader();
        reader.onload = (e) => {
            document.getElementById('preview-img').src = e.target.result;
            document.getElementById('drop-placeholder').style.display = 'none';
            document.getElementById('image-preview').classList.remove('hidden');
        };
        reader.readAsDataURL(file);
    }

    document.getElementById('image-input').addEventListener('change', function(e) {
        showPreview(e.target.files[0]);
    });

    function handleDrop(e) {
        e.preventDefault();
        const zone = document.getElementById('drop-zone');
        zone.classList.remove('border-pit-brown', 'bg-pit-warning-bg/30');
        const file = e.dataTransfer.files[0];
        if (file && file.type.startsWith('image/')) {
            const dt = new DataTransfer();
            dt.items.add(file);
            document.getElementById('image-input').files = dt.files;
            showPreview(file);
        }
    }

    selectType('{{ old('type', 'event') }}');
</script>
@endpush

@endsection
