@extends('admin.layouts.app')
@section('title', 'Kelola Transaksi')
@section('page-title', 'Kelola Transaksi')

@section('content')

{{-- Stats Cards --}}
<div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-8">

    {{-- Total Transaksi --}}
    <div class="bg-surface-card rounded-xl p-5 border border-outline-v/30 shadow-[0_4px_20px_rgba(75,54,33,0.04)] relative overflow-hidden">
        <div class="flex items-center gap-3 mb-3">
            <div class="bg-pri-fixed text-pri-on-fixed p-2 rounded-lg">
                <span class="material-symbols-outlined text-lg">receipt_long</span>
            </div>
        </div>
        <div class="text-3xl font-bold text-on-surface font-heading">{{ $stats['total'] }}</div>
        <p class="text-xs text-on-surface-muted mt-1">Total Transaksi</p>
    </div>

    {{-- Lunas --}}
    <div class="bg-surface-card rounded-xl p-5 border border-outline-v/30 shadow-[0_4px_20px_rgba(75,54,33,0.04)] relative overflow-hidden">
        <div class="flex items-center gap-3 mb-3">
            <div class="bg-green-100 text-green-700 p-2 rounded-lg">
                <span class="material-symbols-outlined text-lg">check_circle</span>
            </div>
        </div>
        <div class="text-3xl font-bold text-green-700 font-heading">{{ $stats['paid'] }}</div>
        <p class="text-xs text-on-surface-muted mt-1">Lunas</p>
    </div>

    {{-- Pending --}}
    <div class="bg-surface-card rounded-xl p-5 border border-outline-v/30 shadow-[0_4px_20px_rgba(75,54,33,0.04)] relative overflow-hidden">
        <div class="flex items-center gap-3 mb-3">
            <div class="bg-yellow-100 text-yellow-700 p-2 rounded-lg">
                <span class="material-symbols-outlined text-lg">hourglass_top</span>
            </div>
        </div>
        <div class="text-3xl font-bold text-yellow-700 font-heading">{{ $stats['pending'] }}</div>
        <p class="text-xs text-on-surface-muted mt-1">Menunggu</p>
    </div>

    {{-- Revenue --}}
    <div class="bg-surface-card rounded-xl p-5 border border-outline-v/30 shadow-[0_4px_20px_rgba(75,54,33,0.04)] relative overflow-hidden">
        <div class="flex items-center gap-3 mb-3">
            <div class="bg-sec-container text-sec-on p-2 rounded-lg">
                <span class="material-symbols-outlined text-lg">payments</span>
            </div>
        </div>
        <div class="text-lg font-bold text-on-surface font-heading">Rp {{ number_format($stats['revenue'], 0, ',', '.') }}</div>
        <p class="text-xs text-on-surface-muted mt-1">Total Pendapatan</p>
    </div>

</div>

