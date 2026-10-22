<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', config('app.name'))</title>

    <script>
        (function () {
            var saved = localStorage.getItem('sakuci-theme');
            var theme = saved || (matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light');
            document.documentElement.setAttribute('data-bs-theme', theme);
        })();
    </script>

    <link rel="stylesheet" href="{{ asset('vendor/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <!-- PUSAT CSS SIDEBAR & DESAIN MODERN (COMPACT TANPA JS) -->
    <style>
        /* Sidebar: panel yang menutupi halaman (overlay). Hanya panel dan lapisan gelap
           yang bergerak, isi halaman tidak ikut bergeser. */
        .app-sidebar {
            display: flex;
            width: 260px;
            max-width: 85vw;
            position: fixed;
            top: 0;
            left: 0;
            bottom: 0;
            z-index: 1050;
            box-shadow: var(--bs-box-shadow);
            overflow-y: auto;
            overscroll-behavior: contain;
            transform: translateX(-100%);
            visibility: hidden;
            transition: transform 0.25s ease, visibility 0s linear 0.25s;
            will-change: transform;
        }
        #sidebarCheck:checked ~ .d-flex .app-sidebar {
            transform: translateX(0);
            visibility: visible;
            transition: transform 0.25s ease, visibility 0s;
        }

        /* Kotak centang penggerak menu (disembunyikan) - tanpa JavaScript */
        .sidebar-check {
            position: absolute;
            opacity: 0;
            pointer-events: none;
            width: 0;
            height: 0;
        }
        label[for="sidebarCheck"] { cursor: pointer; }

        /* Lapisan gelap di belakang sidebar */
        .sidebar-backdrop {
            position: fixed;
            inset: 0;
            background: rgba(0, 0, 0, 0.5);
            z-index: 1045;
            opacity: 0;
            visibility: hidden;
            transition: opacity 0.25s ease, visibility 0s linear 0.25s;
        }
        #sidebarCheck:checked ~ .d-flex .sidebar-backdrop {
            opacity: 1;
            visibility: visible;
            transition: opacity 0.25s ease, visibility 0s;
        }
        /* Kunci scroll halaman saat menu terbuka (browser lama mengabaikan, tidak masalah) */
        body:has(#sidebarCheck:checked) {
            overflow: hidden;
        }

        @media (prefers-reduced-motion: reduce) {
            .app-sidebar, .sidebar-backdrop { transition: none !important; }
        }

        /* Custom Scrollbar Tipis & Estetik */
        .app-sidebar::-webkit-scrollbar {
            width: 4px;
        }
        .app-sidebar::-webkit-scrollbar-track {
            background: transparent;
        }
        .app-sidebar::-webkit-scrollbar-thumb {
            background: rgba(255, 255, 255, 0.15);
            border-radius: 10px;
        }

        .main-wrapper {
            flex-grow: 1;
            min-width: 0;
        }

        /* Teks MELODIS di bar atas */
        .topbar-brand {
            font-size: 1.05rem;
            letter-spacing: 0.08em;
            line-height: 1;
            color: var(--bs-emphasis-color); /* putih di mode gelap, hitam di mode terang */
        }
        .topbar-brand:hover {
            color: var(--bs-emphasis-color);
        }

        /* Desain Link Menu Sidebar yang Lebih Rapat & Pas di Satu Layar */
        .sidebar-link {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            border-radius: 8px;
            padding: 0.5rem 0.85rem; /* Padding dirapatkan agar muat semua */
            font-size: 0.85rem;
            font-weight: 500;
            text-decoration: none;
            color: var(--bs-body-color);
            opacity: 0.8;
            transition: all 0.2s ease;
            position: relative;
            z-index: 2;
        }
        .sidebar-link i {
            font-size: 1.1rem;
            flex-shrink: 0;
            transition: transform 0.2s ease;
        }
        .sidebar-link:hover {
            opacity: 1;
            background-color: var(--bs-tertiary-bg);
            color: var(--bs-primary);
        }
        .sidebar-link:hover i {
            transform: scale(1.1);
        }

        /* Status Aktif (Warna Biru Modern) */
        .sidebar-link.active {
            opacity: 1 !important;
            background: linear-gradient(135deg, #0d6efd 0%, #0b5ed7 100%) !important;
            color: #ffffff !important;
            font-weight: 600;
            box-shadow: 0 4px 10px rgba(13, 110, 253, 0.25);
        }
        .sidebar-link.active i {
            color: #ffffff !important;
        }

        .sidebar-heading {
            font-size: 0.65rem;
            letter-spacing: 0.08em;
            text-transform: uppercase;
            font-weight: 700;
            margin-top: 0.6rem;
            margin-bottom: 0.2rem;
        }
    </style>
</head>
<body class="bg-body-tertiary">

    {{-- Penggerak buka/tutup menu samping (tanpa JavaScript): harus berada sebelum .d-flex --}}
    <input type="checkbox" id="sidebarCheck" class="sidebar-check" autocomplete="off" aria-hidden="true" tabindex="-1">

    <div class="d-flex min-vh-100">

        {{-- Sidebar --}}
        @include('partials.sidebar')

        {{-- Lapisan gelap di belakang sidebar (klik untuk menutup) --}}
        <label for="sidebarCheck" id="sidebarBackdrop" class="sidebar-backdrop" aria-label="Tutup menu"></label>

        {{-- Konten Utama --}}
        <div class="main-wrapper d-flex flex-column">
            
            <!-- Navbar Atas untuk Tombol Trigger Sidebar -->
            <header class="navbar bg-body border-bottom px-4 py-2.5 sticky-top shadow-xs">
                <div class="d-flex align-items-center gap-3">
                    <label for="sidebarCheck" id="sidebarToggle" class="btn btn-outline-secondary btn-sm d-flex align-items-center gap-2 px-3 py-1.5 rounded-3 border-0 bg-body-secondary mb-0" role="button" aria-label="Buka menu">
                        <i class="bi bi-list fs-5"></i>
                        <span class="d-none d-sm-inline fw-medium">Menu</span>
                    </label>

                    <a href="{{ route('home') }}" class="topbar-brand text-decoration-none text-uppercase fw-bold">Melodis</a>
                </div>
            </header>

            <main class="container-fluid flex-grow-1 p-4 p-lg-5">
                @include('partials.flash')
                @yield('content')
            </main>

            @include('partials.footer')
            
        </div>

    </div>

<script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('js/theme.js') }}"></script>

@yield('scripts')

</body>
</html>