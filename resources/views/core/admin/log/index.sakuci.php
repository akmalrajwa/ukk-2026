@extends('layouts.app')

@section('title', config('app.name') . ' — Log Aktivitas')

@section('content')
<div class="container-fluid py-4 px-3 px-md-4">
    
    <!-- Banner Utama Red Crimson Sakuci -->
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
                            <i class="bi bi-shield-check me-1"></i> Log Sistem
                        </span>
                    </div>
                    <h3 class="fw-bold mb-1 text-white">Log Aktivitas</h3>
                    <p class="text-white-50 small mb-0" style="max-width: 620px;">
                        Pusat kendali rekapitulasi tindakan dan riwayat perubahan data oleh Admin, Petugas, maupun Peminjam secara transparan.
                    </p>
                </div>
                
                <!-- Tombol Beranda -->
                <div class="flex-shrink-0 d-flex align-items-center gap-2">
                    <a href="{{ route('admin.dashboard') }}" class="btn btn-outline-light px-3 py-2 rounded-3 fw-medium small backdrop-blur d-inline-flex align-items-center gap-1.5">
                        <i class="bi bi-house-door"></i>
                        <span>Beranda</span>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Card Pembungkus Tabel yang Seragam -->
    <div class="card border-0 shadow-sm rounded-4 overflow-hidden bg-body">
        <div class="card-header bg-body border-bottom py-3 px-4">
            <div class="d-flex align-items-center gap-2">
                <i class="bi bi-clock-history text-danger fs-5"></i>
                <div>
                    <h6 class="card-title mb-0 fw-semibold text-body-emphasis">Riwayat Aktivitas Terakhir</h6>
                    <span class="text-secondary small">Daftar tindakan dan perubahan data oleh Admin / Petugas / Peminjam</span>
                </div>
            </div>
        </div>

        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="bg-body-tertiary border-bottom text-secondary text-uppercase small tracking-wider">
                        <tr>
                            <th class="py-3 px-4 text-center" style="width: 5%;">NO</th>
                            <th class="py-3 px-3">ADMIN / PEMINJAM / PETUGAS</th>
                            <th class="py-3 px-3">AKTIVITAS / KETERANGAN</th>
                            <th class="py-3 px-4" style="width: 25%;">WAKTU KEJADIAN</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $no = method_exists($datap, 'firstItem') ? $datap->firstItem() : 1;
                        @endphp

                        @forelse ($datap as $index => $log)
                        @php
                            // Mengambil nama user secara aman berdasarkan id_user
                            $userIdVal = $log->id_user ?? null;
                            $userObj = $userIdVal ? \App\Models\User::find($userIdVal) : null;
                            $namaUser = $userObj->name ?? $userObj->nama ?? $userObj->username ?? ('User ID: ' . ($userIdVal ?? 'Sistem'));
                        @endphp
                        <tr>
                            <td class="px-4 text-center text-secondary fw-medium small">
                                {{ method_exists($datap, 'firstItem') ? $no++ : $index + 1 }}
                            </td>
                            
                            <td class="px-3">
                                <div class="fw-bold text-body-emphasis small text-uppercase">
                                    <i class="bi bi-person-badge text-danger me-1.5"></i> {{ $namaUser }}
                                </div>
                            </td>

                            <td class="px-3">
                                <span class="text-body-emphasis small">{{ $log->aktifitas ?? '-' }}</span>
                            </td>

                            <td class="px-4">
                                <span class="badge bg-body-secondary text-body-emphasis border font-monospace fw-semibold px-2.5 py-1.5 rounded-2 small">
                                    <i class="bi bi-clock me-1 text-danger"></i> {{ $log->created_at ?? '-' }}
                                </span>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="text-center py-5 text-secondary">
                                <div class="d-flex flex-column align-items-center gap-2">
                                    <i class="bi bi-journal-x fs-1 opacity-50 text-secondary"></i>
                                    <span class="small fw-medium">Belum ada catatan log aktivitas yang terekam.</span>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        
        <!-- Bagian Pagination -->
        @if(method_exists($datap, 'hasPages') && $datap->hasPages())
        <div class="card-footer bg-body border-top py-3 px-4 d-flex justify-content-between align-items-center">
            <div class="small text-secondary">
                Menampilkan {{ $datap->firstItem() }} sampai {{ $datap->lastItem() }} dari {{ $datap->total() }} data
            </div>
            <div>
                {!! $datap->links() !!}
            </div>
        </div>
        @endif
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

    .tracking-wider { letter-spacing: 0.06em; }
</style>
@endsection