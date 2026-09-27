@extends('layouts.app')

@section('title', config('app.name') . ' -- Aplikasi Peminjaman Alat')

@section('content')

    {{-- Hero --}}
    <section class="hero-section position-relative overflow-hidden rounded-4 mb-5 p-4 p-lg-5">
        <div class="row align-items-center g-5 position-relative">
            <div class="col-lg-7 text-center text-lg-start">
                <span class="badge rounded-pill badge-brand px-3 py-2 mb-3">sakuci</span>

                <h1 class="display-5 fw-bold mb-3">
                    Pinjam &amp; Kembalikan
                    <span class="text-brand">Alat Sekolah</span><br class="d-none d-md-inline">
                    dengan Mudah dan Cepat
                </h1>

                <p class="lead text-secondary mx-auto mx-lg-0 mb-4" style="max-width: 560px;">
                    Sistem sederhana untuk memudahkan proses peminjaman dan pengembalian alat sekolah.
                </p>

                <div class="d-flex flex-wrap gap-2 justify-content-center justify-content-lg-start mb-4">
                    <a class="btn btn-brand btn-lg px-4" href="{{ route('login') }}">Masuk</a>

                </div>

                <div class="d-flex flex-wrap gap-4 justify-content-center justify-content-lg-start hero-trust">
                    <div class="d-flex align-items-center gap-2">
                        <span class="hero-trust-icon">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none"><path d="M20 6 9 17l-5-5" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
                        </span>
                        <span class="small text-secondary">Pencatatan real-time</span>
                    </div>
                    <div class="d-flex align-items-center gap-2">
                        <span class="hero-trust-icon">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none"><path d="M20 6 9 17l-5-5" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
                        </span>
                        <span class="small text-secondary">Riwayat lengkap</span>
                    </div>
                    <div class="d-flex align-items-center gap-2">
                        <span class="hero-trust-icon">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none"><path d="M20 6 9 17l-5-5" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
                        </span>
                        <span class="small text-secondary">Mudah dipantau admin</span>
                    </div>
                </div>
            </div>

            <div class="col-lg-5">
                <div class="highlight-panel mx-auto" style="max-width: 380px;">
                    <div class="highlight-panel-decor-1" aria-hidden="true"></div>
                    <div class="highlight-panel-decor-2" aria-hidden="true"></div>
                    <div class="highlight-panel-main">
                        <div class="row row-cols-2 g-3 text-center">
                            <div class="col">
                                <span class="stat-icon mx-auto mb-2">
                                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none"><path d="M21 8 12 3 3 8l9 5 9-5Z" stroke="currentColor" stroke-width="1.6" stroke-linejoin="round"/><path d="M3 8v8l9 5 9-5V8" stroke="currentColor" stroke-width="1.6" stroke-linejoin="round"/></svg>
                                </span>
                                <div class="h4 fw-bold mb-0 text-brand">{{ $totalAlat ?? '5' }}</div>
                                <div class="text-secondary small">Total Alat</div>
                            </div>
                            <div class="col">
                                <span class="stat-icon mx-auto mb-2">
                                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none"><path d="M3 7a2 2 0 0 1 2-2h5l2 2h7a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V7Z" stroke="currentColor" stroke-width="1.6" stroke-linejoin="round"/></svg>
                                </span>
                                <div class="h4 fw-bold mb-0 text-brand">{{ $totalKategori ?? '4' }}</div>
                                <div class="text-secondary small">Kategori</div>
                            </div>
                            <div class="col">
                                <span class="stat-icon mx-auto mb-2">
                                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none"><path d="M20 6 9 17l-5-5" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                                </span>
                                <div class="h4 fw-bold mb-0 text-brand">{{ $alatTersedia ?? '5' }}</div>
                                <div class="text-secondary small">Tersedia</div>
                            </div>
                            <div class="col">
                                <span class="stat-icon mx-auto mb-2">
                                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none"><circle cx="12" cy="12" r="8" stroke="currentColor" stroke-width="1.6"/><path d="M12 8v4l3 2" stroke="currentColor" stroke-width="1.6" stroke-linecap="round"/></svg>
                                </span>
                                <div class="h4 fw-bold mb-0 text-brand">{{ $sedangDipinjam ?? '2' }}</div>
                                <div class="text-secondary small">Dipinjam</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Cara Kerja --}}
    <section class="mb-5">
        <h2 class="h5 fw-semibold text-center mb-4">Cara Kerja</h2>

        <div class="row row-cols-1 row-cols-md-3 g-4 text-center">
            <div class="col">
                <div class="card border-0 shadow-sm h-100 hover-lift">
                    <div class="card-body p-4">
                        <div class="step-icon mx-auto mb-3">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none"><circle cx="11" cy="11" r="7" stroke="currentColor" stroke-width="1.8"/><path d="m20 20-3.5-3.5" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/></svg>
                        </div>
                        <h3 class="h6 fw-semibold mb-2">Cari Alat</h3>
                        <p class="text-secondary small mb-0">Lihat daftar alat yang tersedia beserta detail dan stoknya.</p>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card border-0 shadow-sm h-100 hover-lift">
                    <div class="card-body p-4">
                        <div class="step-icon mx-auto mb-3">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none"><path d="M9 12h6M9 16h6M9 8h6" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/><rect x="5" y="4" width="14" height="17" rx="2" stroke="currentColor" stroke-width="1.8"/></svg>
                        </div>
                        <h3 class="h6 fw-semibold mb-2">Ajukan Peminjaman</h3>
                        <p class="text-secondary small mb-0">Pilih alat yang dibutuhkan lalu ajukan peminjaman langsung dari sistem.</p>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card border-0 shadow-sm h-100 hover-lift">
                    <div class="card-body p-4">
                        <div class="step-icon mx-auto mb-3">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none"><path d="M20 6 9 17l-5-5" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                        </div>
                        <h3 class="h6 fw-semibold mb-2">Ambil &amp; Kembalikan</h3>
                        <p class="text-secondary small mb-0">Ambil alat sesuai jadwal, lalu kembalikan dan catat otomatis tersimpan.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection