@extends('layouts.app')

@section('title', 'Status Reservasi | Pituwolu')

@section('content')
<div class="min-h-screen bg-surface flex items-center justify-center px-4 py-16">
    <div class="max-w-md w-full text-center">

        @if($reservation->payment_status === 'paid')
        <!-- SUCCESS -->
        <div class="w-24 h-24 mx-auto mb-6 bg-green-100 rounded-full flex items-center justify-center shadow-lg shadow-green-200">
            <span class="material-symbols-outlined text-green-600 text-5xl">check_circle</span>
        </div>
        <h1 class="text-3xl font-bold font-headline text-on-surface mb-3">Pembayaran Berhasil!</h1>
        <p class="text-on-surface-variant mb-8">Reservasi Anda telah dikonfirmasi. Klik tombol di bawah untuk mengirim konfirmasi ke WhatsApp kami.</p>
        
        @elseif($reservation->payment_status === 'pending')
        <!-- PENDING -->
        <div class="w-24 h-24 mx-auto mb-6 bg-yellow-100 rounded-full flex items-center justify-center shadow-lg shadow-yellow-200">
            <span class="material-symbols-outlined text-yellow-600 text-5xl">hourglass_top</span>
        </div>
        <h1 class="text-3xl font-bold font-headline text-on-surface mb-3">Pembayaran Diproses</h1>
        <p class="text-on-surface-variant mb-8">Pembayaran Anda sedang diverifikasi. Konfirmasi akan dikirimkan setelah pembayaran diterima.</p>

        @else
        <!-- UNPAID / FAILED -->
        <div class="w-24 h-24 mx-auto mb-6 bg-red-100 rounded-full flex items-center justify-center shadow-lg shadow-red-200">
            <span class="material-symbols-outlined text-red-500 text-5xl">cancel</span>
        </div>
        <h1 class="text-3xl font-bold font-headline text-on-surface mb-3">Pembayaran Belum Selesai</h1>
        <p class="text-on-surface-variant mb-8">Transaksi Anda belum berhasil. Silakan coba lagi untuk menyelesaikan reservasi.</p>
        @endif

        <!-- Detail Reservasi -->
        <div class="bg-surface-container rounded-2xl p-6 text-left border border-surface-container-highest mb-8 space-y-3">
            <div class="flex justify-between items-center text-sm">
                <span class="text-on-surface-variant font-label">Order ID</span>
                <span class="font-bold text-on-surface font-mono text-xs">{{ $reservation->order_id }}</span>
            </div>
            <div class="flex justify-between items-center text-sm">
                <span class="text-on-surface-variant font-label">Nama</span>
                <span class="font-semibold text-on-surface">{{ $reservation->name }}</span>
            </div>
            <div class="flex justify-between items-center text-sm">
                <span class="text-on-surface-variant font-label">Tanggal</span>
                <span class="font-semibold text-on-surface">{{ $reservation->date->format('d M Y') }}</span>
            </div>
            <div class="flex justify-between items-center text-sm">
                <span class="text-on-surface-variant font-label">Waktu</span>
                <span class="font-semibold text-on-surface">{{ $reservation->time }}</span>
            </div>
            <div class="flex justify-between items-center text-sm">
                <span class="text-on-surface-variant font-label">Kapasitas</span>
                <span class="font-semibold text-on-surface">{{ $reservation->pax }}</span>
            </div>
            <div class="border-t border-surface-container-highest pt-3 flex justify-between items-center">
                <span class="text-on-surface-variant font-label text-sm">Total</span>
                <span class="text-primary font-bold text-lg">Rp {{ number_format($reservation->total_price, 0, ',', '.') }}</span>
            </div>
            <div class="flex justify-between items-center text-sm">
                <span class="text-on-surface-variant font-label">Status Bayar</span>
                <span class="px-3 py-1 rounded-full text-xs font-bold
                    @if($reservation->payment_status === 'paid') bg-green-100 text-green-700
                    @elseif($reservation->payment_status === 'pending') bg-yellow-100 text-yellow-700
                    @else bg-red-100 text-red-600 @endif">
                    {{ $reservation->paymentStatusLabel() }}
                </span>
            </div>
        </div>

        <!-- Actions -->
        <div class="flex flex-col gap-3">
            @if($reservation->payment_status === 'paid')
            <a href="{{ $waLink ?? '#' }}" 
               class="w-full py-4 bg-green-500 text-white font-bold font-label text-sm tracking-wider rounded-full flex items-center justify-center gap-2 hover:bg-green-600 transition shadow-lg shadow-green-200">
                <i class="fab fa-whatsapp text-xl"></i>
                KIRIM KONFIRMASI VIA WHATSAPP
            </a>
            @endif
            <a href="/reservasi"
               class="w-full py-3 border border-outline text-on-surface font-semibold font-label text-sm rounded-full flex items-center justify-center gap-2 hover:bg-surface-container transition">
                <span class="material-symbols-outlined text-base">arrow_back</span>
                Kembali ke Halaman Reservasi
            </a>
        </div>
    </div>
</div>
@endsection
