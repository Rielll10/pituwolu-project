@extends('admin.layouts.app')
@section('title', 'Kelola Reservasi')
@section('page-title', 'Kelola Reservasi')

@section('content')

<div class="card">
    <div class="card-header">
        <h3>Daftar Reservasi</h3>
        <div class="filter-bar">
            <form method="GET">
                <select name="status" onchange="this.form.submit()">
                    <option value="">Semua Status</option>
                    <option value="pending"   {{ request('status') == 'pending'    ? 'selected' : '' }}>Pending</option>
                    <option value="confirmed" {{ request('status') == 'confirmed'  ? 'selected' : '' }}>Confirmed</option>
                    <option value="cancelled" {{ request('status') == 'cancelled'  ? 'selected' : '' }}>Cancelled</option>
                </select>
            </form>
        </div>
    </div>
    <div class="card-body" style="padding:0;">
        <div class="table-wrapper">
            <table>
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nama</th>
                        <th>No. WhatsApp</th>
                        <th>Tanggal & Waktu</th>
                        <th>Kapasitas</th>
                        <th>Total</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($reservations as $r)
                    <tr>
                        <td style="color:#9c8c7a; font-size:12px;">{{ $r->id }}</td>
                        <td>
                            <div style="font-weight:600;">{{ $r->name }}</div>
                            @if($r->notes)
                            <div style="font-size:11px; color:#9c8c7a; margin-top:2px;">{{ Str::limit($r->notes, 40) }}</div>
                            @endif
                        </td>
                        <td>
                            <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $r->phone) }}" target="_blank"
                               style="color:#c17d2e; text-decoration:none; font-weight:500;">
                                {{ $r->phone }}
                            </a>
                        </td>
                        <td>
                            <div>{{ $r->date->format('d M Y') }}</div>
                            <div style="font-size:12px; color:#9c8c7a;">{{ $r->time }}</div>
                        </td>
                        <td>{{ $r->pax }}</td>
                        <td style="font-weight:600;">
                            {{ $r->total_price > 0 ? 'Rp '.number_format($r->total_price, 0, ',', '.') : '-' }}
                        </td>
                        <td><span class="badge badge-{{ $r->status }}">{{ ucfirst($r->status) }}</span></td>
                        <td>
                            <div style="display:flex; gap:6px; align-items:center;">
                                {{-- Update Status --}}
                                <form method="POST" action="{{ route('admin.reservasi.updateStatus', $r) }}">
                                    @csrf @method('PATCH')
                                    <select name="status" onchange="this.form.submit()"
                                        style="padding:5px 8px; border:1.5px solid #e8e0d5; border-radius:6px; font-size:12px; color:#1a1109; background:white; cursor:pointer;">
                                        <option value="pending"   {{ $r->status=='pending'   ? 'selected':'' }}>Pending</option>
                                        <option value="confirmed" {{ $r->status=='confirmed' ? 'selected':'' }}>Confirmed</option>
                                        <option value="cancelled" {{ $r->status=='cancelled' ? 'selected':'' }}>Cancelled</option>
                                    </select>
                                </form>
                                {{-- Delete --}}
                                <form method="POST" action="{{ route('admin.reservasi.destroy', $r) }}"
                                      class="swal-confirm" data-swal-title="Hapus Reservasi?" data-swal-text="Reservasi atas nama {{ $r->name }} akan dihapus permanen.">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">
                                        <span class="material-symbols-outlined" style="font-size:14px;">delete</span>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8" style="text-align:center; padding:40px; color:#9c8c7a;">Belum ada data reservasi.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="pagination-wrapper">{{ $reservations->links() }}</div>
    </div>
</div>

@endsection
