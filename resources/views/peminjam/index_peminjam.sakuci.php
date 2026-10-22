@extends('layouts.app')

@section('title', config('app.name') . ' — Riwayat Peminjaman Alat Musik')

@section('content')
<div class="container-fluid py-4 px-3 px-md-4">
    
    <!-- Header Halaman -->
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center mb-4 gap-3">
        <div>
            <h3 class="fw-bold mb-1 tracking-tight text-body-emphasis">Data Pengajuan Alat Musik</h3>
            <p class="text-secondary small mb-0">Riwayat permohonan pinjam alat musik & studio Anda.</p>
        </div>
        <a href="{{ route('peminjam.createPeminjam') }}" class="btn text-white btn-sm px-3 py-2 rounded-3 shadow-sm d-inline-flex align-items-center gap-2" style="background-color: #dc3545 ;">
            <i class="bi bi-plus-lg"></i>
            <span class="fw-medium">Pinjam Alat Musik Baru</span>
        </a>
    </div>

    <!-- Card Pembungkus Tabel -->
    <div class="card border-0 shadow-sm rounded-4 overflow-hidden bg-body">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="bg-body-tertiary border-bottom text-secondary text-uppercase fs-8 tracking-wider">
                        <tr>
                            <th class="py-3 px-4 text-center" style="width: 5%;">No</th>
                            <th class="py-3 px-3">Instrumen Musik</th>
                            <th class="py-3 px-3">Jumlah</th>
                            <th class="py-3 px-3">Tgl Pinjam</th>
                            <th class="py-3 px-3">Tgl Kembali</th>
                            <th class="py-3 px-3">Status</th>
                            <th class="py-3 px-3">Denda</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $no = 1; @endphp
                        @forelse ($datap as $peminjaman)
                        @php
                            $alatObj = $peminjaman->alat ?? \App\Models\Alat::find($peminjaman->id_alat ?? null);
                            $namaAlatFinal = $alatObj->nama_alat ?? $alatObj->nama ?? $alatObj->name ?? ('Instrumen #' . ($peminjaman->id_alat ?? ''));
                        @endphp
                        <tr>
                            <td class="px-4 text-center text-secondary fw-medium fs-7">{{ $no++ }}</td>
                            <td class="px-3">
                                <div class="fw-semibold text-body-emphasis fs-7">{{ $namaAlatFinal }}</div>
                            </td>
                            <td class="px-3">
                                <span class="badge bg-body-tertiary text-body border font-monospace fw-semibold px-2.5 py-1.5 rounded-2 fs-8">
                                    {{ $peminjaman->jumlah }} Unit
                                </span>
                            </td>
                            <td class="px-3">
                                <span class="text-secondary fs-7">{{ $peminjaman->tanggal_pinjam }}</span>
                            </td>
                            <td class="px-3">
                                <span class="text-secondary fs-7">{{ $peminjaman->tanggal_kembali ?? '-' }}</span>
                            </td>
                            <td class="px-3">
                                @if($peminjaman->status == 'Pending')
                                    <span class="badge bg-warning-subtle text-warning-emphasis fw-semibold px-2.5 py-1.5 rounded-2 fs-8">Pending</span>
                                @elseif($peminjaman->status == 'Disetujui')
                                    <span class="badge bg-info-subtle text-info-emphasis fw-semibold px-2.5 py-1.5 rounded-2 fs-8">Disetujui</span>
                                @elseif($peminjaman->status == 'Ditolak')
                                    <span class="badge bg-danger-subtle text-danger-emphasis fw-semibold px-2.5 py-1.5 rounded-2 fs-8">Ditolak</span>
                                @elseif($peminjaman->status == 'Dipinjam')
                                    <span class="badge fw-semibold px-2.5 py-1.5 rounded-2 fs-8" style="background-color: rgba(217, 119, 6, 0.15); color: #d97706;">Sedang Dipinjam</span>
                                @else
                                    <span class="badge bg-success-subtle text-success-emphasis fw-semibold px-2.5 py-1.5 rounded-2 fs-8">Dikembalikan</span>
                                @endif
                            </td>
                            <td class="px-3">
                                <span class="text-danger fw-semibold fs-7">Rp {{ number_format($peminjaman->denda ?? 0, 0, ',', '.') }}</span>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="text-center py-5 text-secondary">
                                <div class="d-flex flex-column align-items-center gap-2">
                                    <i class="bi bi-disc fs-2 opacity-50"></i>
                                    <span class="fs-7">Belum ada riwayat permohonan peminjaman alat musik.</span>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        
        @if(method_exists($datap, 'hasPages') && $datap->hasPages())
        <div class="card-footer bg-transparent py-3 border-top-0 d-flex justify-content-end">
            {!! $datap->links() !!}
        </div>
        @endif
    </div>

</div>
@endsection