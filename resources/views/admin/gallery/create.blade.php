@extends('admin.layouts.app')
@section('title', 'Tambah Galeri | Admin Pituwolu')
@section('page-title', 'Tambah Galeri')

@section('content')

<div class="max-w-2xl">
    {{-- Back --}}
    <a href="{{ route('admin.gallery.index') }}" class="text-pit-brown hover:text-pit-primary flex items-center gap-2 text-sm font-medium mb-6 transition-colors">
        <span class="material-symbols-outlined text-[18px]">arrow_back</span> Kembali ke Daftar Galeri
    </a>

    <div class="bg-surface-card rounded-xl border border-outline-v/30 shadow-[0_4px_20px_rgba(75,54,33,0.04)] overflow-hidden">
        <div class="p-6 border-b border-surface-dim/50">
            <h2 class="font-heading font-semibold text-xl text-on-surface">Tambah Galeri Baru</h2>
        </div>
        <div class="p-6">
            @if($errors->any())
            <div class="mb-5 px-4 py-3 rounded-xl bg-pit-danger-bg text-pit-danger text-sm border border-pit-danger/20">
                <ul class="list-none space-y-1">@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul>
            </div>
            @endif

            <form action="{{ route('admin.gallery.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                {{-- Title --}}
                <div class="mb-5">
                    <label for="title" class="block text-sm font-semibold text-on-surface mb-2">Judul <span class="text-pit-danger">*</span></label>
                    <input type="text" id="title" name="title"
                           class="w-full px-4 py-3 border border-outline-v/50 rounded-lg text-sm text-on-surface bg-white focus:border-pit-brown focus:ring-2 focus:ring-pit-brown/20 outline-none transition-all"
                           value="{{ old('title') }}" required>
                </div>

                {{-- Description --}}
                <div class="mb-5">
                    <label for="description" class="block text-sm font-semibold text-on-surface mb-2">Deskripsi</label>
                    <textarea id="description" name="description" rows="3"
                              class="w-full px-4 py-3 border border-outline-v/50 rounded-lg text-sm text-on-surface bg-white focus:border-pit-brown focus:ring-2 focus:ring-pit-brown/20 outline-none transition-all resize-none">{{ old('description') }}</textarea>
                </div>

                {{-- Image Upload --}}
                <div class="mb-5">
                    <label class="block text-sm font-semibold text-on-surface mb-2">Gambar <span class="text-pit-danger">*</span></label>
                    <div class="border-2 border-dashed border-outline-v/50 rounded-xl p-8 text-center cursor-pointer hover:border-pit-brown transition-all bg-surface/50"
                         onclick="document.getElementById('image').click()">
                        <input type="file" id="image" name="image" accept="image/*" class="hidden" onchange="previewImage(event)" required>
                        <span class="material-symbols-outlined text-4xl text-on-surface-muted block mb-2">cloud_upload</span>
                        <p class="text-on-surface-v text-sm">Klik atau seret gambar di sini</p>
                        <p class="text-xs text-on-surface-muted mt-2">JPG, PNG, GIF (Max 5MB)</p>
                        <img id="preview" src="" alt="Preview" class="mt-4 max-h-48 mx-auto hidden rounded-lg">
                    </div>
                </div>

                {{-- Sort Order --}}
                <div class="mb-5">
                    <label for="sort_order" class="block text-sm font-semibold text-on-surface mb-2">Urutan</label>
                    <input type="number" id="sort_order" name="sort_order"
                           class="w-full px-4 py-3 border border-outline-v/50 rounded-lg text-sm text-on-surface bg-white focus:border-pit-brown focus:ring-2 focus:ring-pit-brown/20 outline-none transition-all"
                           value="{{ old('sort_order', 1) }}" min="1">
                </div>

                {{-- Active --}}
                <div class="mb-6">
                    <label class="flex items-center gap-3 cursor-pointer px-4 py-3 border border-outline-v/30 rounded-lg bg-surface/50 hover:bg-surface-hover transition-colors">
                        <input type="checkbox" name="is_active" value="1" {{ old('is_active', true) ? 'checked' : '' }}
                               class="w-4 h-4 rounded accent-pit-brown">
                        <span class="text-sm font-semibold text-on-surface">Aktifkan galeri ini</span>
                    </label>
                </div>

                {{-- Actions --}}
                <div class="flex gap-3 pt-2">
                    <a href="{{ route('admin.gallery.index') }}"
                       class="flex-1 py-3 text-center text-sm font-semibold text-on-surface-v border border-outline-v/50 rounded-lg hover:bg-surface-hover transition-colors">
                        Batal
                    </a>
                    <button type="submit"
                            class="flex-1 py-3 text-center text-sm font-semibold text-white bg-pit-primary hover:bg-pit-primary/90 rounded-lg transition-all flex items-center justify-center gap-2 shadow-sm">
                        <span class="material-symbols-outlined text-[18px]">save</span> Simpan Galeri
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
function previewImage(event) {
    const file = event.target.files[0];
    const preview = document.getElementById('preview');
    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            preview.src = e.target.result;
            preview.classList.remove('hidden');
        }
        reader.readAsDataURL(file);
    }
}
</script>
@endsection
