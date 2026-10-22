@extends('layouts.app')

@section('title', config('app.name') . ' -- Tambah Kategori')

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
                            <h5 class="fw-bold mb-0 text-body-emphasis">Tambah Kategori Baru</h5>
                            <span class="text-secondary small">Tambahkan kelompok inventaris baru ke sistem</span>
                        </div>
                    </div>
                </div>

                <div class="card-body p-4">
                    <form action="{{ route('kategori.store') }}" method="POST">
                        @csrf
                        
                        <!-- Nama Kategori Terlebih Dahulu -->
                        <div class="mb-3">
                            <label for="nama_kategori" class="form-label fw-semibold small text-body-emphasis">Nama Kategori</label>
                            <input type="text" 
                                   name="nama_kategori" 
                                   id="nama_kategori" 
                                   class="form-control rounded-3" 
                                   value="{{ old('nama_kategori') }}" 
                                   placeholder="Contoh: Kordofon" 
                                   required>
                        </div>
                        
                        <!-- Kode Kategori Setelah Nama Kategori -->
                        <div class="mb-3">
                            <label for="kode_kategori" class="form-label fw-semibold small text-body-emphasis">Kode Kategori</label>
                            <input type="text" 
                                   name="kode_kategori" 
                                   id="kode_kategori" 
                                   class="form-control rounded-3 font-monospace" 
                                   value="{{ old('kode_kategori') }}" 
                                   placeholder="Contoh: K-01" 
                                   required>
                        </div>

                        <div class="mb-4">
                            <label for="keterangan" class="form-label fw-semibold small text-body-emphasis">Keterangan</label>
                            <input type="text" 
                                   name="keterangan" 
                                   id="keterangan" 
                                   class="form-control rounded-3" 
                                   value="{{ old('keterangan') }}" 
                                   placeholder="Masukkan keterangan tambahan" 
                                   required>
                        </div>

                        <!-- Action Buttons -->
                        <div class="d-flex justify-content-between align-items-center pt-3 border-top gap-2">
                            <a href="{{ route('kategori.index') }}" class="btn btn-outline-secondary px-3 rounded-3 fw-medium small">
                                <i class="bi bi-arrow-left me-1"></i> Kembali
                            </a>
                            <button type="submit" class="btn btn-brand px-4 rounded-3 fw-semibold shadow-sm small">
                                <i class="bi bi-check-lg me-1"></i> Simpan Kategori
                            </button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>

</div>
@endsection