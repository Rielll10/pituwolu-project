@extends('admin.layouts.app')
@section('title', 'Kelola Ulasan')
@section('page-title', 'Kelola Ulasan Pelanggan')

@section('content')

<div class="bg-surface-card rounded-xl border border-outline-v/30 shadow-[0_4px_20px_rgba(75,54,33,0.04)] overflow-hidden">
    <div class="p-6 border-b border-surface-dim/50 flex justify-between items-center">
        <h2 class="font-heading font-semibold text-xl text-on-surface">Daftar Ulasan</h2>
        <form method="GET">
            <select name="status" onchange="this.form.submit()"
                    class="px-3 py-2 border border-outline-v/50 rounded-lg text-xs text-on-surface bg-white focus:border-pit-brown outline-none transition-all">
                <option value="">Semua Status</option>
                <option value="pending"  {{ request('status') == 'pending'  ? 'selected' : '' }}>Pending</option>
                <option value="approved" {{ request('status') == 'approved' ? 'selected' : '' }}>Approved</option>
                <option value="rejected" {{ request('status') == 'rejected' ? 'selected' : '' }}>Rejected</option>
            </select>
        </form>
    </div>
    <div class="overflow-x-auto">
        <table class="w-full text-sm">
            <thead>
                <tr class="border-b-2 border-surface-dim/50">
                    <th class="px-6 py-3 text-left text-[11px] font-semibold uppercase tracking-wider text-on-surface-muted">#</th>
                    <th class="px-6 py-3 text-left text-[11px] font-semibold uppercase tracking-wider text-on-surface-muted">Nama</th>
                    <th class="px-6 py-3 text-left text-[11px] font-semibold uppercase tracking-wider text-on-surface-muted">Rating</th>
                    <th class="px-6 py-3 text-left text-[11px] font-semibold uppercase tracking-wider text-on-surface-muted">Ulasan</th>
                    <th class="px-6 py-3 text-left text-[11px] font-semibold uppercase tracking-wider text-on-surface-muted">Tanggal</th>
                    <th class="px-6 py-3 text-left text-[11px] font-semibold uppercase tracking-wider text-on-surface-muted">Status</th>
                    <th class="px-6 py-3 text-left text-[11px] font-semibold uppercase tracking-wider text-on-surface-muted">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-surface-dim/30">
                @forelse($reviews as $rv)
                <tr class="hover:bg-surface/50 transition-colors">
                    <td class="px-6 py-4 text-xs text-on-surface-muted">{{ $rv->id }}</td>
                    <td class="px-6 py-4">
                        <div class="flex items-center gap-3">
                            <div class="w-9 h-9 rounded-full bg-tert-container text-tert-on flex items-center justify-center shrink-0 font-heading font-semibold text-sm">
                                {{ strtoupper(substr($rv->nama_pengulas, 0, 1)) }}
                            </div>
                            <span class="font-semibold text-on-surface">{{ $rv->nama_pengulas }}</span>
                        </div>
                    </td>
                    <td class="px-6 py-4">
                        @if($rv->rating)
                        <div class="flex text-sec-on">
                            @for($i = 1; $i <= 5; $i++)
                                <span class="material-symbols-outlined {{ $i <= $rv->rating ? 'fill' : '' }}" style="font-size:16px;">star</span>
                            @endfor
                        </div>
                        @else
                        <span class="text-xs text-on-surface-muted">-</span>
                        @endif
                    </td>
                    <td class="px-6 py-4 max-w-[300px]">
                        <span class="text-sm text-on-surface-v cursor-pointer hover:underline hover:text-pit-brown transition-colors"
                              title="Klik untuk lihat ulasan lengkap"
                              onclick="showFullReview(this)" data-ulasan="{{ $rv->ulasan }}">
                            {{ Str::limit($rv->ulasan, 80) }}
                        </span>
                    </td>
                    <td class="px-6 py-4">
                        <span class="text-xs text-on-surface-muted whitespace-nowrap">{{ $rv->created_at->format('d M Y') }}</span>
                    </td>
                    <td class="px-6 py-4">
                        <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-semibold
                            {{ $rv->status === 'approved' ? 'bg-pit-success-bg text-pit-success' : ($rv->status === 'rejected' ? 'bg-pit-danger-bg text-pit-danger' : 'bg-pit-warning-bg text-pit-warning') }}">
                            {{ ucfirst($rv->status) }}
                        </span>
                    </td>
                    <td class="px-6 py-4">
                        <div class="flex gap-2 items-center">
                            <form method="POST" action="{{ route('admin.review.updateStatus', $rv) }}">
                                @csrf @method('PATCH')
                                <select name="status" onchange="this.form.submit()"
                                        class="px-2 py-1.5 border border-outline-v/50 rounded-lg text-xs text-on-surface bg-white focus:border-pit-brown outline-none transition-all cursor-pointer">
                                    <option value="pending"  {{ $rv->status=='pending'  ? 'selected':'' }}>Pending</option>
                                    <option value="approved" {{ $rv->status=='approved' ? 'selected':'' }}>Approved</option>
                                    <option value="rejected" {{ $rv->status=='rejected' ? 'selected':'' }}>Rejected</option>
                                </select>
                            </form>
                            <form method="POST" action="{{ route('admin.review.destroy', $rv) }}"
                                  class="swal-confirm" data-swal-title="Hapus Ulasan?" data-swal-text="Ulasan dari {{ $rv->nama_pengulas }} akan dihapus permanen.">
                                @csrf @method('DELETE')
                                <button type="submit"
                                        class="px-2.5 py-1.5 text-xs font-semibold text-pit-danger bg-pit-danger-bg hover:bg-pit-danger-bg/80 rounded-lg transition-colors flex items-center gap-1">
                                    <span class="material-symbols-outlined text-[14px]">delete</span>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="px-6 py-12 text-center text-on-surface-muted">Belum ada ulasan.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="pagination-wrapper p-4 flex justify-center">{{ $reviews->links() }}</div>
</div>

@endsection

@push('scripts')
<script>
    function showFullReview(element) {
        const text = element.getAttribute('data-ulasan');
        Swal.fire({
            title: 'Ulasan Lengkap',
            text: text,
            icon: 'info',
            confirmButtonColor: '#4B3621',
            confirmButtonText: 'Tutup',
            customClass: {
                popup: 'rounded-2xl border border-outline-v/30',
                title: 'font-heading text-xl text-on-surface',
                confirmButton: 'font-semibold rounded-lg px-5 py-2.5',
            }
        });
    }
</script>
@endpush
