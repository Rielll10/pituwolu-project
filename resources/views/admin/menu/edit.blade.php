@extends('admin.layouts.app')
@section('title', 'Edit Menu')
@section('page-title', 'Edit Menu')

@section('content')

<div class="max-w-2xl">
    <a href="{{ route('admin.menu.index') }}" class="text-pit-brown hover:text-pit-primary flex items-center gap-2 text-sm font-medium mb-6 transition-colors">
        <span class="material-symbols-outlined text-[18px]">arrow_back</span> Kembali
    </a>

    <div class="bg-surface-card rounded-xl border border-outline-v/30 shadow-[0_4px_20px_rgba(75,54,33,0.04)] overflow-hidden">
        <div class="p-6 border-b border-surface-dim/50">
            <h2 class="font-heading font-semibold text-xl text-on-surface">Edit: {{ $menu->nama_menu }}</h2>
        </div>
        <div class="p-6">
            @if($errors->any())
            <div class="mb-5 px-4 py-3 rounded-xl bg-pit-danger-bg text-pit-danger text-sm border border-pit-danger/20">
                <ul class="list-none space-y-1">@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul>
            </div>
            @endif

            <form method="POST" action="{{ route('admin.menu.update', $menu) }}" enctype="multipart/form-data">
                @csrf @method('PUT')

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-5">
                    <div>
                        <label class="block text-sm font-semibold text-on-surface mb-2">Nama Menu <span class="text-pit-danger">*</span></label>
                        <input type="text" name="nama_menu"
                               class="w-full px-4 py-3 border border-outline-v/50 rounded-lg text-sm text-on-surface bg-white focus:border-pit-brown focus:ring-2 focus:ring-pit-brown/20 outline-none transition-all"
                               value="{{ old('nama_menu', $menu->nama_menu) }}" required>
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-on-surface mb-2">Kategori <span class="text-pit-danger">*</span></label>
                        <select name="category_id"
                                class="w-full px-4 py-3 border border-outline-v/50 rounded-lg text-sm text-on-surface bg-white focus:border-pit-brown focus:ring-2 focus:ring-pit-brown/20 outline-none transition-all" required>
                            @foreach($categories as $cat)
                            <option value="{{ $cat->id }}" {{ old('category_id', $menu->category_id) == $cat->id ? 'selected' : '' }}>{{ $cat->nama_kategori }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="mb-5">
                    <label class="block text-sm font-semibold text-on-surface mb-2">Harga (Rp) <span class="text-pit-danger">*</span></label>
                    <input type="number" name="harga"
                           class="w-full px-4 py-3 border border-outline-v/50 rounded-lg text-sm text-on-surface bg-white focus:border-pit-brown focus:ring-2 focus:ring-pit-brown/20 outline-none transition-all"
                           value="{{ old('harga', $menu->harga) }}" min="0" required>
                </div>

                <div class="mb-5">
                    <label class="block text-sm font-semibold text-on-surface mb-2">Deskripsi</label>
                    <textarea name="deskripsi" rows="3"
                              class="w-full px-4 py-3 border border-outline-v/50 rounded-lg text-sm text-on-surface bg-white focus:border-pit-brown focus:ring-2 focus:ring-pit-brown/20 outline-none transition-all resize-none">{{ old('deskripsi', $menu->deskripsi) }}</textarea>
                </div>

                <div class="mb-5">
                    <label class="block text-sm font-semibold text-on-surface mb-2">Foto Menu <span class="text-xs font-normal text-on-surface-muted">(Maks. 5MB, biarkan kosong jika tidak diganti)</span></label>
                    @if($menu->foto)
                    <div class="mb-3 p-3 bg-surface/50 rounded-lg flex items-center gap-3 border border-outline-v/30">
                        <img src="{{ Storage::url($menu->foto) }}" alt="{{ $menu->nama_menu }}" class="w-20 h-20 object-cover rounded-lg border border-outline-v/50">
                        <div>
                            <div class="text-xs font-semibold text-on-surface">Foto Saat Ini</div>
                            <div class="text-[11px] text-on-surface-muted">Upload baru untuk mengganti</div>
                        </div>
                    </div>
                    @endif
                    <input type="file" name="foto" accept="image/*" id="foto-input"
                           class="w-full px-4 py-3 border border-outline-v/50 rounded-lg text-sm text-on-surface bg-white focus:border-pit-brown outline-none transition-all">
                    <div id="foto-preview" class="mt-3 hidden">
                        <img id="preview-img" src="" alt="Preview" class="w-20 h-20 object-cover rounded-lg border border-outline-v/50">
                    </div>
                </div>

                <div class="mb-6">
                    <label class="flex items-center gap-3 cursor-pointer px-4 py-3 border border-outline-v/30 rounded-lg bg-surface/50 hover:bg-surface-hover transition-colors">
                        <input type="checkbox" name="is_active" value="1" {{ $menu->is_active ? 'checked' : '' }} class="w-4 h-4 rounded accent-pit-brown">
                        <span class="text-sm font-semibold text-on-surface">Tampilkan Menu (Aktif)</span>
                    </label>
                </div>

                {{-- Ice Option --}}
                <div class="mb-5 p-4 border border-outline-v/30 rounded-lg bg-surface/50">
                    <label class="flex items-center gap-3 cursor-pointer mb-3">
                        <input type="checkbox" name="is_ice_available" value="1"
                               {{ old('is_ice_available', $menu->is_ice_available) ? 'checked' : '' }}
                               class="w-4 h-4 rounded accent-pit-brown" id="ice-toggle"
                               onchange="document.getElementById('ice-price-row').classList.toggle('hidden', !this.checked)">
                        <div>
                            <span class="text-sm font-semibold text-on-surface">Tersedia versi Ice</span>
                            <p class="text-[11px] text-on-surface-muted">Centang jika menu ini tersedia dalam versi dingin (es)</p>
                        </div>
                    </label>
                    <div id="ice-price-row" class="{{ old('is_ice_available', $menu->is_ice_available) ? '' : 'hidden' }} ml-7">
                        <label class="block text-xs font-semibold text-on-surface-v mb-1">Tambahan Harga Ice (Rp)</label>
                        <input type="number" name="ice_extra_price"
                               class="w-full px-4 py-2 border border-outline-v/50 rounded-lg text-sm text-on-surface bg-white focus:border-pit-brown focus:ring-2 focus:ring-pit-brown/20 outline-none transition-all"
                               value="{{ old('ice_extra_price', $menu->ice_extra_price) }}" min="0">
                    </div>
                </div>

                <div class="flex gap-3 pt-2">
                    <a href="{{ route('admin.menu.index') }}"
                       class="flex-1 py-3 text-center text-sm font-semibold text-on-surface-v border border-outline-v/50 rounded-lg hover:bg-surface-hover transition-colors">
                        Batal
                    </a>
                    <button type="submit"
                            class="flex-1 py-3 text-sm font-semibold text-white bg-pit-primary hover:bg-pit-primary/90 rounded-lg transition-all flex items-center justify-center gap-2 shadow-sm">
                        <span class="material-symbols-outlined text-[18px]">save</span> Simpan Perubahan
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
