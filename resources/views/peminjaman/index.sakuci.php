@extends('layouts.app')

@section('title', config('app.name') . ' — Daftar Peminjaman')

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
                            <i class="bi bi-arrow-up-right-circle me-1"></i> Transaksi Peminjaman
                        </span>
                    </div>
                    <h3 class="fw-bold mb-1 text-white">Daftar Peminjaman</h3>
                    <p class="text-white-50 small mb-0" style="max-width: 620px;">
                        Kelola dan pantau seluruh transaksi peminjaman alat musik sekolah secara terpusat.
                    </p>
                </div>
                
                <!-- Action Buttons -->
                <div class="flex-shrink-0 d-flex align-items-center gap-2">
                    <a href="/admin/peminjaman/create" class="btn btn-light text-danger px-3 py-2 rounded-3 fw-semibold shadow-sm small d-inline-flex align-items-center gap-1.5">
                        <i class="bi bi-plus-lg"></i>
                        <span>Tambah Peminjaman</span>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Card Data Tabel Peminjaman -->
    <div class="card border-0 shadow-sm rounded-4 overflow-hidden bg-body">
        <!-- Header Card -->
        <div class="card-header bg-body border-bottom py-3 px-4">
            <div class="d-flex align-items-center gap-2">
                <i class="bi bi-arrow-up-right-circle text-danger fs-5"></i>
                <div>
                    <h6 class="card-title mb-0 fw-semibold text-body-emphasis">Data Peminjaman</h6>
                    <span class="text-secondary small">Daftar riwayat dan status transaksi peminjaman alat</span>
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
                            <th class="py-3 px-3">NAMA ALAT</th>
                            <th class="py-3 px-3">JUMLAH</th>
                            <th class="py-3 px-3">TGL PINJAM</th>
                            <th class="py-3 px-3">TGL KEMBALI</th>
                            <th class="py-3 px-3">STATUS</th>
                            <th class="py-3 px-3">DENDA</th>
                            <th class="py-3 px-4 text-center" style="width: 180px;">AKSI</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $no = method_exists($datap, 'firstItem') ? $datap->firstItem() : 1;
                        @endphp

                        @forelse ($datap as $peminjaman)
                        @php
                            $userIdVal = $peminjaman->id_user ?? $peminjaman->user_id ?? null;
                            $userObj = $peminjaman->user ?? ($userIdVal ? \App\Models\User::find($userIdVal) : null);
                            $namaUserFinal = $userObj->name ?? $userObj->nama ?? $userObj->username ?? $userObj->email ?? ($userIdVal ? 'User #' . $userIdVal : 'Tanpa Nama');

                            $alatIdVal = $peminjaman->id_alat ?? $peminjaman->alat_id ?? null;
                            $alatObj = $peminjaman->alat ?? ($alatIdVal ? \App\Models\Alat::find($alatIdVal) : null);
                            $namaAlatFinal = $alatObj->nama_alat ?? $alatObj->nama ?? $alatObj->name ?? ($alatIdVal ? 'Alat #' . $alatIdVal : 'Alat Tidak Diketahui');
                        @endphp
                        <tr>
                            <!-- NO -->
                            <td class="px-4 text-center text-secondary fw-medium small">
                                {{ $no++ }}
                            </td>
                            
                            <!-- PEMINJAM -->
                            <td class="px-3">
                                <div class="fw-bold text-body-emphasis small text-uppercase">
                                    <i class="bi bi-person me-1"></i>{{ $namaUserFinal }}
                                </div>
                            </td>

                            <!-- NAMA ALAT -->
                            <td class="px-3">
                                <div class="fw-semibold text-body-emphasis small">
                                    <i class="bi bi-disc text-danger me-1"></i>{{ $namaAlatFinal }}
                                </div>
                            </td>

                            <!-- JUMLAH -->
                            <td class="px-3">
                                <span class="badge bg-body-secondary text-body-emphasis border font-monospace fw-semibold px-2.5 py-1.5 rounded-2 small">
                                    {{ $peminjaman->jumlah }} Unit
                                </span>
                            </td>

                            <!-- TGL PINJAM -->
                            <td class="px-3">
                                <span class="text-secondary small">{{ $peminjaman->tanggal_pinjam }}</span>
                            </td>

                            <!-- TGL KEMBALI -->
                            <td class="px-3">
                                <span class="text-secondary small">{{ $peminjaman->tanggal_kembali ?? '-' }}</span>
                            </td>

                            <!-- STATUS -->
                            <td class="px-3">
                                @if($peminjaman->status == 'Pending')
                                    <span class="badge bg-warning-subtle text-warning-emphasis border border-warning-subtle fw-semibold px-2.5 py-1.5 rounded-2 small">Pending</span>
                                @elseif($peminjaman->status == 'Disetujui')
                                    <span class="badge bg-info-subtle text-info-emphasis border border-info-subtle fw-semibold px-2.5 py-1.5 rounded-2 small">Disetujui</span>
                                @elseif($peminjaman->status == 'Ditolak')
                                    <span class="badge bg-danger-subtle text-danger-emphasis border border-danger-subtle fw-semibold px-2.5 py-1.5 rounded-2 small">Ditolak</span>
                                @else
                                    <span class="badge bg-success-subtle text-success border border-success-subtle fw-semibold px-2.5 py-1.5 rounded-2 small">Dikembalikan</span>
                                @endif
                            </td>

                            <!-- DENDA -->
                            <td class="px-3">
                                <span class="badge bg-danger-subtle text-danger border border-danger-subtle px-2.5 py-1.5 rounded-2 small fw-semibold">
                                    Rp {{ number_format($peminjaman->denda ?? 0, 0, ',', '.') }}
                                </span>
                            </td>

                            <!-- AKSI -->
                            <td class="px-4 text-center">
                                <div class="d-inline-flex align-items-center justify-content-center gap-2">
                                    <!-- Tombol Edit -->
                                    <a href="{{ route('peminjaman.edit', ['id_peminjaman' => $peminjaman->id_peminjaman]) }}" 
                                       class="btn btn-sm btn-outline-primary px-2.5 py-1 rounded-2 fw-medium small d-inline-flex align-items-center gap-1" 
                                       title="Edit Data">
                                        <i class="bi bi-pencil"></i> Edit
                                    </a>

                                    <!-- Tombol Hapus -->
                                    <form action="{{ route('peminjaman.delete', ['id_peminjaman' => $peminjaman->id_peminjaman]) }}" 
                                          method="POST" 
                                          class="d-inline m-0" 
                                          onsubmit="return confirm('Apakah Anda yakin ingin menghapus data peminjaman ini?')">
                                        @csrf
                                        @method('POST')
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
                            <td colspan="9" class="text-center py-5 text-secondary">
                                <div class="d-flex flex-column align-items-center gap-2">
                                    <i class="bi bi-inbox fs-1 opacity-50 text-secondary"></i>
                                    <span class="small fw-medium">Belum ada data peminjaman alat yang ditambahkan.</span>
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