@php
    $dbConnected = false;
    try {
        \Sakuci\Database\Connection::pdo();
        $dbConnected = true;
    } catch (\Throwable $e) {
        $dbConnected = false;
    }

    $currentUser = \App\Models\User::current();
@endphp

<!-- PALING ATAS: THEME TOGGLE (DARK/LIGHT MODE) + TOMBOL SILANG CLOSE -->
<div class="d-flex align-items-center justify-content-between mb-2">
    <div class="d-flex align-items-center gap-2">
        <button id="themeToggle" type="button" class="logo-toggle border-0 bg-transparent p-0"
                aria-label="Ganti tema terang/gelap (status database: {{ $dbConnected ? 'terhubung' : 'tidak terhubung' }})"
                title="Ganti tema terang/gelap">
            <svg width="28" height="28" viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg" style="display: block;" aria-hidden="true">
                <circle class="logo-ring" cx="16" cy="16" r="15"/>
                <circle cx="16" cy="16" r="9" fill="{{ $dbConnected ? '#28a745' : '#dc3545' }}"/>
            </svg>
        </button>
        <span class="fw-semibold text-body fs-6">peminjaman alat</span>
    </div>

    <!-- Tombol Silang (X) untuk Menutup Sidebar -->
    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
</div>

<!-- SATU GARIS PEMISAH DI BAWAH MODE TEMA -->
<hr class="my-3 text-secondary">

<!-- LIST MENU VERTIKAL -->
<ul class="nav nav-pills flex-column gap-1">
    <!-- Beranda selalu muncul -->
    <li class="nav-item">
        <a class="nav-link {{ is_route('home') ? 'active' : '' }}" href="{{ route('home') }}">
            Beranda
        </a>
    </li>

    <!-- Menu Kategori, Alat, Peminjaman, Pengembalian, Dashboard HANYA TAMPIL JIKA SUDAH LOGIN -->
    @if ($currentUser)
        <li class="nav-item">
            <a class="nav-link {{ is_route('kategori.index') ? 'active' : '' }}" href="{{ route('kategori.index') }}">
                Kategori
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ is_route('alat.index') ? 'active' : '' }}" href="{{ route('alat.index') }}">
                Alat
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ is_route('peminjaman.index') ? 'active' : '' }}" href="{{ route('peminjaman.index') }}">
                Peminjaman
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ is_route('pengembalian.index') ? 'active' : '' }}" href="{{ route('pengembalian.index') }}">
                Pengembalian
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ is_route('admin.dashboard') || is_route('dashboard') ? 'active' : '' }}"
               href="{{ $currentUser->role === 'admin' ? route('admin.dashboard') : route('dashboard') }}">
                Dashboard
            </a>
        </li>
    @endif
</ul>

<!-- BAGIAN USER / LOGOUT / LOGIN -->
<div class="mt-3 pt-1">
    @if ($currentUser)
        <!-- Jika Sudah Login: Tampil Tombol Logout -->
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="btn btn-sm btn-outline-secondary w-100 text-start px-3 py-2">
                Logout ({{ $currentUser->username }})
            </button>
        </form>
    @else
        <!-- Jika Belum Login: Hanya Tampil Tombol Masuk -->
        <div class="d-grid gap-2">
            <a class="btn btn-sm btn-brand rounded-pill w-100 d-inline-flex align-items-center justify-content-center gap-2" href="{{ route('login') }}">
                <svg width="14" height="14" viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                    <circle cx="8" cy="5" r="3" fill="currentColor" stroke="none"/>
                    <path d="M2.5 14c0-3.6 2.9-5.8 5.5-5.8s5.5 2.2 5.5 5.8"/>
                </svg>
                Masuk
            </a>
        </div>
    @endif
</div>