{{-- Filter & Table --}}
<div class="card">
    <div class="card-header">
        <h3>Daftar Transaksi Pembayaran</h3>
        <div class="filter-bar" style="gap: 8px; display: flex; align-items: center; flex-wrap: wrap;">
            <form method="GET" style="display:flex; gap:8px; align-items:center; flex-wrap:wrap;">
                <input type="text" name="search" value="{{ request('search') }}"
                    placeholder="Cari nama / order ID..."
                    style="padding:7px 12px; border:1.5px solid #e8e0d5; border-radius:8px; font-size:13px; color:#1a1109; background:white; min-width:180px;">
                <select name="payment_status" onchange="this.form.submit()"
                    style="padding:7px 12px; border:1.5px solid #e8e0d5; border-radius:8px; font-size:13px; color:#1a1109; background:white;">
                    <option value="">Semua Status</option>
                    <option value="unpaid"  {{ request('payment_status') === 'unpaid'  ? 'selected' : '' }}>Belum Bayar</option>
                    <option value="pending" {{ request('payment_status') === 'pending' ? 'selected' : '' }}>Menunggu</option>
                    <option value="paid"    {{ request('payment_status') === 'paid'    ? 'selected' : '' }}>Lunas</option>
                    <option value="failed"  {{ request('payment_status') === 'failed'  ? 'selected' : '' }}>Gagal</option>
                    <option value="expired" {{ request('payment_status') === 'expired' ? 'selected' : '' }}>Kedaluwarsa</option>
                </select>
                <button type="submit" style="padding:7px 14px; background:#c17d2e; color:white; border:none; border-radius:8px; font-size:13px; cursor:pointer; font-weight:600;">
                    Cari
                </button>
                @if(request('search') || request('payment_status'))
                <a href="{{ route('admin.transaksi.index') }}"
                   style="padding:7px 12px; color:#c17d2e; font-size:13px; font-weight:600; text-decoration:none;">Reset</a>
                @endif
            </form>
        </div>
    </div>
    <div class="card-body" style="padding:0;">
        <div style="overflow-x: auto; -webkit-overflow-scrolling: touch;">
            <table style="width: 100%; border-collapse: collapse; min-width: 1000px;">
                <thead style="background: #fdfaf6; border-bottom: 2px solid #e8e0d5;">
                    <tr>
                        <th style="padding: 12px 16px; text-align: left; font-size: 13px; color: #5a4a3a;">Order ID</th>
                        <th style="padding: 12px 16px; text-align: left; font-size: 13px; color: #5a4a3a;">Pelanggan</th>
                        <th style="padding: 12px 16px; text-align: left; font-size: 13px; color: #5a4a3a;">Waktu Ambil/Makan</th>
                        <th style="padding: 12px 16px; text-align: left; font-size: 13px; color: #5a4a3a;">Pesanan Menu</th>
                        <th style="padding: 12px 16px; text-align: left; font-size: 13px; color: #5a4a3a;">Total</th>
                        <th style="padding: 12px 16px; text-align: center; font-size: 13px; color: #5a4a3a;">Status & Metode</th>
                        <th style="padding: 12px 16px; text-align: left; font-size: 13px; color: #5a4a3a;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($transactions as $t)
                    <tr style="border-bottom: 1px solid #f0eae1;">
                        <td style="padding: 16px; vertical-align: top;">
                            <div style="font-size: 12px; font-family: monospace; font-weight: 600; color: #c17d2e; background: #fdfaf6; padding: 4px 8px; border-radius: 4px; display: inline-block;">
                                {{ $t->order_id ?? 'OLD-'.$t->id }}
                            </div>
                            <div style="font-size: 11px; color: #9c8c7a; margin-top: 4px;">
                                {{ $t->created_at->format('d M Y, H:i') }}
                            </div>
                        </td>
                        <td style="padding: 16px; vertical-align: top;">
                            <div style="font-weight:700; color:#1a1109; font-size: 14px;">{{ $t->name }}</div>
                            <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $t->phone) }}" target="_blank"
                               style="color:#c17d2e; text-decoration:none; font-weight:500; font-size: 12px; display: flex; align-items: center; gap: 4px; margin-top: 4px;">
                                <i class="fab fa-whatsapp"></i> {{ $t->phone }}
                            </a>
                            @if($t->notes)
                            <div style="font-size:11px; color:#9c8c7a; margin-top:6px; background: #f9f9f9; padding: 6px; border-radius: 4px; border-left: 2px solid #e8e0d5;">
                                "{{ Str::limit($t->notes, 40) }}"
                            </div>
                            @endif
                        </td>
                        <td style="padding: 16px; vertical-align: top;">
                            <div style="font-weight: 600; color: #1a1109; font-size: 13px;">{{ $t->date->format('d M Y') }}</div>
                            <div style="font-size:12px; color:#c17d2e; font-weight: 600;">Pukul {{ $t->time }}</div>
                        </td>
                        <td style="padding: 16px; vertical-align: top;">
                            @if(!empty($t->cart_items))
                                <ul style="margin: 0; padding-left: 16px; font-size: 12px; color: #5a4a3a;">
                                    @foreach($t->cart_items as $item)
                                        <li style="margin-bottom: 2px;">
                                            {{ $item['quantity'] ?? 1 }}x <strong>{{ $item['title'] ?? 'Menu' }}</strong>
                                        </li>
                                    @endforeach
                                </ul>
                            @else
                                <span style="font-size: 12px; color: #9c8c7a; font-style: italic;">Hanya Reservasi Tempat</span>
                            @endif
                        </td>
                        <td style="padding: 16px; vertical-align: top; font-weight:700; color:#1a1109;">
                            {{ $t->total_price > 0 ? 'Rp '.number_format($t->total_price, 0, ',', '.') : '-' }}
                        </td>
                        <td style="padding: 16px; vertical-align: top; text-align: center;">
                            @php
                                $ps = $t->payment_status ?? 'unpaid';
                                $psColor = match($ps) {
                                    'paid'    => 'background:#dcfce7; color:#16a34a; border: 1px solid #bbf7d0;',
                                    'pending' => 'background:#fef9c3; color:#ca8a04; border: 1px solid #fef08a;',
                                    'failed'  => 'background:#fee2e2; color:#dc2626; border: 1px solid #fecaca;',
                                    'expired' => 'background:#f3f4f6; color:#6b7280; border: 1px solid #e5e7eb;',
                                    default   => 'background:#f3f4f6; color:#6b7280; border: 1px solid #e5e7eb;',
                                };
                                $psLabel = $t->paymentStatusLabel();
                            @endphp
                            <span style="display:inline-block; padding:4px 12px; border-radius:20px; font-size:11px; font-weight:700; {{ $psColor }} margin-bottom: 4px;">
                                {{ $psLabel }}
                            </span>
                            @if($t->payment_type)
                            <div style="font-size:10px; font-weight: 600; color:#9c8c7a; text-transform:uppercase;">
                                VIA: {{ str_replace('_', ' ', $t->payment_type) }}
                            </div>
                            @endif
                        </td>
                        <td style="padding: 16px; vertical-align: top; text-align: right;">
                            <div style="display:flex; flex-direction: column; gap:8px; align-items: flex-end;">
                                {{-- Update Status --}}
                                @if($t->payment_status === 'paid')
                                <form method="POST" action="{{ route('admin.reservasi.updateStatus', $t) }}">
                                    @csrf @method('PATCH')
                                    <select name="status" onchange="this.form.submit()"
                                        style="padding:6px 10px; border:1.5px solid #e8e0d5; border-radius:6px; font-size:12px; font-weight:600; color:#1a1109; background:#fdfaf6; cursor:pointer;">
                                        <option value="pending"   {{ $t->status=='pending'   ? 'selected':'' }}>⏳ Pending</option>
                                        <option value="confirmed" {{ $t->status=='confirmed' ? 'selected':'' }}>✅ Confirmed</option>
                                        <option value="cancelled" {{ $t->status=='cancelled' ? 'selected':'' }}>❌ Cancelled</option>
                                    </select>
                                </form>
                                @endif
                                {{-- Delete --}}
                                <form method="POST" action="{{ route('admin.reservasi.destroy', $t) }}"
                                      class="swal-confirm" data-swal-title="Hapus Transaksi?" data-swal-text="Transaksi atas nama {{ $t->name }} akan dihapus permanen.">
                                    @csrf @method('DELETE')
                                    <button type="submit" style="background: none; border: none; color: #ef4444; cursor: pointer; display: flex; align-items: center; gap: 4px; font-size: 12px; font-weight: 600; padding: 4px 8px; border-radius: 4px; transition: background 0.2s;" onmouseover="this.style.background='#fee2e2'" onmouseout="this.style.background='none'">
                                        <span class="material-symbols-outlined" style="font-size:16px;">delete</span> Hapus
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" style="text-align:center; padding:60px 20px; color:#9c8c7a;">
                            <span class="material-symbols-outlined" style="font-size: 48px; opacity: 0.5; margin-bottom: 12px;">receipt_long</span>
                            <br>Belum ada data transaksi.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="pagination-wrapper" style="padding: 16px;">{{ $transactions->links() }}</div>
    </div>
</div>

@endsection
