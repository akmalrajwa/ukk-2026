@extends('layouts.app')

@section('title', config('app.name') . ' — Tambah Pengembalian')

@section('content')
<div class="container-fluid py-4 px-3 px-md-4">
    
    <!-- Lebar card rata penuh (col-12) sejajar dengan tabel index -->
    <div class="row">
        <div class="col-12">
            
            <!-- Card Pembungkus Form -->
            <div class="card border-0 shadow-sm rounded-4 overflow-hidden bg-body">
                <div class="card-header bg-body border-bottom py-3.5 px-4 border-start border-4 border-danger">
                    <div class="d-flex align-items-center gap-3">
                        <div class="p-2.5 rounded-3 d-flex align-items-center justify-content-center bg-danger-subtle text-danger" style="width: 44px; height: 44px;">
                            <i class="bi bi-plus-circle-fill fs-5"></i>
                        </div>
                        <div>
                            <h5 class="fw-bold mb-0 text-body-emphasis">Tambah Pengembalian Baru</h5>
                            <span class="text-secondary fs-8">Catat transaksi pengembalian alat inventaris baru</span>
                        </div>
                    </div>
                </div>

                <div class="card-body p-4 p-md-5">
                    <form action="{{ route('pengembalian.store') }}" method="POST">
                        @csrf

                        <!-- 1. Pilih Peminjaman (100% Full Width Vertikal) -->
                        <div class="mb-4">
                            <label for="id_peminjaman" class="form-label fw-semibold fs-8 text-uppercase tracking-wider text-secondary">
                                Pilih Peminjaman <span class="text-danger">*</span>
                            </label>
                            <select name="id_peminjaman" id="id_peminjaman" class="form-select rounded-3 py-2.5 @error('id_peminjaman') is-invalid @enderror" required>
                                <option value="" disabled selected>-- Pilih Data Peminjaman --</option>
                                @foreach($peminjaman as $p)
                                    @php
                                        $pid = $p->id_peminjaman ?? $p->id;
                                        $uname = $userList[$p->id_user] ?? 'User #'.$p->id_user;
                                        $alatName = $alatList[$p->id_alat] ?? 'Alat #'.$p->id_alat;
                                    @endphp
                                    <option value="{{ $pid }}" {{ old('id_peminjaman') == $pid ? 'selected' : '' }}>
                                        ID #{{ $pid }} - {{ $uname }} ({{ $alatName }})
                                    </option>
                                @endforeach
                            </select>
                            @error('id_peminjaman')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- 2. Tanggal Pengembalian (100% Full Width Vertikal) -->
                        <div class="mb-4">
                            <label for="tanggal_pengembalian" class="form-label fw-semibold fs-8 text-uppercase tracking-wider text-secondary">
                                Tanggal Pengembalian <span class="text-danger">*</span>
                            </label>
                            <input type="date" name="tanggal_pengembalian" id="tanggal_pengembalian" class="form-control rounded-3 py-2.5 @error('tanggal_pengembalian') is-invalid @enderror" value="{{ old('tanggal_pengembalian', date('Y-m-d')) }}" required>
                            @error('tanggal_pengembalian')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- 3. Denda (Rp) -->
                        <div class="mb-4">
                            <label for="denda" class="form-label fw-semibold fs-8 text-uppercase tracking-wider text-secondary">
                                Denda (Rp)
                            </label>
                            <input type="number" min="0" name="denda" id="denda" class="form-control rounded-3 py-2.5 @error('denda') is-invalid @enderror" value="{{ old('denda') }}" placeholder="0">
                            <div class="form-text small">Boleh dikosongkan, denda dihitung otomatis dari keterlambatan.</div>
                            @error('denda')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- 4. Kondisi Barang (100% Full Width Vertikal) -->
                        <div class="mb-4">
                            <label for="kondisi_barang" class="form-label fw-semibold fs-8 text-uppercase tracking-wider text-secondary">
                                Kondisi Barang <span class="text-danger">*</span>
                            </label>
                            <select name="kondisi_barang" id="kondisi_barang" class="form-select rounded-3 py-2.5 @error('kondisi_barang') is-invalid @enderror" required>
                                <option value="Baik" {{ old('kondisi_barang') == 'Baik' ? 'selected' : '' }}>Baik</option>
                                <option value="Rusak Ringan" {{ old('kondisi_barang') == 'Rusak Ringan' ? 'selected' : '' }}>Rusak Ringan</option>
                                <option value="Rusak Berat" {{ old('kondisi_barang') == 'Rusak Berat' ? 'selected' : '' }}>Rusak Berat</option>
                                <option value="Hilang" {{ old('kondisi_barang') == 'Hilang' ? 'selected' : '' }}>Hilang</option>
                            </select>
                            @error('kondisi_barang')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- 5. Catatan (100% Full Width Vertikal) -->
                        <div class="mb-4">
                            <label for="catatan" class="form-label fw-semibold fs-8 text-uppercase tracking-wider text-secondary">
                                Catatan
                            </label>
                            <textarea name="catatan" id="catatan" rows="3" class="form-control rounded-3 @error('catatan') is-invalid @enderror" placeholder="Tambahkan catatan jika ada...">{{ old('catatan') }}</textarea>
                            @error('catatan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Action Buttons Navigasi & Submit -->
                        <div class="d-flex justify-content-between align-items-center pt-4 border-top border-translucent mt-2">
                            <a href="{{ route('pengembalian.index') }}" class="btn btn-outline-secondary px-4 py-2.5 rounded-3 fw-medium">
                                <i class="bi bi-arrow-left me-1"></i> Kembali
                            </a>
                            <button type="submit" class="btn btn-brand px-4 py-2.5 rounded-3 fw-semibold shadow-sm">
                                <i class="bi bi-check-lg me-1"></i> Simpan Data
                            </button>
                        </div>

                    </form>
                </div>
            </div>

        </div>
    </div>

</div>
@endsection