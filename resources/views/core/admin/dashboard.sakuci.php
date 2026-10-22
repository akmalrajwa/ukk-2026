@extends('layouts.app')

@section('title', config('app.name') . ' — Admin Dashboard')

@section('content')
<div class="container-fluid py-4 px-3 px-md-4">

    <!-- Header Banner Utama (Red Crimson Sakuci Theme) -->
    <div class="card border-0 rounded-4 overflow-hidden mb-4 shadow-sm text-white position-relative" 
         style="background: linear-gradient(135deg, #a71d2a 0%, #dc3545 50%, #78101a 100%);">
        
        <div class="banner-pattern"></div>
        <div class="banner-glow-red"></div>

        <div class="card-body p-4 p-md-4 position-relative z-1">
            <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3">
                <div>
                    <div class="d-flex align-items-center gap-2 mb-2">
                        <span class="badge rounded-pill px-3 py-1.5 fw-semibold small text-uppercase tracking-wider"
                              style="background-color: rgba(255, 255, 255, 0.2); color: #ffffff; border: 1px solid rgba(255, 255, 255, 0.3);">
                            <i class="bi bi-shield-check me-1"></i> Area Admin
                        </span>
                    </div>
                    <h3 class="fw-bold mb-1 text-white">Selamat Datang, {{ $user->username }}! 👋</h3>
                    <p class="text-white-50 small mb-0" style="max-width: 620px;">
                        Kelola sistem, hak akses pengguna, serta cadangan database aplikasi Anda dari panel kontrol ini secara terpusat.
                    </p>
                </div>
                
                <div class="d-none d-md-block">
                    <div class="p-3 bg-white bg-opacity-10 rounded-circle shadow-sm border border-light border-opacity-25">
                        <svg width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="text-white">
                            <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/>
                            <path d="m9 12 2 2 4-4"/>
                        </svg>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Statistik Ringkasan Otomatis (Ikon Warna-warni, Hover Glow Merah Seragam) -->
    <div class="row g-3 mb-4">
        
        <!-- Total User (Nuansa Abu/Dark) -->
        <div class="col-6 col-md-4 col-lg">
            <div class="card border-0 shadow-sm rounded-4 bg-body p-3 h-100 stat-card">
                <div class="d-flex align-items-center justify-content-between mb-2">
                    <div class="icon-box-stat rounded-3 bg-secondary-subtle text-body-emphasis d-flex align-items-center justify-content-center">
                        <i class="bi bi-people fs-5"></i>
                    </div>
                    <span class="badge bg-secondary-subtle text-body-emphasis rounded-pill border border-secondary-subtle px-2 py-0.5 small">Akun</span>
                </div>
                <span class="text-secondary small fw-semibold text-uppercase tracking-wider d-block mb-1">Total User</span>
                <h3 class="fw-bold text-body-emphasis mb-0">{{ $totalUser ?? 0 }}</h3>
            </div>
        </div>

        <!-- Total Kategori (Nuansa Kuning) -->
        <div class="col-6 col-md-4 col-lg">
            <div class="card border-0 shadow-sm rounded-4 bg-body p-3 h-100 stat-card">
                <div class="d-flex align-items-center justify-content-between mb-2">
                    <div class="icon-box-stat rounded-3 bg-warning-subtle text-warning-emphasis d-flex align-items-center justify-content-center">
                        <i class="bi bi-tags fs-5"></i>
                    </div>
                    <span class="badge bg-warning-subtle text-warning-emphasis rounded-pill border border-warning-subtle px-2 py-0.5 small">Jenis</span>
                </div>
                <span class="text-secondary small fw-semibold text-uppercase tracking-wider d-block mb-1">Total Kategori</span>
                <h3 class="fw-bold text-body-emphasis mb-0">{{ $totalKategori ?? 0 }}</h3>
            </div>
        </div>

        <!-- Total Alat (Nuansa Merah) -->
        <div class="col-6 col-md-4 col-lg">
            <div class="card border-0 shadow-sm rounded-4 bg-body p-3 h-100 stat-card">
                <div class="d-flex align-items-center justify-content-between mb-2">
                    <div class="icon-box-stat rounded-3 bg-danger-subtle text-danger d-flex align-items-center justify-content-center">
                        <i class="bi bi-tools fs-5"></i>
                    </div>
                    <span class="badge bg-danger-subtle text-danger rounded-pill border border-danger-subtle px-2 py-0.5 small">Unit</span>
                </div>
                <span class="text-secondary small fw-semibold text-uppercase tracking-wider d-block mb-1">Total Alat</span>
                <h3 class="fw-bold text-body-emphasis mb-0">{{ $totalAlat ?? 0 }}</h3>
            </div>
        </div>

        <!-- Peminjaman (Nuansa Cyan/Info) -->
        <div class="col-6 col-md-6 col-lg">
            <div class="card border-0 shadow-sm rounded-4 bg-body p-3 h-100 stat-card">
                <div class="d-flex align-items-center justify-content-between mb-2">
                    <div class="icon-box-stat rounded-3 bg-info-subtle text-info-emphasis d-flex align-items-center justify-content-center">
                        <i class="bi bi-box-arrow-up-right fs-5"></i>
                    </div>
                    <span class="badge bg-info-subtle text-info-emphasis rounded-pill border border-info-subtle px-2 py-0.5 small">Transaksi</span>
                </div>
                <span class="text-secondary small fw-semibold text-uppercase tracking-wider d-block mb-1">Peminjaman</span>
                <h3 class="fw-bold text-body-emphasis mb-0">{{ $totalPeminjaman ?? 0 }}</h3>
            </div>
        </div>

        <!-- Pengembalian (Nuansa Hijau) -->
        <div class="col-12 col-md-6 col-lg">
            <div class="card border-0 shadow-sm rounded-4 bg-body p-3 h-100 stat-card">
                <div class="d-flex align-items-center justify-content-between mb-2">
                    <div class="icon-box-stat rounded-3 bg-success-subtle text-success d-flex align-items-center justify-content-center">
                        <i class="bi bi-box-arrow-in-down-left fs-5"></i>
                    </div>
                    <span class="badge bg-success-subtle text-success rounded-pill border border-success-subtle px-2 py-0.5 small">Selesai</span>
                </div>
                <span class="text-secondary small fw-semibold text-uppercase tracking-wider d-block mb-1">Pengembalian</span>
                <h3 class="fw-bold text-body-emphasis mb-0">{{ $totalPengembalian ?? 0 }}</h3>
            </div>
        </div>

    </div>

    <!-- Judul Seksi Quick Menu -->
    <div class="d-flex align-items-center justify-content-between mb-3">
        <h2 class="h6 text-uppercase tracking-wider text-secondary fw-bold mb-0">Menu Pengelolaan</h2>
    </div>

    <!-- Grid Menu Navigasi Admin -->
    <div class="row g-4">
        
        <!-- Card 1: Manage Role -->
        <div class="col-md-6 col-lg-4">
            <a href="{{ route('admin.roles.index') }}" class="card border-0 shadow-sm rounded-4 text-decoration-none h-100 card-admin-item transition-all bg-body">
                <div class="card-body p-4 d-flex flex-column justify-content-between">
                    <div>
                        <div class="d-flex align-items-center justify-content-between mb-3">
                            <div class="icon-box rounded-3 bg-danger-subtle text-danger p-3 d-inline-flex align-items-center justify-content-center">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/>
                                    <circle cx="9" cy="7" r="4"/>
                                    <path d="M22 21v-2a4 4 0 0 0-3-3.87"/>
                                    <path d="M16 3.13a4 4 0 0 1 0 7.75"/>
                                </svg>
                            </div>
                            <span class="badge bg-body-tertiary text-secondary rounded-pill border px-2.5 py-1 small">Role &amp; Hak Akses</span>
                        </div>
                        <h3 class="h5 fw-bold text-body-emphasis mb-2">Manage Role</h3>
                        <p class="text-secondary small mb-0">Tambah, ubah, atau atur peran (role) pengguna untuk mengatur batasan hak akses sistem.</p>
                    </div>
                    <div class="mt-4 pt-2 border-top d-flex align-items-center text-danger fw-semibold small">
                        <span>Buka Pengaturan Role</span>
                        <svg class="ms-auto arrow-icon" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <line x1="5" y1="12" x2="19" y2="12"></line>
                            <polyline points="12 5 19 12 12 19"></polyline>
                        </svg>
                    </div>
                </div>
            </a>
        </div>

        <!-- Card 2: Manage User -->
        <div class="col-md-6 col-lg-4">
            <a href="{{ route('admin.users.index') }}" class="card border-0 shadow-sm rounded-4 text-decoration-none h-100 card-admin-item transition-all bg-body">
                <div class="card-body p-4 d-flex flex-column justify-content-between">
                    <div>
                        <div class="d-flex align-items-center justify-content-between mb-3">
                            <div class="icon-box rounded-3 bg-danger-subtle text-danger p-3 d-inline-flex align-items-center justify-content-center">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/>
                                    <circle cx="12" cy="7" r="4"/>
                                </svg>
                            </div>
                            <span class="badge bg-body-tertiary text-secondary rounded-pill border px-2.5 py-1 small">Pengguna</span>
                        </div>
                        <h3 class="h5 fw-bold text-body-emphasis mb-2">Manage User</h3>
                        <p class="text-secondary small mb-0">Kelola akun pengguna terdaftar, buat akun baru, serta sesuaikan penetapan role masing-masing.</p>
                    </div>
                    <div class="mt-4 pt-2 border-top d-flex align-items-center text-danger fw-semibold small">
                        <span>Kelola Daftar User</span>
                        <svg class="ms-auto arrow-icon" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <line x1="5" y1="12" x2="19" y2="12"></line>
                            <polyline points="12 5 19 12 12 19"></polyline>
                        </svg>
                    </div>
                </div>
            </a>
        </div>

        <!-- Card 3: Download Database -->
        <div class="col-md-6 col-lg-4">
            <a href="{{ route('admin.database.export') }}" class="card border-0 shadow-sm rounded-4 text-decoration-none h-100 card-admin-item transition-all bg-body">
                <div class="card-body p-4 d-flex flex-column justify-content-between">
                    <div>
                        <div class="d-flex align-items-center justify-content-between mb-3">
                            <div class="icon-box rounded-3 bg-warning-subtle text-warning-emphasis p-3 d-inline-flex align-items-center justify-content-center">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <ellipse cx="12" cy="5" rx="9" ry="3"/>
                                    <path d="M21 12c0 1.66-4 3-9 3s-9-1.34-9-3"/>
                                    <path d="M3 5v14c0 1.66 4 3 9 3s9-1.34 9-3V5"/>
                                </svg>
                            </div>
                            <span class="badge bg-body-tertiary text-secondary rounded-pill border px-2.5 py-1 small">Backup .SQL</span>
                        </div>
                        <h3 class="h5 fw-bold text-body-emphasis mb-2">Download Database</h3>
                        <p class="text-secondary small mb-0">Unduh seluruh cadangan data aplikasi ke format file <code>.sql</code> yang siap diimpor di server.</p>
                    </div>
                    <div class="mt-4 pt-2 border-top d-flex align-items-center text-warning-emphasis fw-semibold small">
                        <span>Ekspor File Database</span>
                        <svg class="ms-auto arrow-icon" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                            <polyline points="7 10 12 15 17 10"></polyline>
                            <line x1="12" y1="15" x2="12" y2="3"></line>
                        </svg>
                    </div>
                </div>
            </a>
        </div>

    </div>

