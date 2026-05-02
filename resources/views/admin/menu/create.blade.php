@extends('admin.layouts.app')
@section('title', 'Tambah Menu')
@section('page-title', 'Tambah Menu Baru')

@section('content')

<div class="max-w-2xl">
    <a href="{{ route('admin.menu.index') }}" class="text-pit-brown hover:text-pit-primary flex items-center gap-2 text-sm font-medium mb-6 transition-colors">
        <span class="material-symbols-outlined text-[18px]">arrow_back</span> Kembali ke Daftar Menu
    </a>

    <div class="bg-surface-card rounded-xl border border-outline-v/30 shadow-[0_4px_20px_rgba(75,54,33,0.04)] overflow-hidden">
        <div class="p-6 border-b border-surface-dim/50">
            <h2 class="font-heading font-semibold text-xl text-on-surface">Form Tambah Menu</h2>
        </div>
        <div class="p-6">
            @if($errors->any())
            <div class="mb-5 px-4 py-3 rounded-xl bg-pit-danger-bg text-pit-danger text-sm border border-pit-danger/20">
                <ul class="list-none space-y-1">@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul>
            </div>
            @endif

            <form method="POST" action="{{ route('admin.menu.store') }}" enctype="multipart/form-data">
                @csrf

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-5">
                    <div>
                        <label class="block text-sm font-semibold text-on-surface mb-2">Nama Menu <span class="text-pit-danger">*</span></label>
                        <input type="text" name="nama_menu"
                               class="w-full px-4 py-3 border border-outline-v/50 rounded-lg text-sm text-on-surface bg-white focus:border-pit-brown focus:ring-2 focus:ring-pit-brown/20 outline-none transition-all"
                               value="{{ old('nama_menu') }}" placeholder="Contoh: Kopi Susu Aren" required>
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-on-surface mb-2">Kategori <span class="text-pit-danger">*</span></label>
                        <select name="category_id"
                                class="w-full px-4 py-3 border border-outline-v/50 rounded-lg text-sm text-on-surface bg-white focus:border-pit-brown focus:ring-2 focus:ring-pit-brown/20 outline-none transition-all" required>
                            <option value="">-- Pilih Kategori --</option>
                            @foreach($categories as $cat)
                            <option value="{{ $cat->id }}" {{ old('category_id') == $cat->id ? 'selected' : '' }}>{{ $cat->nama_kategori }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="mb-5">
                    <label class="block text-sm font-semibold text-on-surface mb-2">Harga (Rp) <span class="text-pit-danger">*</span></label>
                    <input type="number" name="harga"
                           class="w-full px-4 py-3 border border-outline-v/50 rounded-lg text-sm text-on-surface bg-white focus:border-pit-brown focus:ring-2 focus:ring-pit-brown/20 outline-none transition-all"
                           value="{{ old('harga') }}" placeholder="25000" min="0" required>
                </div>

                <div class="mb-5">
                    <label class="block text-sm font-semibold text-on-surface mb-2">Deskripsi</label>
                    <textarea name="deskripsi" rows="3"
                              class="w-full px-4 py-3 border border-outline-v/50 rounded-lg text-sm text-on-surface bg-white focus:border-pit-brown focus:ring-2 focus:ring-pit-brown/20 outline-none transition-all resize-none"
                              placeholder="Deskripsi singkat menu...">{{ old('deskripsi') }}</textarea>
                </div>

                <div class="mb-5">
                    <label class="block text-sm font-semibold text-on-surface mb-2">Foto Menu <span class="text-xs font-normal text-on-surface-muted">(Maks. 5MB)</span></label>
                    <input type="file" name="foto" accept="image/*" id="foto-input"
                           class="w-full px-4 py-3 border border-outline-v/50 rounded-lg text-sm text-on-surface bg-white focus:border-pit-brown outline-none transition-all">
                    <div id="foto-preview" class="mt-3 hidden">
                        <img id="preview-img" src="" alt="Preview" class="w-24 h-24 object-cover rounded-lg border border-outline-v/50">
                    </div>
                </div>

                {{-- Ice Option --}}
                <div class="mb-5 p-4 border border-outline-v/30 rounded-lg bg-surface/50">
                    <label class="flex items-center gap-3 cursor-pointer mb-3">
                        <input type="checkbox" name="is_ice_available" value="1" {{ old('is_ice_available') ? 'checked' : '' }}
                               class="w-4 h-4 rounded accent-pit-brown" id="ice-toggle"
                               onchange="document.getElementById('ice-price-row').classList.toggle('hidden', !this.checked)">
                        <div>
                            <span class="text-sm font-semibold text-on-surface">Tersedia versi Ice</span>
                            <p class="text-[11px] text-on-surface-muted">Centang jika menu ini tersedia dalam versi dingin (es)</p>
                        </div>
                    </label>
                    <div id="ice-price-row" class="{{ old('is_ice_available') ? '' : 'hidden' }} ml-7">
                        <label class="block text-xs font-semibold text-on-surface-v mb-1">Tambahan Harga Ice (Rp)</label>
                        <input type="number" name="ice_extra_price"
                               class="w-full px-4 py-2 border border-outline-v/50 rounded-lg text-sm text-on-surface bg-white focus:border-pit-brown focus:ring-2 focus:ring-pit-brown/20 outline-none transition-all"
                               value="{{ old('ice_extra_price', 2000) }}" min="0">
                    </div>
                </div>

                <div class="mb-6">
                    <label class="flex items-center gap-3 cursor-pointer px-4 py-3 border border-outline-v/30 rounded-lg bg-surface/50 hover:bg-surface-hover transition-colors">
                        <input type="checkbox" name="is_active" value="1" checked class="w-4 h-4 rounded accent-pit-brown">
                        <span class="text-sm font-semibold text-on-surface">Tampilkan Menu (Aktif)</span>
                    </label>
                </div>

                <div class="flex gap-3 pt-2">
                    <a href="{{ route('admin.menu.index') }}"
                       class="flex-1 py-3 text-center text-sm font-semibold text-on-surface-v border border-outline-v/50 rounded-lg hover:bg-surface-hover transition-colors">
                        Batal
                    </a>
                    <button type="submit"
                            class="flex-1 py-3 text-sm font-semibold text-white bg-pit-primary hover:bg-pit-primary/90 rounded-lg transition-all flex items-center justify-center gap-2 shadow-sm">
                        <span class="material-symbols-outlined text-[18px]">save</span> Simpan Menu
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@push('scripts')
<script>
    document.getElementById('foto-input').addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = (ev) => {
                document.getElementById('preview-img').src = ev.target.result;
                document.getElementById('foto-preview').classList.remove('hidden');
            };
            reader.readAsDataURL(file);
        }
    });
</script>
@endpush

@endsection
