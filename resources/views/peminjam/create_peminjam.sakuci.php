@extends('layouts.app')

@section('title', config('app.name') . ' — Pengajuan Alat Musik')

@section('content')
<div class="container-fluid py-4 px-3 px-md-4">
    <div class="row justify-content-center">
        <div class="col-lg-8 col-xl-7">
            <div class="card border-0 shadow-sm rounded-4 overflow-hidden bg-body">
                <div class="card-header bg-body border-bottom py-3.5 px-4 d-flex align-items-center gap-3 border-start border-4 border-danger">
                    <div class="rounded-3 p-2.5 d-flex align-items-center justify-content-center bg-danger-subtle text-danger" style="width: 44px; height: 44px;">
                        <i class="bi bi-music-note-beamed fs-5"></i>
                    </div>
                    <div>
                        <h5 class="fw-bold mb-0 text-body-emphasis">Form Peminjaman Alat Musik</h5>
                        <p class="text-secondary fs-8 mb-0">Isi detail di bawah untuk mengajukan permohonan peminjaman instrumen studio.</p>
                    </div>
                </div>

                <div class="card-body p-4">
                    @php
                        $currentUser = \App\Models\User::current();
                        $isPengguna = $currentUser && ($currentUser->role == 'pengguna');
                        $storeRoute = $isPengguna ? route('peminjam.storePeminjam.pengguna') : route('peminjam.storePeminjam');
                        $indexRoute = $isPengguna ? route('peminjam.indexPeminjam.pengguna') : route('peminjam.indexPeminjam');
                        
                        $selectedAlatId = $_GET['id_alat'] ?? request('id_alat') ?? '';
                        $daftarAlat = $alat ?? $alats ?? \App\Models\Alat::all();

                        $namaAlatTerpilih = '';
                        if (!empty($selectedAlatId)) {
                            foreach($daftarAlat as $item) {
                                $aId = $item->id_alat ?? $item->id;
                                if ($aId == $selectedAlatId) {
                                    $namaAlatTerpilih = $item->nama_alat ?? $item->nama ?? 'Instrumen #' . $aId;
                                    break;
                                }
                            }
                        }
                    @endphp

                    <form action="{{ $storeRoute }}" method="POST">
                        @csrf
                        
                        <!-- Pilihan Alat Musik -->
                        <div class="mb-3">
                            <label for="id_alat" class="form-label fw-semibold fs-8 text-uppercase tracking-wider text-secondary">
                                Instrumen / Alat Musik <span class="text-danger">*</span>
                            </label>
                            
                            @if(!empty($selectedAlatId))
                                <div class="form-control rounded-3 fw-medium d-flex align-items-center gap-2 py-2.5" style="background-color: var(--bs-tertiary-bg); color: var(--bs-body-color); border-color: var(--bs-border-color); cursor: not-allowed;">
                                     <i class="bi bi-disc text-danger"></i>
                                     <span>{{ $namaAlatTerpilih ?: 'Instrumen #' . $selectedAlatId }}</span>
                                </div>
                                <input type="hidden" name="id_alat" value="{{ $selectedAlatId }}">
                            @else
                                <select name="id_alat" id="id_alat" class="form-select rounded-3 py-2.5" required>
                                    <option value="">-- Pilih Alat Musik yang Tersedia --</option>
                                    @foreach($daftarAlat as $item)
                                        @php 
                                            $aId = $item->id_alat ?? $item->id;
                                            $aName = $item->nama_alat ?? $item->nama ?? 'Instrumen #' . $aId;
                                        @endphp
                                        <option value="{{ $aId }}">
                                            {{ $aName }} @if(isset($item->stok)) (Tersedia: {{ $item->stok }} unit) @endif
                                        </option>
                                    @endforeach
                                </select>
                            @endif
                        </div>

                        <!-- Jumlah -->
                        <div class="mb-3">
                            <label for="jumlah" class="form-label fw-semibold fs-8 text-uppercase tracking-wider text-secondary">
                                Jumlah Unit <span class="text-danger">*</span>
                            </label>
                            <div class="input-group">
                                <span class="input-group-text bg-body-tertiary text-secondary"><i class="bi bi-hash"></i></span>
                                <input type="number" name="jumlah" id="jumlah" class="form-control rounded-end-3 py-2.5" min="1" value="1" required placeholder="Contoh: 1">
                            </div>
                        </div>

                        <!-- Tanggal Pinjam (Memanjang Selebar Form) -->
                        <div class="mb-3">
                            <label for="tanggal_pinjam" class="form-label fw-semibold fs-8 text-uppercase tracking-wider text-secondary">
                                Tanggal Pinjam <span class="text-danger">*</span>
                            </label>
                            <input type="date" name="tanggal_pinjam" id="tanggal_pinjam" class="form-control rounded-3 py-2.5" value="{{ date('Y-m-d') }}" required>
                        </div>

                        <!-- Rencana Pengembalian (Memanjang Selebar Form) -->
                        <div class="mb-4">
                            <label for="tanggal_kembali" class="form-label fw-semibold fs-8 text-uppercase tracking-wider text-secondary">
                                Rencana Pengembalian <span class="text-danger">*</span>
                            </label>
                            <input type="date" name="tanggal_kembali" id="tanggal_kembali" class="form-control rounded-3 py-2.5" required>
                        </div>

                        <!-- Tombol Navigasi & Submit -->
                        <div class="d-flex justify-content-between align-items-center pt-3 border-top border-translucent">
                            <a href="{{ $indexRoute }}" class="btn btn-outline-secondary px-4 py-2 rounded-3 fw-medium">
                                <i class="bi bi-arrow-left me-1"></i> Kembali
                            </a>
                            <button type="submit" class="btn btn-brand px-4 py-2 rounded-3 fw-medium shadow-sm">
                                <i class="bi bi-send-fill me-1.5 fs-8"></i> Ajukan Peminjaman
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection