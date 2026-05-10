<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Admin') — Pituwolu Coffee</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;500;600;700;800&family=Work+Sans:wght@400;500;600&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        "surface": "#fff8f5",
                        "surface-card": "#ffffff",
                        "surface-hover": "#f6ece8",
                        "surface-dim": "#e1d8d4",
                        "outline-v": "#d2c4ba",
                        "on-surface": "#1f1b19",
                        "on-surface-v": "#4e453d",
                        "on-surface-muted": "#80756c",
                        "sidebar-bg": "#4B3621",
                        "sidebar-border": "#3E2B1B",
                        "sidebar-hover": "rgba(245,245,240,0.05)",
                        "sidebar-active": "rgba(245,245,240,0.10)",
                        "sidebar-text": "rgba(245,245,240,0.60)",
                        "sidebar-accent": "#D2B48C",
                        "topbar-bg": "#F5F5F0",
                        "topbar-border": "#E5E5E0",
                        "pit-primary": "#4B3621",
                        "pit-accent": "#8A9A5B",
                        "pit-brown": "#c17d2e",
                        "pit-brown-light": "#e8a84a",
                        "pit-success": "#2d7a4f",
                        "pit-success-bg": "#e8f5ee",
                        "pit-warning": "#b45309",
                        "pit-warning-bg": "#fef3c7",
                        "pit-danger": "#c53030",
                        "pit-danger-bg": "#fee2e2",
                        "pit-info": "#1d4ed8",
                        "pit-info-bg": "#dbeafe",
                        "sec-container": "#cce3cf",
                        "sec-on": "#374b3d",
                        "tert-container": "#54330c",
                        "tert-on": "#cb9b6c",
                        "pri-fixed": "#fedcbe",
                        "pri-on-fixed": "#291806",
                        "err-container": "#ffdad6",
                    },
                    fontFamily: {
                        "heading": ["Manrope", "sans-serif"],
                        "body": ["Work Sans", "sans-serif"],
                    },
                }
            }
        }
    </script>
    <style>
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
        }
        .material-symbols-outlined.fill {
            font-variation-settings: 'FILL' 1, 'wght' 400, 'GRAD' 0, 'opsz' 24;
        }
        body { font-family: 'Work Sans', sans-serif; }

        /* Scrollbar for sidebar */
        .sidebar-nav::-webkit-scrollbar { width: 4px; }
        .sidebar-nav::-webkit-scrollbar-thumb { background: rgba(255,255,255,0.15); border-radius: 4px; }

        /* Pagination */
        .pagination-wrapper nav { width: 100%; }
        .pagination-wrapper nav > div:first-child { display: none; } /* Hide default mobile next/prev */
        .pagination-wrapper nav > div:last-child { display: flex; flex-direction: column; align-items: center; gap: 12px; width: 100%; }
        .pagination-wrapper p.text-sm { color: #80756c; font-size: 13px; }
        .pagination-wrapper p.text-sm span { font-weight: 700; color: #4B3621; }
        .pagination-wrapper .relative.z-0.inline-flex { box-shadow: none; display: flex; gap: 6px; }
        .pagination-wrapper .relative.z-0.inline-flex > span,
        .pagination-wrapper .relative.z-0.inline-flex > a {
            display: inline-flex; align-items: center; justify-content: center;
            min-width: 36px; height: 36px; padding: 0 10px; font-size: 13px; font-weight: 600; font-family: 'Work Sans', sans-serif;
            border-radius: 8px !important; border: 1px solid #d2c4ba; color: #4e453d;
            background: white; transition: all 0.2s; margin: 0 !important;
        }
        .pagination-wrapper .relative.z-0.inline-flex > a:hover { background: #f6ece8; color: #c17d2e; border-color: #c17d2e; }
        .pagination-wrapper .relative.z-0.inline-flex > span[aria-current="page"] > span {
            background: #4B3621 !important; color: white !important; border-color: #4B3621 !important;
        }
        .pagination-wrapper .relative.z-0.inline-flex svg { width: 18px; height: 18px; }
        .pagination-wrapper .relative.z-0.inline-flex > span[aria-disabled="true"] { opacity: 0.5; background: #fff8f5; }
    </style>
    @stack('styles')
</head>
<body class="bg-surface text-on-surface min-h-screen flex">

{{-- ── Sidebar ─────────────────────────────────── --}}
<nav class="fixed left-0 top-0 h-full w-[260px] bg-sidebar-bg border-r border-sidebar-border shadow-xl z-20 flex flex-col py-6 transition-transform duration-300"
     id="sidebar">

    {{-- Brand --}}
    <div class="px-6 mb-8 flex items-center gap-3">
        <span class="material-symbols-outlined text-[#F5F5F0] text-3xl">coffee_maker</span>
        <div class="flex flex-col">
            <span class="text-xl font-bold text-[#F5F5F0] tracking-tight font-heading">Pituwolu</span>
            <span class="text-sidebar-accent text-xs font-medium tracking-wider">Admin Panel</span>
        </div>
    </div>

    {{-- Nav Links --}}
    <div class="flex-1 flex flex-col gap-1 px-2 sidebar-nav overflow-y-auto">
        <a href="{{ route('admin.dashboard') }}"
           class="{{ request()->routeIs('admin.dashboard') ? 'bg-sidebar-active text-white font-semibold border-l-4 border-pit-accent' : 'text-sidebar-text hover:text-[#F5F5F0] hover:bg-sidebar-hover border-l-4 border-transparent' }} rounded-lg mx-2 my-0.5 px-4 py-3 flex items-center gap-3 transition-all duration-200 active:scale-[0.98]">
            <span class="material-symbols-outlined {{ request()->routeIs('admin.dashboard') ? 'fill' : '' }}">dashboard</span>
            <span class="text-sm">Dashboard</span>
        </a>

        <a href="{{ route('admin.menu.index') }}"
           class="{{ request()->routeIs('admin.menu.*') ? 'bg-sidebar-active text-white font-semibold border-l-4 border-pit-accent' : 'text-sidebar-text hover:text-[#F5F5F0] hover:bg-sidebar-hover border-l-4 border-transparent' }} rounded-lg mx-2 my-0.5 px-4 py-3 flex items-center gap-3 transition-all duration-200 active:scale-[0.98]">
            <span class="material-symbols-outlined {{ request()->routeIs('admin.menu.*') ? 'fill' : '' }}">restaurant_menu</span>
            <span class="text-sm">Menu Management</span>
        </a>

        <a href="{{ route('admin.gallery.index') }}"
           class="{{ request()->routeIs('admin.gallery.*') ? 'bg-sidebar-active text-white font-semibold border-l-4 border-pit-accent' : 'text-sidebar-text hover:text-[#F5F5F0] hover:bg-sidebar-hover border-l-4 border-transparent' }} rounded-lg mx-2 my-0.5 px-4 py-3 flex items-center gap-3 transition-all duration-200 active:scale-[0.98]">
            <span class="material-symbols-outlined {{ request()->routeIs('admin.gallery.*') ? 'fill' : '' }}">image</span>
            <span class="text-sm">Gallery</span>
        </a>

        <a href="{{ route('admin.review.index') }}"
           class="{{ request()->routeIs('admin.review.*') ? 'bg-sidebar-active text-white font-semibold border-l-4 border-pit-accent' : 'text-sidebar-text hover:text-[#F5F5F0] hover:bg-sidebar-hover border-l-4 border-transparent' }} rounded-lg mx-2 my-0.5 px-4 py-3 flex items-center gap-3 transition-all duration-200 active:scale-[0.98]">
            <span class="material-symbols-outlined {{ request()->routeIs('admin.review.*') ? 'fill' : '' }}">rate_review</span>
            <span class="text-sm">Reviews</span>
        </a>

        <a href="{{ route('admin.event.index') }}"
           class="{{ request()->routeIs('admin.event.*') ? 'bg-sidebar-active text-white font-semibold border-l-4 border-pit-accent' : 'text-sidebar-text hover:text-[#F5F5F0] hover:bg-sidebar-hover border-l-4 border-transparent' }} rounded-lg mx-2 my-0.5 px-4 py-3 flex items-center gap-3 transition-all duration-200 active:scale-[0.98]">
            <span class="material-symbols-outlined {{ request()->routeIs('admin.event.*') ? 'fill' : '' }}">campaign</span>
            <span class="text-sm">Promos & Events</span>
        </a>

        <a href="{{ route('admin.reservasi.index') }}"
           class="{{ request()->routeIs('admin.reservasi.*') ? 'bg-sidebar-active text-white font-semibold border-l-4 border-pit-accent' : 'text-sidebar-text hover:text-[#F5F5F0] hover:bg-sidebar-hover border-l-4 border-transparent' }} rounded-lg mx-2 my-0.5 px-4 py-3 flex items-center gap-3 transition-all duration-200 active:scale-[0.98]">
            <span class="material-symbols-outlined {{ request()->routeIs('admin.reservasi.*') ? 'fill' : '' }}">event_seat</span>
            <span class="text-sm">Reservasi & Order</span>
        </a>

        <a href="{{ route('admin.transaksi.index') }}"
           class="{{ request()->routeIs('admin.transaksi.*') ? 'bg-sidebar-active text-white font-semibold border-l-4 border-pit-accent' : 'text-sidebar-text hover:text-[#F5F5F0] hover:bg-sidebar-hover border-l-4 border-transparent' }} rounded-lg mx-2 my-0.5 px-4 py-3 flex items-center gap-3 transition-all duration-200 active:scale-[0.98]">
            <span class="material-symbols-outlined {{ request()->routeIs('admin.transaksi.*') ? 'fill' : '' }}">receipt_long</span>
            <span class="text-sm">Transaksi Order</span>
        </a>

        {{-- Divider + Lihat Website --}}
        <div class="mt-8 px-4">
            <div class="h-px w-full bg-sidebar-border mb-4"></div>
            <a href="{{ url('/') }}" target="_blank"
               class="text-sidebar-accent hover:text-[#F5F5F0] rounded-lg my-1 px-2 py-3 hover:bg-sidebar-hover transition-all duration-200 flex items-center gap-3 active:scale-[0.98]">
                <span class="material-symbols-outlined">open_in_new</span>
                <span class="text-sm">Lihat Website</span>
            </a>
        </div>
    </div>

    {{-- Sidebar Footer --}}
    <div class="px-2 mt-auto">
        <form method="POST" action="{{ route('admin.logout') }}" class="swal-confirm" data-swal-title="Keluar dari Admin?" data-swal-text="Anda akan keluar dari sesi ini.">
            @csrf
            <button type="submit"
                    class="w-full text-err-container hover:text-white rounded-lg mx-2 my-1 px-4 py-3 hover:bg-sidebar-hover transition-all duration-200 flex items-center gap-3 active:scale-[0.98] bg-transparent border-none cursor-pointer">
                <span class="material-symbols-outlined">logout</span>
                <span class="text-sm font-body">Logout</span>
            </button>
        </form>
    </div>
</nav>

{{-- ── Main Content ─────────────────────────────── --}}
<main class="ml-[260px] flex-1 flex flex-col min-h-screen">

    {{-- Top Bar --}}
    <header class="fixed top-0 right-0 left-[260px] h-16 bg-topbar-bg border-b border-topbar-border shadow-sm z-10 flex justify-between items-center px-8">
        <div class="flex items-center gap-4">
            <h1 class="text-pit-primary font-heading font-semibold text-xl">@yield('page-title', 'Dashboard')</h1>
        </div>
        <div class="flex items-center gap-6">
            <div class="flex items-center gap-2">
                <button class="text-pit-primary hover:bg-pit-primary/5 rounded-full p-2 transition-all">
                    <span class="material-symbols-outlined">notifications</span>
                </button>
            </div>
            <div class="h-8 w-px bg-outline-v mx-2"></div>
            <div class="flex items-center gap-3">
                <div class="flex flex-col items-end">
                    <span class="text-xs font-semibold text-on-surface tracking-wide">{{ auth()->user()->name ?? 'Admin' }}</span>
                    <span class="text-[11px] text-on-surface-muted">Manager</span>
                </div>
                <div class="w-10 h-10 rounded-full bg-pit-primary text-white flex items-center justify-center font-heading font-bold text-sm border-2 border-surface-dim">
                    {{ substr(auth()->user()->name ?? 'A', 0, 1) }}
                </div>
            </div>
        </div>
    </header>

    {{-- Page Content --}}
    <div class="p-6 mt-16 max-w-7xl mx-auto w-full">
        {{-- Breadcrumbs --}}
        <div class="flex items-center gap-2 text-on-surface-muted mb-6 text-xs font-medium">
            <span>Pituwolu Admin</span>
            <span class="material-symbols-outlined text-sm">chevron_right</span>
            <span class="text-pit-primary font-semibold">@yield('page-title', 'Dashboard')</span>
        </div>

        {{-- Alerts --}}
        @if(session('success'))
            <div class="mb-5 px-5 py-4 rounded-xl bg-pit-success-bg text-pit-success text-sm font-medium flex items-center gap-3 border border-pit-success/20">
                <span class="material-symbols-outlined fill">check_circle</span>
                {{ session('success') }}
            </div>
        @endif
        @if(session('error'))
            <div class="mb-5 px-5 py-4 rounded-xl bg-pit-danger-bg text-pit-danger text-sm font-medium flex items-center gap-3 border border-pit-danger/20">
                <span class="material-symbols-outlined fill">error</span>
                {{ session('error') }}
            </div>
        @endif

        @yield('content')
    </div>
</main>

@stack('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const confirmForms = document.querySelectorAll('.swal-confirm');
        confirmForms.forEach(form => {
            form.addEventListener('submit', function (e) {
                e.preventDefault();
                const title = this.getAttribute('data-swal-title') || 'Apakah Anda yakin?';
                const text = this.getAttribute('data-swal-text') || 'Data ini akan dihapus permanen!';
                
                Swal.fire({
                    title: title,
                    text: text,
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#c53030', // pit-danger
                    cancelButtonColor: '#80756c', // on-surface-muted
                    confirmButtonText: 'Ya, Lanjutkan!',
                    cancelButtonText: 'Batal',
                    customClass: {
                        popup: 'rounded-2xl border border-outline-v/30',
                        title: 'font-heading text-xl text-on-surface',
                        confirmButton: 'font-semibold rounded-lg px-5 py-2.5',
                        cancelButton: 'font-semibold rounded-lg px-5 py-2.5'
                    }
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            });
        });
    });
</script>
</body>
</html>
