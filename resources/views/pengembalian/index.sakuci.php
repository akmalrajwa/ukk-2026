@extends('layouts.app')

@section('title', config('app.name') . ' — Data Pengembalian')

@section('content')
<div class="container-fluid py-4 px-3 px-md-4">

    <!-- Flash Alert -->
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm rounded-3 mb-4 d-flex align-items-center" role="alert">
            <i class="bi bi-check-circle-fill me-2 fs-5"></i>
            <div class="small fw-medium">{{ session('success') }}</div>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <!-- Banner Utama Red Crimson -->
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
                            <i class="bi bi-arrow-down-left-circle me-1"></i> Transaksi Pengembalian
                        </span>
                    </div>
                    <h3 class="fw-bold mb-1 text-white">Daftar Pengembalian</h3>
                    <p class="text-white-50 small mb-0" style="max-width: 620px;">
                        Riwayat dan proses pengembalian instrumen yang dipinjam beserta pencatatan kondisi fisik dan denda.
                    </p>
                </div>
                
                <!-- Action Buttons -->
                <div class="flex-shrink-0 d-flex align-items-center gap-2">
                    <a href="/admin/pengembalian/create" class="btn btn-light text-danger px-3 py-2 rounded-3 fw-semibold shadow-sm small d-inline-flex align-items-center gap-1.5">
                        <i class="bi bi-plus-lg"></i>
                        <span>Tambah Pengembalian</span>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Card Data Tabel Pengembalian -->
    <div class="card border-0 shadow-sm rounded-4 overflow-hidden bg-body">
        <div class="card-header bg-body border-bottom py-3 px-4">
            <div class="d-flex align-items-center gap-2">
                <i class="bi bi-arrow-down-left-circle text-danger fs-5"></i>
                <div>
                    <h6 class="card-title mb-0 fw-semibold text-body-emphasis">Data Pengembalian</h6>
                    <span class="text-secondary small">Daftar seluruh riwayat pengembalian alat dan kondisinya</span>
                </div>
            </div>
        </div>

        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="bg-body-tertiary border-bottom text-secondary text-uppercase small tracking-wider">
                        <tr>
                            <th class="py-3 px-4 text-center" style="width: 5%;">NO</th>
                            <th class="py-3 px-3">PEMINJAM &amp; ALAT</th>
                            <th class="py-3 px-3">TGL PENGEMBALIAN</th>
                            <th class="py-3 px-3">TERLAMBAT</th>
                            <th class="py-3 px-3">DENDA</th>
                            <th class="py-3 px-3">KONDISI BARANG</th>
                            <th class="py-3 px-3">CATATAN</th>
                            <th class="py-3 px-4 text-center" style="width: 180px;">AKSI</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $no = method_exists($datap, 'firstItem') ? $datap->firstItem() : 1;
                        @endphp

                        @forelse($datap as $index => $d)
                            @php
                                $p = $peminjamanList[$d->id_peminjaman] ?? null;
                                $uname = $p ? ($userList[$p->id_user] ?? '-') : '-';
                                $alatName = $p ? ($alatList[$p->id_alat] ?? '-') : '-';

                                $kondisi = $d->kondisi_barang ?? 'Baik';
                                $badgeKondisi = match($kondisi) {
                                    'Baik' => 'bg-success-subtle text-success border border-success-subtle',
                                    'Rusak Ringan' => 'bg-warning-subtle text-warning-emphasis border border-warning-subtle',
                                    'Rusak Berat', 'Hilang' => 'bg-danger-subtle text-danger border border-danger-subtle',
                                    default => 'bg-secondary-subtle text-secondary border border-secondary-subtle'
                                };
                            @endphp
                            <tr>
                                <td class="px-4 text-center text-secondary fw-medium small">
                                    {{ method_exists($datap, 'firstItem') ? $no++ : $index + 1 }}
                                </td>
                                
                                <td class="px-3">
                                    <div class="fw-bold text-body-emphasis small text-uppercase">{{ $uname }}</div>
                                    <div class="small text-secondary mt-0.5">
                                        <i class="bi bi-disc text-danger me-1"></i>{{ $alatName }} 
                                        <span class="badge bg-body-secondary text-body-emphasis border font-monospace ms-1">#{{ $d->id_peminjaman }}</span>
                                    </div>
                                </td>

                                <td class="px-3">
                                    <span class="text-secondary small">{{ date('d M Y', strtotime($d->tanggal_pengembalian)) }}</span>
                                </td>

                                <td class="px-3">
                                    @if($d->terlambat_hari > 0)
                                        <span class="badge bg-danger-subtle text-danger border border-danger-subtle rounded-2 px-2.5 py-1.5 small fw-semibold">
                                            {{ $d->terlambat_hari }} Hari
                                        </span>
                                    @else
                                        <span class="badge bg-success-subtle text-success border border-success-subtle rounded-2 px-2.5 py-1.5 small fw-semibold">
                                            Tepat Waktu
                                        </span>
                                    @endif
                                </td>

                                <td class="px-3">
                                    <span class="badge bg-danger-subtle text-danger border border-danger-subtle px-2.5 py-1.5 rounded-2 small fw-semibold">
                                        Rp {{ number_format($d->denda ?? 0, 0, ',', '.') }}
                                    </span>
                                </td>

                                <td class="px-3">
                                    <span class="badge {{ $badgeKondisi }} px-2.5 py-1.5 rounded-2 small fw-semibold">
                                        {{ $kondisi }}
                                    </span>
                                </td>

                                <td class="px-3">
                                    <span class="text-secondary small">{{ $d->catatan ?? '-' }}</span>
                                </td>

                                <td class="px-4 text-center">
                                    <div class="d-inline-flex align-items-center justify-content-center gap-2">
                                        <a href="{{ route('pengembalian.edit', [$d->id_pengembalian]) }}" 
                                           class="btn btn-sm btn-outline-primary px-2.5 py-1 rounded-2 fw-medium small d-inline-flex align-items-center gap-1" 
                                           title="Edit Data">
                                            <i class="bi bi-pencil"></i> Edit
                                        </a>

                                        <form action="{{ route('pengembalian.delete', [$d->id_pengembalian]) }}" 
                                              method="POST" 
                                              class="d-inline m-0" 
                                              onsubmit="return confirm('Apakah Anda yakin ingin menghapus data pengembalian ini?')">
                                            @csrf
                                            <button type="submit" 
                                                    class="btn btn-sm btn-outline-danger px-2.5 py-1 rounded-2 fw-medium small d-inline-flex align-items-center gap-1" 
                                                    title="Delete Data">
                                                <i class="bi bi-trash"></i> Hapus
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center py-5 text-secondary">
                                    <div class="d-flex flex-column align-items-center gap-2">
                                        <i class="bi bi-inbox fs-1 opacity-50 text-secondary"></i>
                                        <span class="small fw-medium">Belum ada data pengembalian alat yang ditambahkan.</span>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
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