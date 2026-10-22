@extends('layouts.app')

@section('title', config('app.name') . ' — Portal Peminjam')

@section('content')
<div class="container-fluid py-4 px-3 px-md-4">

    <!-- Hero Banner Utama (Tema Crimson Sakuci) -->
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
                            <i class="bi bi-music-note-beamed me-1"></i> Area Peminjam Alat Musik
                        </span>
                    </div>
                    
                    <h1 class="fw-bold mb-2 tracking-tight text-white display-6">
                        Selamat Datang, {{ $user->username ?? 'Siswa' }}! 🎸
                    </h1>
                    <p class="text-white-50 mb-4 col-lg-11" style="font-size: 0.95rem;">
                        Akses dan ajukan instrumen musik, sound system, serta perlengkapan studio untuk keperluan praktik, ekstrakurikuler, maupun kegiatan sekolah.
                    </p>

                    <!-- Tombol Aksi Cepat -->
                    <div class="d-flex flex-wrap align-items-center gap-2">
                        <a href="{{ route('peminjam.alat') }}" class="btn btn-light text-danger px-4 py-2.5 rounded-3 fw-bold shadow-sm d-inline-flex align-items-center gap-2">
                            <i class="bi bi-music-note-list fs-6"></i>
                            <span>Cari & Pinjam Instrumen</span>
                        </a>
                        <a href="{{ route('peminjam.indexPeminjam') }}" class="btn btn-outline-light px-4 py-2.5 rounded-3 fw-medium backdrop-blur d-inline-flex align-items-center gap-2">
                            <i class="bi bi-clock-history"></i>
                            <span>Riwayat Peminjaman</span>
                        </a>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <!-- 📊 4 KARTU STATISTIK UTAMA -->
    <div class="row g-3 mb-4">
        
        <!-- Kartu Menunggu -->
        <div class="col-6 col-xl-3">
            <div class="card stat-card border-0 shadow-sm rounded-4 p-4 h-100 bg-body position-relative">
                <div class="d-flex align-items-center justify-content-between mb-3">
                    <div class="stat-icon-box bg-warning-subtle text-warning-emphasis">
                        <i class="bi bi-hourglass-split"></i>
                    </div>
                    <span class="badge bg-warning-subtle text-warning-emphasis border border-warning-subtle rounded-pill px-2.5 py-1 fs-8 fw-semibold">Menunggu</span>
                </div>
                <div>
                    <span class="text-secondary text-uppercase fw-bold fs-8 tracking-wider d-block mb-1">Permohonan Diproses</span>
                    <h2 class="fw-bold mb-1 text-body-emphasis tracking-tight text-warning">{{ $pendingCount ?? 0 }}</h2>
                    <small class="text-secondary fs-8">Menunggu persetujuan</small>
                </div>
            </div>
        </div>

        <!-- Kartu Dipinjam -->
        <div class="col-6 col-xl-3">
            <div class="card stat-card border-0 shadow-sm rounded-4 p-4 h-100 bg-body position-relative">
                <div class="d-flex align-items-center justify-content-between mb-3">
                    <div class="stat-icon-box bg-danger-subtle text-danger">
                        <i class="bi bi-music-note-list"></i>
                    </div>
                    <span class="badge bg-danger-subtle text-danger border border-danger-subtle rounded-pill px-2.5 py-1 fs-8 fw-semibold">Aktif</span>
                </div>
                <div>
                    <span class="text-secondary text-uppercase fw-bold fs-8 tracking-wider d-block mb-1">Instrumen Digunakan</span>
                    <h2 class="fw-bold mb-1 text-danger tracking-tight">{{ $activeCount ?? 0 }}</h2>
                    <small class="text-secondary fs-8">Sedang dipinjam</small>
                </div>
            </div>
        </div>

        <!-- Kartu Selesai -->
        <div class="col-6 col-xl-3">
            <div class="card stat-card border-0 shadow-sm rounded-4 p-4 h-100 bg-body position-relative">
                <div class="d-flex align-items-center justify-content-between mb-3">
                    <div class="stat-icon-box bg-success-subtle text-success">
                        <i class="bi bi-check-circle-fill"></i>
                    </div>
                    <span class="badge bg-success-subtle text-success border border-success-subtle rounded-pill px-2.5 py-1 fs-8 fw-semibold">Selesai</span>
                </div>
                <div>
                    <span class="text-secondary text-uppercase fw-bold fs-8 tracking-wider d-block mb-1">Telah Dikembalikan</span>
                    <h2 class="fw-bold mb-1 text-body-emphasis tracking-tight text-success">{{ $completedCount ?? 0 }}</h2>
                    <small class="text-secondary fs-8">Riwayat</small>
                </div>
            </div>
        </div>

        <!-- Kartu Denda -->
        <div class="col-6 col-xl-3">
            <div class="card stat-card border-0 shadow-sm rounded-4 p-4 h-100 bg-body position-relative">
                <div class="d-flex align-items-center justify-content-between mb-3">
                    <div class="stat-icon-box bg-danger-subtle text-danger">
                        <i class="bi bi-receipt"></i>
                    </div>
                    <span class="badge bg-danger-subtle text-danger border border-danger-subtle rounded-pill px-2.5 py-1 fs-8 fw-semibold">Denda</span>
                </div>
                <div>
                    <span class="text-secondary text-uppercase fw-bold fs-8 tracking-wider d-block mb-1">Catatan Denda</span>
                    <h2 class="fw-bold mb-1 text-body-emphasis tracking-tight text-danger fs-5">Rp {{ number_format($totalDenda ?? 0, 0, ',', '.') }}</h2>
                    <small class="text-secondary fs-8">keterlambatan</small>
                </div>
            </div>
        </div>

    </div>

    <!-- ⚡ INFORMASI ALAT MUSIK & PANDUAN -->
    <div class="row">
        <div class="col-12">
            <div class="card border-0 shadow-sm rounded-4 bg-body overflow-hidden">
                <div class="card-header bg-body border-bottom py-3 px-4 border-start border-4 border-danger">
                    <div class="d-flex align-items-center gap-2">
                        <i class="bi bi-shield-check text-danger fs-5"></i>
                        <h6 class="card-title mb-0 fw-bold text-body-emphasis">Ketentuan & Perawatan Instrumen Musik</h6>
                    </div>
                </div>
                <div class="card-body p-4">
                    <div class="row g-3">
                        <div class="col-md-4">
                            <div class="p-3 rounded-3 bg-body-tertiary border h-100 d-flex gap-3 align-items-start">
                                <div class="p-2.5 rounded-3 fs-4 d-flex align-items-center justify-content-center bg-danger-subtle text-danger" style="width: 44px; height: 44px; flex-shrink: 0;">
                                    <i class="bi bi-search"></i>
                                </div>
                                <div>
                                    <h6 class="fw-bold mb-1 text-body-emphasis fs-7">Cek Kelengkapan</h6>
                                    <p class="text-secondary fs-8 mb-0">Periksa kabel jack, adaptor, strap, softcase, atau aksesoris instrumen sebelum meninggalkan area pengawasan.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="p-3 rounded-3 bg-body-tertiary border h-100 d-flex gap-3 align-items-start">
                                <div class="p-2.5 rounded-3 fs-4 d-flex align-items-center justify-content-center bg-danger-subtle text-danger" style="width: 44px; height: 44px; flex-shrink: 0;">
                                    <i class="bi bi-shield-exclamation"></i>
                                </div>
                                <div>
                                    <h6 class="fw-bold mb-1 text-body-emphasis fs-7">Jaga Kondisi</h6>
                                    <p class="text-secondary fs-8 mb-0">Dilarang mengubah setelan permanen atau menukar komponen tanpa seizin pengelola ruang alat musik.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="p-3 rounded-3 bg-body-tertiary border h-100 d-flex gap-3 align-items-start">
                                <div class="p-2.5 rounded-3 fs-4 d-flex align-items-center justify-content-center bg-danger-subtle text-danger" style="width: 44px; height: 44px; flex-shrink: 0;">
                                    <i class="bi bi-arrow-return-left"></i>
                                </div>
                                <div>
                                    <h6 class="fw-bold mb-1 text-body-emphasis fs-7">Pengembalian Tepat Waktu</h6>
                                    <p class="text-secondary fs-8 mb-0">Kembalikan instrumen sesuai jadwal agar dapat digunakan oleh tim atau siswa lainnya.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
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

    .fs-7 { font-size: 0.875rem; line-height: 1.4; }
    .fs-8 { font-size: 0.75rem; }
    .tracking-wider { letter-spacing: 0.06em; }
</style>
@endsection