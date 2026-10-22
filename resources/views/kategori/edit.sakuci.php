@extends('layouts.app')

@section('title', config('app.name') . ' -- Edit Kategori')

@section('content')
<div class="container-fluid py-4 px-3 px-md-4">
    
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6">
            
            <!-- Card Pembungkus Form -->
            <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
                <div class="card-header bg-body border-bottom py-3 px-4 border-start border-4 border-danger">
                    <div class="d-flex align-items-center gap-2">
                        <i class="bi bi-pencil-square text-danger fs-5"></i>
                        <div>
                            <h5 class="fw-bold mb-0 text-body-emphasis">Edit Data Kategori</h5>
                            <span class="text-secondary small">Perbarui detail kategori inventaris alat</span>
                        </div>
                    </div>
                </div>

                <div class="card-body p-4">
                    <form action="{{ route('kategori.update', ['id_kategori' => $data->id_kategori]) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <!-- Nama Kategori Terlebih Dahulu -->
                        <div class="mb-3">
                            <label for="nama_kategori" class="form-label fw-semibold small text-body-emphasis">Nama Kategori</label>
                            <input type="text" 
                                   name="nama_kategori" 
                                   id="nama_kategori" 
                                   class="form-control rounded-3" 
                                   value="{{ $data->nama_kategori }}" 
                                   required>
                        </div>
                        
                        <!-- Kode Kategori Setelah Nama Kategori -->
                        <div class="mb-3">
                            <label for="kode_kategori" class="form-label fw-semibold small text-body-emphasis">Kode Kategori</label>
                            <input type="text" 
                                   name="kode_kategori" 
                                   id="kode_kategori" 
                                   class="form-control rounded-3 font-monospace" 
                                   value="{{ $data->kode_kategori }}" 
                                   required>
                        </div>

                        <div class="mb-4">
                            <label for="keterangan" class="form-label fw-semibold small text-body-emphasis">Keterangan</label>
                            <input type="text" 
                                   name="keterangan" 
                                   id="keterangan" 
                                   class="form-control rounded-3" 
                                   value="{{ $data->keterangan }}" 
                                   required>
                        </div>

                        <!-- Action Buttons -->
                        <div class="d-flex justify-content-between align-items-center pt-3 border-top gap-2">
                            <a href="{{ route('kategori.index') }}" class="btn btn-outline-secondary px-3 rounded-3 fw-medium small">
                                <i class="bi bi-arrow-left me-1"></i> Kembali
                            </a>
                            <button type="submit" class="btn btn-brand px-4 rounded-3 fw-semibold shadow-sm small">
                                <i class="bi bi-check-lg me-1"></i> Simpan Perubahan
                            </button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>

</div>
@endsection