@extends('layouts.app')

@section('title', config('app.name') . ' — Daftar Kategori')

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
                            <i class="bi bi-tags me-1"></i> Kategori Musik
                        </span>
                    </div>
                    <h3 class="fw-bold mb-1 text-white">Daftar Kategori Alat</h3>
                    <p class="text-white-50 small mb-0" style="max-width: 620px;">
                        Kelola kelompok dan pengelompokan jenis instrumen serta peralatan musik.
                    </p>
                </div>
                
                <!-- Action Buttons -->
                <div class="flex-shrink-0 d-flex align-items-center gap-2">
                    <a href="/admin/kategori/create" class="btn btn-light text-danger px-3 py-2 rounded-3 fw-semibold shadow-sm small d-inline-flex align-items-center gap-1.5">
                        <i class="bi bi-plus-lg"></i>
                        <span>Tambah Kategori Baru</span>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Card Data Tabel Kategori -->
    <div class="card border-0 shadow-sm rounded-4 overflow-hidden bg-body">
        <!-- Header Card -->
        <div class="card-header bg-body border-bottom py-3 px-4">
            <div class="d-flex align-items-center justify-content-between">
                <div class="d-flex align-items-center gap-2">
                    <i class="bi bi-tags text-danger fs-5"></i>
                    <div>
                        <h6 class="card-title mb-0 fw-semibold text-body-emphasis">Data Kategori</h6>
                        <span class="text-secondary small">Daftar kategori alat-alat yang tersedia di sistem</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="bg-body-tertiary border-bottom text-secondary text-uppercase small tracking-wider">
                        <tr>
                            <th class="py-3 px-4 text-center" style="width: 5%;">NO</th>
                            <th class="py-3 px-3">NAMA KATEGORI</th>
                            <th class="py-3 px-3">KODE KATEGORI</th>
                            <th class="py-3 px-3">KETERANGAN</th>
                            <th class="py-3 px-4 text-center" style="width: 180px;">AKSI</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $no = method_exists($data, 'firstItem') ? $data->firstItem() : 1;
                        @endphp

                        @forelse ($data as $kategori)
                        <tr>
                            <!-- NO -->
                            <td class="px-4 text-center text-secondary fw-medium small">
                                {{ $no++ }}
                            </td>

                            <!-- NAMA KATEGORI -->
                            <td class="px-3">
                                <div class="fw-bold text-body-emphasis small text-uppercase">
                                    <i class="bi bi-tag-fill text-danger me-1 small"></i>{{ $kategori->nama_kategori }}
                                </div>
                            </td>

                            <!-- KODE KATEGORI -->
                            <td class="px-3">
                                <span class="badge bg-body-secondary text-body-emphasis border font-monospace fw-bold px-2.5 py-1.5 rounded-2 small">
                                    {{ $kategori->kode_kategori }}
                                </span>
                            </td>

                            <!-- KETERANGAN -->
                            <td class="px-3">
                                @if(!empty($kategori->keterangan))
                                    <span class="badge bg-warning-subtle text-warning-emphasis border border-warning-subtle px-2.5 py-1.5 rounded-2 small fw-medium">
                                        {{ $kategori->keterangan }}
                                    </span>
                                @else
                                    <span class="text-secondary small">-</span>
                                @endif
                            </td>

                            <!-- AKSI -->
                            <td class="px-4 text-center">
                                <div class="d-inline-flex align-items-center justify-content-center gap-2">
                                    <!-- Tombol Edit -->
                                    <a href="{{ route('kategori.edit', ['id_kategori' => $kategori->id_kategori]) }}" 
                                       class="btn btn-sm btn-outline-primary px-2.5 py-1 rounded-2 fw-medium small d-inline-flex align-items-center gap-1" 
                                       title="Edit Data">
                                        <i class="bi bi-pencil"></i> Edit
                                    </a>

                                    <!-- Tombol Hapus -->
                                    <form action="{{ route('kategori.delete', ['id_kategori' => $kategori->id_kategori]) }}" 
                                          method="POST" 
                                          class="d-inline m-0" 
                                          onsubmit="return confirm('Apakah Anda yakin ingin menghapus kategori ini?')">
                                        @csrf
                                        @method('DELETE')
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
                            <td colspan="5" class="text-center py-5 text-secondary">
                                <div class="d-flex flex-column align-items-center gap-2">
                                    <i class="bi bi-inbox fs-1 opacity-50 text-secondary"></i>
                                    <span class="small fw-medium">Belum ada data kategori yang ditambahkan.</span>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        
        <!-- Bagian Pagination -->
        @if(method_exists($data, 'hasPages') && $data->hasPages())
        <div class="card-footer bg-body border-top py-3 px-4 d-flex justify-content-between align-items-center">
            <div class="small text-secondary">
                Menampilkan {{ $data->firstItem() }} sampai {{ $data->lastItem() }} dari {{ $data->total() }} data
            </div>
            <div>
                {!! $data->links() !!}
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