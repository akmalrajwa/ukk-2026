<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', config('app.name'))</title>

    {{-- Terapkan tema tersimpan --}}
    <script>
        (function () {
            var saved = localStorage.getItem('sakuci-theme');
            var theme = saved || (matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light');
            document.documentElement.setAttribute('data-bs-theme', theme);
        })();
    </script>

    <link rel="stylesheet" href="{{ asset('vendor/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body class="d-flex flex-column min-vh-100 bg-body-tertiary">

<!-- HEADER UTAMA DI ATAS (Ada Tombol Garis 3 & Logo) -->
<header class="navbar navbar-expand bg-body border-bottom sticky-top px-3">
    <div class="container-fluid p-0">
        <div class="d-flex align-items-center gap-2">
            <!-- Tombol Garis 3 (Klik untuk Membuka Sidebar Menu) -->
            <button class="btn btn-outline-secondary border-0 px-2" type="button" 
                    data-bs-toggle="offcanvas" data-bs-target="#sidebarOffcanvas" 
                    aria-controls="sidebarOffcanvas" title="Buka Menu">
                <svg width="24" height="24" viewBox="0 0 16 16" fill="currentColor" aria-hidden="true">
                    <path fill-rule="evenodd" d="M2.5 12a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5z"/>
                </svg>
            </button>

            <a class="navbar-brand fw-semibold m-0 fs-5" href="{{ route('home') }}">{{ config('app.name') }}</a>
        </div>
    </div>
</header>

<!-- SIDEBAR OFFCANVAS (Muncul dari kiri saat tombol garis 3 diklik) -->
<div class="offcanvas offcanvas-start bg-body" tabindex="-1" id="sidebarOffcanvas" aria-labelledby="sidebarOffcanvasLabel" style="width: 280px;">
    <div class="offcanvas-body p-3">
        @include('partials.navbar')
    </div>
</div>

<!-- KONTEN UTAMA HALAMAN -->
<main class="container flex-grow-1 py-4 py-lg-5">
    @include('partials.flash')

    @yield('content')
</main>

@include('partials.footer')

<script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('js/theme.js') }}"></script>
@yield('scripts')

</body>
</html>