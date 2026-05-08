@extends('admin.layouts.app')
@section('title', 'Kelola Reservasi')
@section('page-title', 'Kelola Reservasi')

@section('content')

<div class="card">
    <div class="card-header">
        <h3>Daftar Reservasi</h3>
        <div class="filter-bar" style="gap: 8px; display: flex; align-items: center; flex-wrap: wrap;">
            <form method="GET" style="display:flex; gap:8px; align-items:center; flex-wrap:wrap; width: 100%;">
                <input type="text" name="search" value="{{ request('search') }}"
                    placeholder="Cari nama / order ID..."
                    style="padding:7px 12px; border:1.5px solid #e8e0d5; border-radius:8px; font-size:13px; color:#1a1109; background:white; flex-grow: 1; min-width: 180px;">
                <select name="status" onchange="this.form.submit()"
                    style="padding:7px 12px; border:1.5px solid #e8e0d5; border-radius:8px; font-size:13px; color:#1a1109; background:white;">
                    <option value="">Semua Status</option>
                    <option value="pending"   {{ request('status') == 'pending'    ? 'selected' : '' }}>Pending</option>
                    <option value="confirmed" {{ request('status') == 'confirmed'  ? 'selected' : '' }}>Confirmed</option>
                    <option value="cancelled" {{ request('status') == 'cancelled'  ? 'selected' : '' }}>Cancelled</option>
                </select>
                <button type="submit" style="padding:7px 14px; background:#c17d2e; color:white; border:none; border-radius:8px; font-size:13px; cursor:pointer; font-weight:600;">
                    Cari
                </button>
                @if(request('search') || request('status'))
                <a href="{{ route('admin.reservasi.index') }}"
                   style="padding:7px 12px; color:#c17d2e; font-size:13px; font-weight:600; text-decoration:none;">Reset</a>
                @endif
            </form>
        </div>
    </div>
    
    <div class="card-body" style="padding:0;">
        <div style="overflow-x: auto; -webkit-overflow-scrolling: touch;">
            <table style="width: 100%; border-collapse: collapse; min-width: 900px;">
                <thead style="background: #fdfaf6; border-bottom: 2px solid #e8e0d5;">
                    <tr>
                        <th style="padding: 12px 16px; text-align: left; font-size: 13px; color: #5a4a3a;">Order ID</th>
                        <th style="padding: 12px 16px; text-align: left; font-size: 13px; color: #5a4a3a;">Pelanggan</th>
                        <th style="padding: 12px 16px; text-align: left; font-size: 13px; color: #5a4a3a;">Waktu & Pax</th>
                        <th style="padding: 12px 16px; text-align: left; font-size: 13px; color: #5a4a3a;">Pesanan Menu</th>
                        <th style="padding: 12px 16px; text-align: left; font-size: 13px; color: #5a4a3a;">Status Reservasi</th>
                        <th style="padding: 12px 16px; text-align: right; font-size: 13px; color: #5a4a3a;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($reservations as $r)
                    <tr style="border-bottom: 1px solid #f0eae1;">
                        <td style="padding: 16px; vertical-align: top;">
                            <div style="font-size: 12px; font-family: monospace; font-weight: 600; color: #c17d2e; background: #fdfaf6; padding: 4px 8px; border-radius: 4px; display: inline-block;">
                                {{ $r->order_id ?? 'OLD-'.$r->id }}
                            </div>
                        </td>
                        <td style="padding: 16px; vertical-align: top;">
                            <div style="font-weight:700; color:#1a1109; font-size: 14px;">{{ $r->name }}</div>
                            <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $r->phone) }}" target="_blank"
                               style="color:#c17d2e; text-decoration:none; font-weight:500; font-size: 12px; display: flex; align-items: center; gap: 4px; margin-top: 4px;">
                                <i class="fab fa-whatsapp"></i> {{ $r->phone }}
                            </a>
                            @if($r->notes)
                            <div style="font-size:11px; color:#9c8c7a; margin-top:6px; background: #f9f9f9; padding: 6px; border-radius: 4px; border-left: 2px solid #e8e0d5;">
                                "{{ Str::limit($r->notes, 40) }}"
                            </div>
                            @endif
                        </td>
                        <td style="padding: 16px; vertical-align: top;">
                            <div style="font-weight: 600; color: #1a1109; font-size: 13px;">{{ $r->date->format('d M Y') }}</div>
                            <div style="font-size:12px; color:#c17d2e; font-weight: 600;">Pukul {{ $r->time }}</div>
                            <div style="font-size:12px; color:#9c8c7a; margin-top: 4px; display: flex; align-items: center; gap: 4px;">
                                <span class="material-symbols-outlined" style="font-size: 14px;">group</span> {{ $r->pax }}
                            </div>
                        </td>
                        <td style="padding: 16px; vertical-align: top;">
                            @if(!empty($r->cart_items))
                                <ul style="margin: 0; padding-left: 16px; font-size: 12px; color: #5a4a3a;">
                                    @foreach($r->cart_items as $item)
                                        <li style="margin-bottom: 2px;">
                                            {{ $item['quantity'] ?? 1 }}x <strong>{{ $item['title'] ?? 'Menu' }}</strong>
                                        </li>
                                    @endforeach
                                </ul>
                                <div style="margin-top: 6px; font-size: 12px; font-weight: 700; color: #1a1109;">
                                    Total: Rp {{ number_format($r->total_price, 0, ',', '.') }}
                                </div>
                            @else
                                <span style="font-size: 12px; color: #9c8c7a; font-style: italic;">Hanya Reservasi Tempat</span>
                            @endif
                        </td>
                        <td style="padding: 16px; vertical-align: top;">
                            <span class="badge badge-{{ $r->status }}" style="margin-bottom: 8px; display: inline-block;">{{ ucfirst($r->status) }}</span>
                            <div style="font-size: 11px; color: #9c8c7a;">
                                Bayar: 
                                @if($r->payment_status === 'paid')
                                    <strong style="color: #16a34a;">Lunas</strong>
                                @else
                                    <strong style="color: #ca8a04;">Belum</strong>
                                @endif
                            </div>
                        </td>
                        <td style="padding: 16px; vertical-align: top; text-align: right;">
                            <div style="display:flex; flex-direction: column; gap:8px; align-items: flex-end;">
                                {{-- Update Status --}}
                                <form method="POST" action="{{ route('admin.reservasi.updateStatus', $r) }}">
                                    @csrf @method('PATCH')
                                    <select name="status" onchange="this.form.submit()"
                                        style="padding:6px 10px; border:1.5px solid #e8e0d5; border-radius:6px; font-size:12px; font-weight:600; color:#1a1109; background:#fdfaf6; cursor:pointer;">
                                        <option value="pending"   {{ $r->status=='pending'   ? 'selected':'' }}>⏳ Pending</option>
                                        <option value="confirmed" {{ $r->status=='confirmed' ? 'selected':'' }}>✅ Confirmed</option>
                                        <option value="cancelled" {{ $r->status=='cancelled' ? 'selected':'' }}>❌ Cancelled</option>
                                    </select>
                                </form>
                                {{-- Delete --}}
                                <form method="POST" action="{{ route('admin.reservasi.destroy', $r) }}"
                                      class="swal-confirm" data-swal-title="Hapus Reservasi?" data-swal-text="Reservasi atas nama {{ $r->name }} akan dihapus permanen.">
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
                        <td colspan="6" style="text-align:center; padding:60px 20px; color:#9c8c7a;">
                            <span class="material-symbols-outlined" style="font-size: 48px; opacity: 0.5; margin-bottom: 12px;">event_busy</span>
                            <br>Belum ada data reservasi.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="pagination-wrapper" style="padding: 16px;">{{ $reservations->links() }}</div>
    </div>
</div>

@endsection
