@extends('admin.layouts.app')
@section('title', 'Edit Galeri')
@section('page-title', 'Edit Galeri')

@section('content')

<div class="max-w-2xl">
    <a href="{{ route('admin.gallery.index') }}" class="text-pit-brown hover:text-pit-primary flex items-center gap-2 text-sm font-medium mb-6 transition-colors">
        <span class="material-symbols-outlined text-[18px]">arrow_back</span> Kembali
    </a>

    <div class="bg-surface-card rounded-xl border border-outline-v/30 shadow-[0_4px_20px_rgba(75,54,33,0.04)] overflow-hidden">
        <div class="p-6 border-b border-surface-dim/50">
            <h2 class="font-heading font-semibold text-xl text-on-surface">Edit: {{ $gallery->title }}</h2>
        </div>
        <div class="p-6">
            @if($errors->any())
            <div class="mb-5 px-4 py-3 rounded-xl bg-pit-danger-bg text-pit-danger text-sm border border-pit-danger/20">
                <ul class="list-none space-y-1">@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul>
            </div>
            @endif

            <form method="POST" action="{{ route('admin.gallery.update', $gallery) }}" enctype="multipart/form-data">
                @csrf @method('PUT')

                <div class="mb-5">
                    <label class="block text-sm font-semibold text-on-surface mb-2">Judul <span class="text-pit-danger">*</span></label>
                    <input type="text" name="title"
                           class="w-full px-4 py-3 border border-outline-v/50 rounded-lg text-sm text-on-surface bg-white focus:border-pit-brown focus:ring-2 focus:ring-pit-brown/20 outline-none transition-all"
                           value="{{ old('title', $gallery->title) }}" required>
                </div>

                <div class="mb-5">
                    <label class="block text-sm font-semibold text-on-surface mb-2">Deskripsi</label>
                    <textarea name="description" rows="3"
                              class="w-full px-4 py-3 border border-outline-v/50 rounded-lg text-sm text-on-surface bg-white focus:border-pit-brown focus:ring-2 focus:ring-pit-brown/20 outline-none transition-all resize-none">{{ old('description', $gallery->description) }}</textarea>
                </div>

                <div class="mb-5">
                    <label class="block text-sm font-semibold text-on-surface mb-2">Urutan <span class="text-pit-danger">*</span></label>
                    <input type="number" name="sort_order"
                           class="w-full px-4 py-3 border border-outline-v/50 rounded-lg text-sm text-on-surface bg-white focus:border-pit-brown focus:ring-2 focus:ring-pit-brown/20 outline-none transition-all"
                           value="{{ old('sort_order', $gallery->sort_order) }}" min="1" required>
                </div>

                <div class="mb-5">
                    <label class="block text-sm font-semibold text-on-surface mb-2">Gambar (biarkan kosong jika tidak diganti)</label>
                    @if($gallery->image)
                    <div class="mb-3 p-3 bg-surface/50 rounded-lg flex items-center gap-3 border border-outline-v/30">
                        @if(str_starts_with($gallery->image, 'http'))
                            <img src="{{ $gallery->image }}" alt="{{ $gallery->title }}" class="w-20 h-20 object-cover rounded-lg border border-outline-v/50">
                        @else
                            <img src="{{ Storage::url($gallery->image) }}" alt="{{ $gallery->title }}" class="w-20 h-20 object-cover rounded-lg border border-outline-v/50">
                        @endif
                        <div>
                            <div class="text-xs font-semibold text-on-surface">Gambar Saat Ini</div>
                            <div class="text-[11px] text-on-surface-muted">Upload baru untuk mengganti</div>
                        </div>
                    </div>
                    @endif
                    <input type="file" name="image" accept="image/*" id="image-input"
                           class="w-full px-4 py-3 border border-outline-v/50 rounded-lg text-sm text-on-surface bg-white focus:border-pit-brown outline-none transition-all">
                    <div id="image-preview" class="mt-3 hidden">
                        <img id="preview-img" src="" alt="Preview" class="w-20 h-20 object-cover rounded-lg border border-outline-v/50">
                    </div>
                </div>

                <div class="mb-6">
                    <label class="flex items-center gap-3 cursor-pointer px-4 py-3 border border-outline-v/30 rounded-lg bg-surface/50 hover:bg-surface-hover transition-colors">
                        <input type="checkbox" name="is_active" value="1" {{ $gallery->is_active ? 'checked' : '' }}
                               class="w-4 h-4 rounded accent-pit-brown">
                        <span class="text-sm font-semibold text-on-surface">Tampilkan Galeri (Aktif)</span>
                    </label>
                </div>

                <div class="flex gap-3 pt-2">
                    <a href="{{ route('admin.gallery.index') }}"
                       class="flex-1 py-3 text-center text-sm font-semibold text-on-surface-v border border-outline-v/50 rounded-lg hover:bg-surface-hover transition-colors">
                        Batal
                    </a>
                    <button type="submit"
                            class="flex-1 py-3 text-center text-sm font-semibold text-white bg-pit-primary hover:bg-pit-primary/90 rounded-lg transition-all flex items-center justify-center gap-2 shadow-sm">
                        <span class="material-symbols-outlined text-[18px]">save</span> Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@push('scripts')
<script>
    document.getElementById('image-input').addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = (ev) => {
                document.getElementById('preview-img').src = ev.target.result;
                document.getElementById('image-preview').classList.remove('hidden');
            };
            reader.readAsDataURL(file);
        }
    });
</script>
@endpush

@endsection