</div>

<!-- Styling CSS dengan Hover Glow Merah Seragam -->
<style>
    /* Base Style Stat Card */
    .stat-card {
        border: 1px solid var(--bs-border-color-translucent) !important;
        transition: transform 0.25s cubic-bezier(0.4, 0, 0.2, 1), 
                    border-color 0.25s cubic-bezier(0.4, 0, 0.2, 1), 
                    box-shadow 0.25s cubic-bezier(0.4, 0, 0.2, 1) !important;
    }
    
    /* Efek Hover Glow Seragam Warna Merah */
    .stat-card:hover {
        transform: translateY(-3px) !important;
        border-color: rgba(220, 53, 69, 0.7) !important;
        box-shadow: 0 0 18px rgba(220, 53, 69, 0.3) !important;
    }

    .icon-box-stat {
        width: 38px;
        height: 38px;
    }

    /* Banner & Menu Items */
    .banner-pattern {
        position: absolute;
        top: 0; right: 0; bottom: 0; left: 0;
        background-image: radial-gradient(rgba(255, 255, 255, 0.1) 1px, transparent 1px);
        background-size: 20px 20px;
        opacity: 0.5;
        pointer-events: none;
    }

    .banner-glow-red {
        position: absolute;
        top: -60px; right: -60px;
        width: 250px; height: 250px;
        background: rgba(220, 53, 69, 0.3);
        filter: blur(60px);
        border-radius: 50%;
        pointer-events: none;
    }

    .card-admin-item {
        transition: all 0.25s cubic-bezier(0.4, 0, 0.2, 1);
        border: 1px solid var(--bs-border-color-translucent) !important;
    }
    
    .card-admin-item:hover {
        transform: translateY(-4px);
        border-color: rgba(220, 53, 69, 0.4) !important;
        box-shadow: 0 12px 24px -10px rgba(220, 53, 69, 0.2) !important;
    }
    
    .card-admin-item:hover .arrow-icon {
        transform: translateX(4px);
        transition: transform 0.2s ease;
    }
    
    .icon-box {
        width: 48px;
        height: 48px;
    }

    .tracking-wider { letter-spacing: 0.06em; }
</style>
@endsection