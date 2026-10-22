@extends('layouts.app')

@section('title', config('app.name') . ' -- Tambah Peminjaman')

@section('content')
<div class="container-fluid py-4 px-3 px-md-4">
    
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6">
            
            <!-- Card Pembungkus Form -->
            <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
                <div class="card-header bg-body border-bottom py-3 px-4 border-start border-4 border-danger">
                    <div class="d-flex align-items-center gap-2">
                        <i class="bi bi-plus-circle text-danger fs-5"></i>
                        <div>
                            <h5 class="fw-bold mb-0 text-body-emphasis">Tambah Peminjaman Baru</h5>
                            <span class="text-secondary small">Catat transaksi peminjaman alat inventaris baru</span>
                        </div>
                    </div>
                </div>

                <div class="card-body p-4">
                    <form action="{{ route('peminjaman.store') }}" method="POST">
                        @csrf
                        
                        <!-- User / Peminjam -->
                        <div class="mb-3">
                            <label for="id_user" class="form-label fw-semibold small text-body-emphasis">Pilih User / Peminjam</label>
                            <select name="id_user" id="id_user" class="form-select rounded-3" required>
                                <option value="">-- Pilih User --</option>
                                @foreach($users as $user)
                                    <option value="{{ $user->id }}">{{ $user->nama ?? $user->name ?? $user->username }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Pilih Alat -->
                        <div class="mb-3">
                            <label for="id_alat" class="form-label fw-semibold small text-body-emphasis">Pilih Alat</label>
                            <select name="id_alat" id="id_alat" class="form-select rounded-3" required>
                                <option value="">-- Pilih Alat --</option>
                                @foreach($alat as $item)
                                    <option value="{{ $item->id_alat }}">{{ $item->nama_alat ?? $item->nama }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Jumlah Unit -->
                        <div class="mb-3">
                            <label for="jumlah" class="form-label fw-semibold small text-body-emphasis">Jumlah Unit</label>
                            <input type="number" name="jumlah" id="jumlah" class="form-control rounded-3" value="1" min="1" required>
                        </div>

                        <!-- Tanggal Pinjam -->
                        <div class="mb-3">
                            <label for="tanggal_pinjam" class="form-label fw-semibold small text-body-emphasis">Tanggal Pinjam</label>
                            <input type="date" name="tanggal_pinjam" id="tanggal_pinjam" class="form-control rounded-3" required>
                        </div>

                        <!-- Tanggal Kembali -->
                        <div class="mb-3">
                            <label for="tanggal_kembali" class="form-label fw-semibold small text-body-emphasis">Tanggal Kembali</label>
                            <input type="date" name="tanggal_kembali" id="tanggal_kembali" class="form-control rounded-3" required>
                        </div>

                        <!-- Status -->
                        <div class="mb-3">
                            <label for="status" class="form-label fw-semibold small text-body-emphasis">Status Peminjaman</label>
                            <select name="status" id="status" class="form-select rounded-3" required>
                                <option value="Pending" selected>Pending</option>
                                <option value="Disetujui">Disetujui</option>
                                <option value="Ditolak">Ditolak</option>
                                <option value="Dikembalikan">Dikembalikan</option>
                            </select>
                        </div>

                        <!-- Denda -->
                        <div class="mb-4">
                            <label for="denda" class="form-label fw-semibold small text-body-emphasis">Denda (Rp)</label>
                            <input type="number" name="denda" id="denda" class="form-control rounded-3" value="0" min="0" required>
                        </div>

                        <!-- Action Buttons -->
                        <div class="d-flex justify-content-between align-items-center pt-3 border-top gap-2">
                            <a href="{{ route('peminjaman.index') }}" class="btn btn-outline-secondary px-3 rounded-3 fw-medium small">
                                <i class="bi bi-arrow-left me-1"></i> Kembali
                            </a>
                            <button type="submit" class="btn btn-brand px-4 rounded-3 fw-semibold shadow-sm small">
                                <i class="bi bi-check-lg me-1"></i> Simpan Peminjaman
                            </button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>

</div>
@endsections