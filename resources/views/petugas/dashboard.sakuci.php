@extends('layouts.app')

@section('title', config('app.name') . ' — Dashboard Petugas')

@section('content')
<div class="container-fluid py-4 px-3 px-md-4">

    <!-- Hero Banner Utama Petugas (Tema Crimson Sakuci Persis Peminjam) -->
    <div class="card border-0 rounded-4 overflow-hidden mb-4 shadow-sm text-white position-relative" 
         style="background: linear-gradient(135deg, #a71d2a 0%, #dc3545 50%, #78101a 100%);">
        
        <div class="banner-pattern"></div>
        <div class="banner-glow-red"></div>

        <div class="card-body p-4 p-md-5 position-relative z-1">
            <div class="row align-items-center justify-content-between g-4">
                
                <div class="col-lg-9">
                    <div class="d-flex align-items-center gap-2 mb-3">
                        <span class="badge rounded-pill px-3 py-1.5 fw-semibold small text-uppercase tracking-wider"
                              style="background-color: rgba(255, 255, 255, 0.2); color: #ffffff; border: 1px solid rgba(255, 255, 255, 0.3);">
                            <i class="bi bi-shield-check me-1"></i> Area Petugas Operasional
                        </span>
                    </div>
                    
                    <h1 class="fw-bold mb-2 tracking-tight text-white display-6">
                        Selamat Datang, {{ $user->username ?? 'Petugas' }}! 👋
                    </h1>
                    <p class="text-white-50 mb-4 col-lg-11" style="font-size: 0.95rem;">
                        Kelola proses peminjaman instrumen musik, verifikasi pengajuan siswa, dan pantau pengembalian alat secara real-time.
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- 📊 3 KARTU STATISTIK UTAMA PETUGAS -->
    <div class="row g-3 mb-4">
        
        <!-- Menunggu Verifikasi -->
        <div class="col-6 col-md-4">
            <div class="card stat-card border-0 shadow-sm rounded-4 p-4 h-100 bg-body position-relative">
                <div class="d-flex align-items-center justify-content-between mb-3">
                    <div class="stat-icon-box bg-warning-subtle text-warning-emphasis">
                        <i class="bi bi-hourglass-split"></i>
                    </div>
                    <span class="badge bg-warning-subtle text-warning-emphasis border border-warning-subtle rounded-pill px-2.5 py-1 fs-8 fw-semibold">Menunggu</span>
                </div>
                <div>
                    <span class="text-secondary text-uppercase fw-bold fs-8 tracking-wider d-block mb-1">Menunggu Verifikasi</span>
                    <h2 class="fw-bold mb-1 text-body-emphasis tracking-tight text-warning">{{ $totalPending ?? 0 }}</h2>
                    <small class="text-secondary fs-8">Permohonan diproses</small>
                </div>
            </div>
        </div>

        <!-- Alat Musik Dipinjam -->
        <div class="col-6 col-md-4">
            <div class="card stat-card border-0 shadow-sm rounded-4 p-4 h-100 bg-body position-relative">
                <div class="d-flex align-items-center justify-content-between mb-3">
                    <div class="stat-icon-box bg-danger-subtle text-danger">
                        <i class="bi bi-disc"></i>
                    </div>
                    <span class="badge bg-danger-subtle text-danger border border-danger-subtle rounded-pill px-2.5 py-1 fs-8 fw-semibold">Aktif</span>
                </div>
                <div>
                    <span class="text-secondary text-uppercase fw-bold fs-8 tracking-wider d-block mb-1">Alat Musik Dipinjam</span>
                    <h2 class="fw-bold mb-1 text-danger tracking-tight">{{ $totalDipinjam ?? 0 }}</h2>
                    <small class="text-secondary fs-8">Sedang dipinjam siswa</small>
                </div>
            </div>
        </div>

        <!-- Total Selesai -->
        <div class="col-12 col-md-4">
            <div class="card stat-card border-0 shadow-sm rounded-4 p-4 h-100 bg-body position-relative">
                <div class="d-flex align-items-center justify-content-between mb-3">
                    <div class="stat-icon-box bg-success-subtle text-success">
                        <i class="bi bi-check-circle-fill"></i>
                    </div>
                    <span class="badge bg-success-subtle text-success border border-success-subtle rounded-pill px-2.5 py-1 fs-8 fw-semibold">Selesai</span>
                </div>
                <div>
                    <span class="text-secondary text-uppercase fw-bold fs-8 tracking-wider d-block mb-1">Total Selesai</span>
                    <h2 class="fw-bold mb-1 text-body-emphasis tracking-tight text-success">{{ $totalSelesai ?? 0 }}</h2>
                    <small class="text-secondary fs-8">Riwayat</small>
                </div>
            </div>
        </div>

    </div>

    <!-- ⚡ MENU AKSES CEPAT -->
    <div class="d-flex align-items-center justify-content-between mb-3">
        <h5 class="fw-bold mb-0 text-body-emphasis fs-6"><i class="bi bi-grid-fill me-2 text-danger"></i>Menu Akses Cepat</h5>
    </div>

    <div class="row g-3 mb-4">
        <!-- Persetujuan Peminjaman -->
        <div class="col-md-6">
            <a href="{{ route('petugas.peminjaman.index') }}" class="card custom-menu-card h-100 text-decoration-none border shadow-sm rounded-4 p-4 bg-body">
                <div class="d-flex align-items-start justify-content-between mb-3">
                    <div class="menu-icon-wrapper rounded-3 p-3 d-flex align-items-center justify-content-center bg-danger-subtle text-danger">
                        <i class="bi bi-check-circle fs-4"></i>
                    </div>
                    <i class="bi bi-arrow-up-right text-secondary fs-6"></i>
                </div>
                <div>
                    <h6 class="fw-bold text-body-emphasis mb-1 fs-5">Persetujuan Peminjaman</h6>
                    <small class="text-danger d-block mb-2 fw-medium">Verifikasi Pengajuan Siswa</small>
                    <p class="text-secondary small mb-0 fs-8">Proses persetujuan atau penolakan permohonan peminjaman alat musik dari siswa.</p>
                </div>
            </a>
        </div>

        <!-- Pantau Pengembalian -->
        <div class="col-md-6">
            <a href="{{ route('petugas.pengembalian.index') }}" class="card custom-menu-card h-100 text-decoration-none border shadow-sm rounded-4 p-4 bg-body">
                <div class="d-flex align-items-start justify-content-between mb-3">
                    <div class="menu-icon-wrapper rounded-3 p-3 d-flex align-items-center justify-content-center bg-danger-subtle text-danger">
                        <i class="bi bi-arrow-return-left fs-4"></i>
                    </div>
                    <i class="bi bi-arrow-up-right text-secondary fs-6"></i>
                </div>
                <div>
                    <h6 class="fw-bold text-body-emphasis mb-1 fs-5">Pantau Pengembalian</h6>
                    <small class="text-danger d-block mb-2 fw-medium">Pencatatan Barang &amp; Denda</small>
                    <p class="text-secondary small mb-0 fs-8">Konfirmasi pengembalian instrumen, periksa kondisi fisik, dan hitung denda keterlambatan.</p>
                </div>
            </a>
        </div>
    </div>

</div>

<style>
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

    .backdrop-blur {
        backdrop-filter: blur(8px);
        -webkit-backdrop-filter: blur(8px);
    }

    .stat-card {
        border: 1px solid var(--bs-border-color-translucent) !important;
        transition: all 0.25s ease;
    }

    .stat-card:hover {
        transform: translateY(-4px);
        border-color: #dc3545 !important;
        box-shadow: 0 0.75rem 1.5rem rgba(220, 53, 69, 0.12) !important;
    }

    .stat-icon-box {
        width: 44px; height: 44px;
        border-radius: 12px;
        display: flex; align-items: center; justify-content: center;
        font-size: 1.25rem;
    }

    .custom-menu-card {
        border: 1px solid var(--bs-border-color-translucent) !important;
        transition: all 0.25s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .custom-menu-card:hover {
        border-color: #dc3545 !important;
        transform: translateY(-4px);
        box-shadow: 0 12px 24px -10px rgba(220, 53, 69, 0.15) !important;
    }

    .custom-menu-card:hover .menu-icon-wrapper {
        background-color: #dc3545 !important;
        color: #ffffff !important;
    }

    .fs-8 { font-size: 0.75rem; }
    .tracking-wider { letter-spacing: 0.06em; }
</style>
@endsection