@extends('layouts.app')

@section('title', config('app.name') . ' — Katalog Alat Musik')

@section('content')
<div class="container-fluid py-4 px-3 px-md-4">

    <!-- 🌟 BANNER HEADER KATALOG ALAT MUSIK -->
    <div class="card border-0 shadow-sm rounded-4 overflow-hidden mb-4 text-white position-relative"
         style="background: linear-gradient(135deg, #a71d2a 0%, #dc3545 50%, #78101a 100%);">
        
        <div class="banner-pattern"></div>
        <div class="banner-glow-red"></div>

        <div class="card-body p-4 p-md-5 position-relative z-1">
            <div class="row align-items-center justify-content-between g-4">
                
                <div class="col-lg-7">
                    <div class="d-flex align-items-center gap-2 mb-3">
                        <span class="badge rounded-pill px-3 py-1.5 fw-semibold small text-uppercase tracking-wider" 
                              style="background-color: rgba(255, 255, 255, 0.2); color: #ffffff; border: 1px solid rgba(255, 255, 255, 0.3);">
                            <i class="bi bi-music-note-list me-1"></i> Inventaris Alat Musik
                        </span>
                    </div>
                    
                    <h1 class="fw-bold mb-2 tracking-tight text-white display-6">
                        Daftar Alat Musik 🥁
                    </h1>
                    <p class="text-white-50 mb-0 col-lg-10" style="font-size: 0.95rem;">
                        Pilih instrumen musik, peralatan sound system, atau perangkat studio yang Anda butuhkan untuk sesi latihan atau pementasan.
                    </p>
                </div>

                <!-- Form Pencarian Alat Musik -->
                <div class="col-lg-5">
                    <form action="{{ route('peminjam.alat') }}" method="GET" class="card bg-white bg-opacity-10 border border-white border-opacity-20 p-3 rounded-4 backdrop-blur shadow-sm">
                        <label class="form-label text-white fw-semibold fs-8 mb-2 tracking-wider text-uppercase">Cari Alat Musik</label>
                        <div class="input-group">
                            <input type="text" name="q" class="form-control bg-white border-0 text-dark fs-7 shadow-none" placeholder="Cari gitar, drum, keyboard, amp..." value="{{ request('q') }}">
                            <button class="btn btn-brand fw-medium px-4 shadow-none" type="submit">
                                <i class="bi bi-search"></i> Cari
                            </button>
                        </div>
                        @if(request('q'))
                            <div class="d-flex justify-content-between align-items-center mt-2 pt-2 border-top border-white border-opacity-10">
                                <span class="fs-8 text-white-50">Filter: "{{ request('q') }}"</span>
                                <a href="{{ route('peminjam.alat') }}" class="fs-8 text-white text-decoration-underline">Reset Filter</a>
                            </div>
                        @endif
                    </form>
                </div>

            </div>
        </div>
    </div>

    @php
        $rawAlats = $alats ?? $alat ?? [];
        $searchQuery = trim(request('q') ?? '');

        $filteredAlats = [];
        foreach ($rawAlats as $item) {
            $namaAlat = $item->nama_alat ?? $item->nama ?? $item->name ?? '';
            $kodeAlat = $item->kode_alat ?? $item->kode ?? '';

            if (!empty($searchQuery)) {
                if (stripos($namaAlat, $searchQuery) !== false || stripos($kodeAlat, $searchQuery) !== false) {
                    $filteredAlats[] = $item;
                }
            } else {
                $filteredAlats[] = $item;
            }
        }
    @endphp

    <div class="d-flex justify-content-between align-items-center mb-3 px-1">
        <span class="text-secondary fs-8 fw-medium">
            Tersedia total <strong class="text-body-emphasis">{{ count($filteredAlats) }}</strong> instrumen musik dalam studio
        </span>
    </div>

    <!-- 📦 GRID DAFTAR ALAT MUSIK -->
    <div class="row g-3 mb-4">
        @forelse($filteredAlats as $item)
            @php
                $namaKategori = $kategoriMap[$item->id_kategori] ?? 'Musik';
                $alatId       = $item->id_alat ?? $item->id;
                $namaAlat     = $item->nama_alat ?? $item->nama ?? $item->name ?? 'Instrumen #' . $alatId;
                $kodeAlat     = $item->kode_alat ?? $item->kode ?? 'MSK';
                $stokAlat     = $item->stok ?? $item->jumlah ?? null;
            @endphp
            <div class="col-12 col-sm-6 col-lg-4 col-xl-3">
                <div class="card h-100 border-0 shadow-sm rounded-4 bg-body alat-card position-relative overflow-hidden">
                    
                    <!-- Garis Aksen Merah Card -->
                    <div class="card-top-accent bg-danger"></div>

                    <div class="card-body d-flex flex-column justify-content-between p-4">
                        <div>
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <span class="badge bg-danger-subtle text-danger border border-danger-subtle px-2.5 py-1 rounded-pill fw-semibold fs-8">
                                    <i class="bi bi-tag-fill me-1"></i> {{ $kodeAlat }}
                                </span>
                                <span class="badge bg-secondary-subtle text-secondary px-2.5 py-1 rounded-pill fs-8">
                                    {{ $namaKategori }}
                                </span>
                            </div>

                            <div class="d-flex align-items-start gap-3 mb-3">
                                <div class="alat-icon-box bg-danger-subtle text-danger flex-shrink-0 shadow-sm">
                                    <i class="bi bi-music-note-beamed"></i>
                                </div>
                                <div>
                                    <h5 class="fw-bold fs-6 mb-1 text-body-emphasis line-clamp-2">
                                        {{ $namaAlat }}
                                    </h5>
                                    @if(isset($stokAlat))
                                        <small class="text-secondary fs-8">Stok Tersedia: <strong class="text-body-emphasis">{{ $stokAlat }} unit</strong></small>
                                    @else
                                        <small class="text-success fs-8"><i class="bi bi-check-circle-fill me-1"></i> Status: Siap Dipinjam</small>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="mt-3 pt-3 border-top border-translucent">
                            <a href="{{ route('peminjam.createPeminjam') . '?id_alat=' . $alatId }}" 
                               class="btn btn-brand w-100 rounded-3 py-2 fw-medium shadow-sm d-flex align-items-center justify-content-center gap-2 hover-lift">
                                <i class="bi bi-plus-circle fs-6"></i>
                                <span>Ajukan Pinjam</span>
                            </a>
                        </div>

                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="card border-0 shadow-sm rounded-4 p-5 text-center bg-body">
                    <div class="py-4">
                        <div class="display-4 text-secondary mb-3 opacity-50">
                            <i class="bi bi-music-note-slash"></i>
                        </div>
                        <h5 class="fw-bold text-body-emphasis mb-1">Instrumen Musik Tidak Ditemukan</h5>
                        <p class="text-secondary fs-8 mb-3">Pencarian "{{ request('q') }}" tidak cocok dengan instrumen musik yang ada.</p>
                        <a href="{{ route('peminjam.alat') }}" class="btn btn-outline-secondary fw-medium rounded-3 px-4">
                            Lihat Semua Alat Musik
                        </a>
                    </div>
                </div>
            </div>
        @endforelse
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
        width: 260px; height: 260px;
        background: rgba(220, 53, 69, 0.3);
        filter: blur(65px);
        border-radius: 50%;
        pointer-events: none;
    }

    .backdrop-blur {
        backdrop-filter: blur(8px);
        -webkit-backdrop-filter: blur(8px);
    }

    .alat-card {
        border: 1px solid var(--bs-border-color-translucent) !important;
        transition: all 0.25s ease;
    }

    .alat-card:hover {
        transform: translateY(-4px);
        border-color: #dc3545 !important;
        box-shadow: 0 0.75rem 1.5rem rgba(220, 53, 69, 0.15) !important;
    }

    .card-top-accent {
        height: 3px;
        width: 100%;
    }

    .alat-icon-box {
        width: 44px;
        height: 44px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.25rem;
    }

    .line-clamp-2 {
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    .hover-lift {
        transition: transform 0.2s ease, box-shadow 0.2s ease;
    }
    .hover-lift:hover {
        transform: translateY(-2px);
    }

    .fs-7 { font-size: 0.875rem; }
    .fs-8 { font-size: 0.75rem; }
    .fs-9 { font-size: 0.65rem; }
    .tracking-wider { letter-spacing: 0.05em; }

    @keyframes pulseAnimation {
        0% { opacity: 1; transform: scale(1); }
        50% { opacity: 0.4; transform: scale(1.2); }
        100% { opacity: 1; transform: scale(1); }
    }
    .animate-pulse {
        animation: pulseAnimation 2s infinite ease-in-out;
    }
</style>
@endsection