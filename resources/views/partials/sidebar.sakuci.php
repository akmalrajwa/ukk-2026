@php
    $currentUri = parse_url($_SERVER['REQUEST_URI'] ?? '', PHP_URL_PATH);

    $currentUser = $user ?? \App\Models\User::current();
    $role = $currentUser->role ?? 'siswa';

    $logoUrl = route('dashboard');
    if ($currentUser) {
        if ($role === 'admin') {
            $logoUrl = route('admin.dashboard');
        } elseif ($role === 'petugas') {
            $logoUrl = route('petugas.dashboard');
        } elseif ($role === 'peminjam') {
            $logoUrl = route('peminjam.dashboard');
        }
    } else {
        $logoUrl = route('home');
    }

    $isActive = function(...$paths) use ($currentUri) {
        foreach ($paths as $path) {
            if (empty($path)) continue;
            if ($path === '/' && ($currentUri === '/' || str_ends_with($currentUri, '/public/'))) return true;
            if ($path !== '/' && str_contains($currentUri, $path)) return true;
        }
        return false;
    };
@endphp

<!-- CSS Kustom Adaptif Mode Terang & Gelap (Sakuci Red Theme) -->
<style>
    /* Variabel Warna Tema Sakuci Red */
    :root {
        --brand-primary: #dc3545;
        --brand-dark: #b02a37;
        --brand-gradient: linear-gradient(135deg, #dc3545 0%, #e35d6a 100%);
        --brand-hover-bg: rgba(220, 53, 69, 0.1);
        --brand-active-shadow: 0 4px 12px rgba(220, 53, 69, 0.25);
    }

    /* Toggle Ikon Mode Gelap/Terang Modern */
    #themeToggle .icon-light-mode { display: none; }
    #themeToggle .icon-dark-mode { display: inline-block; }

    [data-bs-theme="light"] #themeToggle .icon-light-mode { display: inline-block; }
    [data-bs-theme="light"] #themeToggle .icon-dark-mode { display: none; }

    /* Brand Logo Icon Circle & Sleek */
    .brand-icon-wrapper {
        background: var(--brand-gradient);
        box-shadow: 0 2px 8px rgba(220, 53, 69, 0.3);
        transition: transform 0.2s ease;
    }
    
    .brand-logo-link:hover .brand-icon-wrapper {
        transform: scale(1.08) rotate(-5deg);
    }

    .brand-logo-title {
        color: var(--brand-primary) !important;
    }

    /* Style Sidebar Link yang Adaptif untuk Mode Gelap & Terang */
    .sidebar-link {
        position: relative;
        display: flex;
        align-items: center;
        gap: 0.75rem;
        padding: 0.6rem 0.85rem;
        color: var(--bs-body-color, #212529) !important;
        text-decoration: none;
        border-radius: 0.5rem;
        font-size: 0.875rem;
        font-weight: 500;
        transition: all 0.2s ease;
    }

    .sidebar-link i {
        font-size: 1.1rem;
        color: var(--brand-primary);
        transition: all 0.2s ease;
    }

    /* Hover State */
    .sidebar-link:hover {
        background-color: var(--brand-hover-bg);
        color: var(--brand-primary) !important;
        padding-left: 1.1rem;
    }

    .sidebar-link:hover i {
        color: var(--brand-primary) !important;
    }

    /* Active State (Red Gradien) */
    .sidebar-link.active {
        background: var(--brand-gradient) !important;
        color: #ffffff !important;
        font-weight: 600;
        box-shadow: var(--brand-active-shadow);
    }

    .sidebar-link.active i {
        color: #ffffff !important;
    }

    /* Section Heading Adaptif */
    .sidebar-heading {
        font-size: 0.7rem;
        font-weight: 700;
        letter-spacing: 0.08em;
        text-transform: uppercase;
        color: var(--bs-secondary-color, #6c757d) !important;
        margin-top: 1.25rem;
        margin-bottom: 0.4rem;
        padding-left: 0.85rem;
    }

    /* Floating User Card Compact */
    .user-profile-card {
        background: var(--bs-tertiary-bg);
        border: 1px solid var(--bs-border-color-translucent);
        border-radius: 0.75rem;
    }

    .user-avatar-brand {
        background: var(--brand-gradient) !important;
    }

    .badge-brand {
        background: rgba(220, 53, 69, 0.12) !important;
        color: var(--brand-primary) !important;
        border: 1px solid rgba(220, 53, 69, 0.25) !important;
    }

    /* Custom Red Buttons untuk Guest */
    .btn-brand-outline {
        color: var(--brand-primary);
        border-color: var(--brand-primary);
    }
    .btn-brand-outline:hover {
        background-color: var(--brand-primary);
        color: #ffffff;
    }

    .btn-brand-fill {
        background: var(--brand-gradient);
        color: #ffffff;
        border: none;
    }
    .btn-brand-fill:hover {
        opacity: 0.9;
        color: #ffffff;
    }

    .btn-logout-text {
        font-size: 0.75rem;
        padding: 0.25rem 0.6rem;
        transition: all 0.2s ease;
    }

    /* ===== Sidebar selalu gelap dengan teks putih (terbaca di mode terang maupun gelap) ===== */
    #appSidebar {
        background-color: #1c1113 !important;
        color: #ffffff;
        border-color: rgba(255, 255, 255, 0.12) !important;
    }
    #appSidebar .border-bottom {
        border-color: rgba(255, 255, 255, 0.12) !important;
    }
    #appSidebar .text-body,
    #appSidebar .brand-logo-title {
        color: #ffffff !important;
    }
    #appSidebar .sidebar-link,
    #appSidebar .sidebar-link:hover {
        color: #ffffff !important;
    }
    #appSidebar .sidebar-link:hover {
        background-color: rgba(255, 255, 255, 0.1);
    }
    #appSidebar .sidebar-link i {
        color: #ff6b6b;
    }
    #appSidebar .sidebar-link:hover i,
    #appSidebar .sidebar-link.active i {
        color: #ffffff !important;
    }
    #appSidebar .sidebar-heading {
        color: #ffffff !important;
    }
    #appSidebar .user-profile-card {
        background: rgba(255, 255, 255, 0.08);
        border-color: rgba(255, 255, 255, 0.15);
    }
    #appSidebar .user-profile-card h6 {
        color: #ffffff !important;
    }
    #appSidebar .badge-brand {
        background: rgba(220, 53, 69, 0.35) !important;
        border-color: rgba(255, 255, 255, 0.25) !important;
        color: #ffffff !important;
    }
    #appSidebar .btn-logout-text {
        color: #ffffff !important;
        border-color: #dc3545 !important;
    }
    #appSidebar .btn-logout-text:hover {
        background-color: #dc3545 !important;
    }
    #appSidebar .btn-brand-outline {
        color: #ffffff;
        border-color: #ffffff;
    }
    #appSidebar .btn-brand-outline:hover {
        background-color: #dc3545;
        border-color: #dc3545;
    }
</style>

<!-- Sidebar Utama -->
<div id="appSidebar" class="app-sidebar custom-sidebar flex-column p-3 bg-body border-end shadow-sm">
    
    <!-- Header Sidebar (Logo Gambar Gitar & Nama Sakuci) -->
    <div class="d-flex align-items-center justify-content-between mb-3 pb-3 border-bottom flex-shrink-0 px-1">
        <a href="{{ $logoUrl }}" class="brand-logo-link d-flex align-items-center gap-2 text-decoration-none text-body overflow-hidden">
            <!-- Ikon Logo Header (Gitar / Musik) -->
            <div class="brand-icon-wrapper text-white rounded-circle d-flex align-items-center justify-content-center flex-shrink-0" style="width: 32px; height: 32px;">
                <i class="bi bi-music-note-beamed fs-6"></i>
            </div>
            <div class="d-flex flex-column lh-1">
                <span class="fs-6 fw-bold tracking-wider text-uppercase text-truncate m-0">
                    <span class="brand-logo-title">Mel</span><span class="text-body">odis</span>
                </span>
            </div>
        </a>

        <div class="d-flex align-items-center gap-1">
            <!-- Toggle Mode (Ikon Sun & Moon Stars) -->
            <button id="themeToggle" type="button" class="btn btn-sm btn-icon btn-light rounded-circle text-body p-1.5 shadow-sm"
                    aria-label="Ganti tema" title="Ganti tema">
                <i class="bi bi-moon-stars-fill fs-6 text-danger icon-dark-mode"></i>
                <i class="bi bi-sun-fill fs-6 text-warning icon-light-mode"></i>
            </button>

            <!-- Close Mobile -->
            <label for="sidebarCheck" id="sidebarToggleClose" class="btn btn-sm btn-link text-body p-0 mb-0" role="button" aria-label="Tutup Menu">
                <i class="bi bi-x-lg fs-5"></i>
            </label>
        </div>
    </div>

    <!-- Bagian Navigasi Menu -->
    <div class="flex-grow-1 overflow-y-auto pe-1" style="scrollbar-width: thin;">
        <ul class="nav nav-pills flex-column gap-1 mb-3">
            
            <li>
                @php 
                    $active = (function_exists('is_route') && is_route('home')) || $currentUri === '/' || str_ends_with($currentUri, '/public/'); 
                @endphp
                <a href="{{ route('home') }}" class="sidebar-link {{ $active ? 'active' : '' }}">
                    <i class="bi bi-house-door"></i>
                    <span>Beranda Utama</span>
                </a>
            </li>

            {{-- ==================== MENU ADMIN ==================== --}}
            @if($role === 'admin')
                <div class="sidebar-heading">Ringkasan</div>
                <li>
                    @php $active = $isActive('/admin/dashboard') || $currentUri === '/admin' || $currentUri === '/admin/'; @endphp
                    <a href="{{ route('admin.dashboard') }}" class="sidebar-link {{ $active ? 'active' : '' }}">
                        <i class="bi bi-grid"></i>
                        <span>Dashboard</span>
                    </a>
                </li>

                <div class="sidebar-heading">Akses & Pengguna</div>
                <li>
                    @php $active = $isActive('/admin/users'); @endphp
                    <a href="{{ route('admin.users.index') }}" class="sidebar-link {{ $active ? 'active' : '' }}">
                        <i class="bi bi-people"></i>
                        <span>Manage User</span>
                    </a>
                </li>
                <li>
                    @php $active = $isActive('/admin/roles'); @endphp
                    <a href="{{ route('admin.roles.index') }}" class="sidebar-link {{ $active ? 'active' : '' }}">
                        <i class="bi bi-shield-lock"></i>
                        <span>Manage Role</span>
                    </a>
                </li>

                <div class="sidebar-heading">Alat</div>
                <li>
                    @php $active = $isActive('/admin/kategori'); @endphp
                    <a href="{{ route('kategori.index') }}" class="sidebar-link {{ $active ? 'active' : '' }}">
                        <i class="bi bi-tags"></i>
                        <span>Kategori Alat</span>
                    </a>
                </li>
                <li>
                    @php $active = $isActive('/admin/alat'); @endphp
                    <a href="{{ route('alat.index') }}" class="sidebar-link {{ $active ? 'active' : '' }}">
                        <i class="bi bi-tools"></i>
                        <span>Data Alat</span>
                    </a>
                </li>

                <div class="sidebar-heading">Transaksi</div>
                <li>
                    @php $active = $isActive('/admin/peminjaman'); @endphp
                    <a href="{{ route('peminjaman.index') }}" class="sidebar-link {{ $active ? 'active' : '' }}">
                        <i class="bi bi-box-arrow-up-right"></i>
                        <span>Peminjaman</span>
                    </a>
                </li>
                <li>
                    @php $active = $isActive('/admin/pengembalian'); @endphp
                    <a href="{{ route('pengembalian.index') }}" class="sidebar-link {{ $active ? 'active' : '' }}">
                        <i class="bi bi-box-arrow-in-down-left"></i>
                        <span>Pengembalian</span>
                    </a>
                </li>

                <div class="sidebar-heading">Sistem</div>
                <li>
                    @php $active = $isActive('/admin/log-aktifitas'); @endphp
                    <a href="{{ route('admin.log.index') }}" class="sidebar-link {{ $active ? 'active' : '' }}">
                        <i class="bi bi-journal-text"></i>
                        <span>Log Aktivitas</span>
                    </a>
                </li>
                <li>
                    @php $active = $isActive('/admin/database/export'); @endphp
                    <a href="{{ route('admin.database.export') }}" class="sidebar-link {{ $active ? 'active' : '' }}">
                        <i class="bi bi-database-down"></i>
                        <span>Backup Database</span>
                    </a>
                </li>

            {{-- ==================== MENU PEMINJAM ==================== --}}
            @elseif($role === 'peminjam')
                <div class="sidebar-heading">Menu Peminjam</div>
                <li>
                    @php $active = $currentUri === '/peminjam' || $currentUri === '/peminjam/' || $isActive('/peminjam/dashboard'); @endphp
                    <a href="{{ route('peminjam.dashboard') }}" class="sidebar-link {{ $active ? 'active' : '' }}">
                        <i class="bi bi-grid"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
                <li>
                    @php $active = $isActive('/peminjam/daftar-alat', '/peminjam/alat'); @endphp
                    <a href="{{ route('peminjam.alat') }}" class="sidebar-link {{ $active ? 'active' : '' }}">
                        <i class="bi bi-collection"></i>
                        <span>Daftar Alat</span>
                    </a>
                </li>
                <li>
                    @php $active = $isActive('/peminjam/ajukan', '/peminjam/create', '/peminjam/peminjam/ajukan'); @endphp
                    <a href="{{ route('peminjam.createPeminjam') }}" class="sidebar-link {{ $active ? 'active' : '' }}">
                        <i class="bi bi-file-earmark-plus"></i>
                        <span>Ajukan Peminjaman</span>
                    </a>
                </li>
                <li>
                    @php $active = $isActive('/peminjam/pengembalian'); @endphp
                    <a href="{{ route('peminjam.pengembalian.create') }}" class="sidebar-link {{ $active ? 'active' : '' }}">
                        <i class="bi bi-arrow-return-left"></i>
                        <span>Pengembalian Alat</span>
                    </a>
                </li>
                <li>
                    @php $active = $isActive('/riwayat-peminjaman'); @endphp
                    <a href="{{ route('peminjam.riwayat') }}" class="sidebar-link {{ $active ? 'active' : '' }}">
                        <i class="bi bi-clock-history"></i>
                        <span>Riwayat Aktivitas</span>
                    </a>
                </li>

            {{-- ==================== MENU PETUGAS ==================== --}}
            @elseif($role === 'petugas')
                <div class="sidebar-heading">Akses Petugas</div>
                <li>
                    @php 
                        $active = $currentUri === '/petugas' || 
                                  $currentUri === '/petugas/' || 
                                  $isActive('/petugas/dashboard'); 
                    @endphp
                    <a href="{{ route('petugas.dashboard') }}" class="sidebar-link {{ $active ? 'active' : '' }}">
                        <i class="bi bi-grid"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
                <li>
                    @php $active = $isActive('/petugas/peminjaman'); @endphp
                    <a href="{{ route('petugas.peminjaman.index') }}" class="sidebar-link {{ $active ? 'active' : '' }}">
                        <i class="bi bi-check2-square"></i>
                        <span>Persetujuan Alat</span>
                    </a>
                </li>
                <li>
                    @php $active = $isActive('/petugas/pengembalian'); @endphp
                    <a href="{{ route('petugas.pengembalian.index') }}" class="sidebar-link {{ $active ? 'active' : '' }}">
                        <i class="bi bi-arrow-repeat"></i>
                        <span>Pantau Pengembalian</span>
                    </a>
                </li>
            @endif

        </ul>
    </div>

    <!-- BAGIAN BAWAH SIDEBAR (Profil Compact / Auth) -->
    <div class="pt-2 flex-shrink-0">
        @if ($currentUser)
            <!-- Profil User Compact -->
            <div class="user-profile-card p-2 d-flex align-items-center justify-content-between">
                <div class="d-flex align-items-center gap-2 overflow-hidden">
                    <div class="user-avatar-brand text-white rounded-circle p-1.5 d-flex align-items-center justify-content-center fw-bold shadow-sm" style="width: 32px; height: 32px; flex-shrink: 0; font-size: 0.8rem;">
                        {{ strtoupper(substr($currentUser->username ?? 'U', 0, 1)) }}
                    </div>
                    <div class="overflow-hidden lh-sm">
                        <h6 class="mb-0 text-truncate fw-semibold" style="font-size: 0.8rem; color: var(--bs-emphasis-color);">{{ $currentUser->username ?? 'User' }}</h6>
                        <span class="badge badge-brand rounded-pill text-capitalize" style="font-size: 0.6rem; padding: 2px 6px;">
                            {{ $role }}
                        </span>
                    </div>
                </div>

                <!-- Tombol Logout Teks -->
                <form method="POST" action="{{ route('logout') }}" class="m-0">
                    @csrf
                    <button type="submit" class="btn btn-outline-danger btn-logout-text rounded-3 fw-medium d-inline-flex align-items-center gap-1">
                        <i class="bi bi-box-arrow-right"></i> Keluar
                    </button>
                </form>
            </div>
        @else
            <!-- Tombol Guest -->
            <div class="d-flex flex-column gap-2">
                <a href="{{ route('login') }}" class="btn btn-sm btn-brand-outline w-100 rounded-3 d-flex align-items-center justify-content-center gap-2 py-2">
                    <i class="bi bi-box-arrow-in-right"></i>
                    <span class="fw-medium">Masuk</span>
                </a>
                <a href="{{ route('register') }}" class="btn btn-sm btn-brand-fill w-100 rounded-3 d-flex align-items-center justify-content-center gap-2 py-2 shadow-sm">
                    <i class="bi bi-person-plus-fill"></i>
                    <span class="fw-medium">Daftar Akun</span>
                </a>
            </div>
        @endif
    </div>

</div>