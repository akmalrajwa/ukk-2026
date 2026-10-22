@extends('layouts.app')

@section('title', config('app.name') . ' — Pantau Pengembalian')

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
                            <i class="bi bi-shield-check me-1"></i> Operasional Pengembalian
                        </span>
                    </div>
                    <h3 class="fw-bold mb-1 text-white">Pantau Pengembalian Alat</h3>
                    <p class="text-white-50 small mb-0" style="max-width: 620px;">
                        Pencatatan kondisi fisik instrumen musik, riwayat pengembalian, dan cetak laporan inventaris secara berkala.
                    </p>
                </div>
                
                <!-- Action Buttons -->
                <div class="flex-shrink-0 d-flex align-items-center gap-2">
                    <a href="{{ route('petugas.pengembalian.cetak') }}" target="_blank" class="btn btn-light text-danger px-3 py-2 rounded-3 fw-semibold shadow-sm small d-inline-flex align-items-center gap-1.5">
                        <i class="bi bi-printer me-1"></i>
                        <span>Cetak Laporan</span>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Tabel Data Pengembalian -->
    <div class="card border-0 shadow-sm rounded-4 overflow-hidden bg-body">
        <div class="card-header bg-body border-bottom py-3 px-4">
            <div class="d-flex align-items-center gap-2">
                <i class="bi bi-arrow-return-left text-danger fs-5"></i>
                <div>
                    <h6 class="card-title mb-0 fw-semibold text-body-emphasis">Riwayat Instrumen Dikembalikan</h6>
                    <span class="text-secondary small">Daftar pengembalian alat musik yang tercatat dalam sistem</span>
                </div>
            </div>
        </div>

        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="bg-body-tertiary border-bottom text-secondary text-uppercase small tracking-wider">
                        <tr>
                            <th class="py-3 px-4 text-center" style="width: 5%;">NO</th>
                            <th class="py-3 px-3">PEMINJAM</th>
                            <th class="py-3 px-3">INSTRUMEN / ALAT</th>
                            <th class="py-3 px-3">TGL PINJAM</th>
                            <th class="py-3 px-3">TGL KEMBALI</th>
                            <th class="py-3 px-3">KONDISI</th>
                            <th class="py-3 px-3">TERLAMBAT</th>
                            <th class="py-3 px-3">DENDA</th>
                            <th class="py-3 px-4 text-center" style="width: 150px;">STATUS</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($datap as $index => $item)
                            @php
                                $peminjaman = $peminjamanList[$item->id_peminjaman] ?? null;
                                $namaUser = $peminjaman ? ($userList[$peminjaman->id_user] ?? 'Tidak diketahui') : 'Tidak diketahui';
                                $namaAlat = $peminjaman ? ($alatList[$peminjaman->id_alat] ?? 'Alat dihapus') : 'Alat dihapus';
                                $tglPinjam = ($peminjaman && !empty($peminjaman->tanggal_pinjam)) ? date('d M Y', strtotime($peminjaman->tanggal_pinjam)) : '-';
                                $no = method_exists($datap, 'firstItem') ? $datap->firstItem() + $index : $index + 1;
                            @endphp
                            <tr>
                                <td class="px-4 text-center text-secondary fw-medium small">{{ $no }}</td>
                                <td class="px-3">
                                    <div class="fw-bold text-body-emphasis small text-uppercase">{{ $namaUser }}</div>
                                </td>
                                <td class="px-3">
                                    <div class="fw-semibold text-body-emphasis small">
                                        <i class="bi bi-disc text-danger me-1.5"></i>{{ $namaAlat }}
                                    </div>
                                </td>
                                <td class="px-3 text-secondary small">{{ $tglPinjam }}</td>
                                <td class="px-3 text-secondary small">{{ date('d M Y', strtotime($item->tanggal_pengembalian)) }}</td>
                                <td class="px-3">
                                    @if(strtolower($item->kondisi_barang) == 'baik')
                                        <span class="badge bg-success-subtle text-success border border-success-subtle px-2.5 py-1.5 rounded-2 small fw-semibold">Baik</span>
                                    @elseif(strtolower($item->kondisi_barang) == 'ringan rusak' || strtolower($item->kondisi_barang) == 'rusak ringan')
                                        <span class="badge bg-warning-subtle text-warning-emphasis border border-warning-subtle px-2.5 py-1.5 rounded-2 small fw-semibold">Rusak Ringan</span>
                                    @else
                                        <span class="badge bg-danger-subtle text-danger border border-danger-subtle px-2.5 py-1.5 rounded-2 small fw-semibold">{{ $item->kondisi_barang ?? 'Rusak' }}</span>
                                    @endif
                                </td>
                                <td class="px-3">
                                    @if(($item->terlambat_hari ?? 0) > 0)
                                        <span class="badge bg-danger-subtle text-danger border border-danger-subtle px-2.5 py-1.5 rounded-2 small fw-semibold">{{ $item->terlambat_hari }} Hari</span>
                                    @else
                                        <span class="badge bg-success-subtle text-success border border-success-subtle px-2.5 py-1.5 rounded-2 small fw-semibold">Tepat Waktu</span>
                                    @endif
                                </td>
                                <td class="px-3 small fw-semibold {{ ($item->denda ?? 0) > 0 ? 'text-danger' : 'text-secondary' }}">Rp {{ number_format($item->denda ?? 0, 0, ',', '.') }}</td>
                                <td class="px-4 text-center">
                                    <span class="badge bg-success-subtle text-success border border-success-subtle rounded-pill px-3 py-1.5 small fw-semibold">
                                        <i class="bi bi-check2-all me-1"></i> Selesai
                                    </span>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="9" class="text-center py-5 text-secondary">
                                    <div class="d-flex flex-column align-items-center gap-2">
                                        <i class="bi bi-inbox fs-1 opacity-50 text-secondary"></i>
                                        <span class="small fw-medium">Belum ada data pengembalian alat musik yang dicatat.</span>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            
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