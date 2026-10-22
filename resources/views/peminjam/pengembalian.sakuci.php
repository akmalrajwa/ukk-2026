@extends('layouts.app')

@section('title', config('app.name') . ' — Pengembalian Alat Musik')

@section('content')
<div class="container-fluid py-4 px-3 px-md-4">
    <div class="row justify-content-center">
        <div class="col-lg-10 col-xl-9">
            <div class="card border-0 shadow-sm rounded-4 overflow-hidden bg-body">
                
                <!-- Card Header -->
                <div class="card-header bg-body border-bottom py-3.5 px-4 d-flex align-items-center gap-3 border-start border-4 border-danger">
                    <div class="p-2.5 rounded-3 d-flex align-items-center justify-content-center bg-danger-subtle text-danger" style="width: 44px; height: 44px;">
                        <i class="bi bi-arrow-return-left fs-5"></i>
                    </div>
                    <div>
                        <h5 class="fw-bold mb-0 text-body-emphasis">Pengembalian Instrumen Musik</h5>
                        <p class="text-secondary fs-8 mb-0">Konfirmasi pengembalian alat musik yang selesai Anda gunakan.</p>
                    </div>
                </div>

                <div class="card-body p-4 p-md-5">
                    @if(empty($peminjamanAktif) || count($peminjamanAktif) === 0)
                        <div class="alert alert-danger border-0 shadow-sm rounded-3 d-flex align-items-center gap-3 p-3.5 mb-0 bg-danger-subtle text-danger">
                            <i class="bi bi-info-circle-fill fs-4"></i>
                            <div class="fs-7">
                                Anda tidak memiliki instrumen musik yang berstatus <strong>Sedang Dipinjam</strong> saat ini.
                            </div>
                        </div>
                    @else
                        <form action="{{ route('peminjam.pengembalian.store') }}" method="POST">
                            @csrf
                            
                            <!-- 1. Pilih Alat Musik (Full Width Vertikal) -->
                            <div class="mb-4">
                                <label for="id_peminjaman" class="form-label fw-semibold fs-8 text-uppercase tracking-wider text-secondary">
                                    Pilih Alat Musik Dipinjam <span class="text-danger">*</span>
                                </label>
                                <select name="id_peminjaman" id="id_peminjaman" class="form-select rounded-3 py-2.5 @error('id_peminjaman') is-invalid @enderror" required>
                                    <option value="">-- Pilih Instrumen Musik --</option>
                                    @foreach($peminjamanAktif as $p)
                                        <option value="{{ $p->id_peminjaman ?? $p->id }}">
                                            🎵 {{ $p->alat->nama_alat ?? ($p->alat->nama ?? ($p->nama_alat ?? 'Instrumen ID: ' . $p->id_alat)) }} (Status: {{ ucfirst($p->status) }})
                                        </option>
                                    @endforeach
                                </select>
                                @error('id_peminjaman')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- 2. Tanggal Pengembalian (Full Width Vertikal) -->
                            <div class="mb-4">
                                <label for="tanggal_pengembalian" class="form-label fw-semibold fs-8 text-uppercase tracking-wider text-secondary">
                                    Tanggal Pengembalian <span class="text-danger">*</span>
                                </label>
                                <input type="date" name="tanggal_pengembalian" id="tanggal_pengembalian" class="form-control rounded-3 py-2.5" value="{{ date('Y-m-d') }}" required>
                            </div>

                            <!-- 3. Kondisi Fisik Instrumen (Full Width Vertikal) -->
                            <div class="mb-4">
                                <label for="kondisi_barang" class="form-label fw-semibold fs-8 text-uppercase tracking-wider text-secondary">
                                    Kondisi Fisik Instrumen
                                </label>
                                <select name="kondisi_barang" id="kondisi_barang" class="form-select rounded-3 py-2.5">
                                    <option value="Baik">Baik</option>
                                    <option value="Ringan Rusak">Rusak Ringan</option>
                                    <option value="Rusak">Rusak Berat</option>
                                    <option value="Rusak">Hilang</option>
                                </select>
                            </div>

                            <!-- 4. Catatan / Keterangan Kelengkapan (Full Width Vertikal) -->
                            <div class="mb-4">
                                <label for="catatan" class="form-label fw-semibold fs-8 text-uppercase tracking-wider text-secondary">
                                    Catatan / Keterangan Kelengkapan <span class="text-muted fw-normal">(Opsional)</span>
                                </label>
                                <textarea name="catatan" id="catatan" rows="3" class="form-control rounded-3" placeholder="Contoh: Kondisi senar aman"></textarea>
                            </div>

                            <!-- Tombol Navigasi & Submit -->
                            <div class="d-flex justify-content-between align-items-center pt-4 border-top border-translucent mt-2">
                                <a href="{{ route('peminjam.dashboard') }}" class="btn btn-outline-secondary px-4 py-2.5 rounded-3 fw-medium">
                                    <i class="bi bi-arrow-left me-1"></i> Kembali
                                </a>
                                <button type="submit" class="btn btn-brand px-4 py-2.5 rounded-3 fw-semibold shadow-sm">
                                    <i class="bi bi-check-lg me-1"></i> Simpan Pengembalian
                                </button>
                            </div>
                        </form>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection