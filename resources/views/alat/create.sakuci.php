@extends('layouts.app')

@section('title', config('app.name') . ' -- Tambah Alat')

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
                            <h5 class="fw-bold mb-0 text-body-emphasis">Tambah Alat Baru</h5>
                            <span class="text-secondary small">Tambahkan data inventaris alat baru ke dalam sistem</span>
                        </div>
                    </div>
                </div>

                <div class="card-body p-4">
                    <form action="{{ route('alat.store') }}" method="POST">
                        @csrf
                        
                        <!-- Nama Alat -->
                        <div class="mb-3">
                            <label for="nama_alat" class="form-label fw-semibold small text-body-emphasis">Nama Alat</label>
                            <input type="text" 
                                   name="nama_alat" 
                                   id="nama_alat" 
                                   class="form-control rounded-3" 
                                   value="{{ old('nama_alat') }}" 
                                   placeholder="Contoh: Gitar" 
                                   required>
                        </div>

                        <!-- Kode Alat -->
                        <div class="mb-3">
                            <label for="kode_alat" class="form-label fw-semibold small text-body-emphasis">Kode Alat</label>
                            <input type="text" 
                                   name="kode_alat" 
                                   id="kode_alat" 
                                   class="form-control rounded-3 font-monospace" 
                                   value="{{ old('kode_alat') }}" 
                                   placeholder="Contoh: A-01" 
                                   required>
                        </div>

                        <!-- Kategori Alat -->
                        <div class="mb-4">
                            <label for="id_kategori" class="form-label fw-semibold small text-body-emphasis">Kategori</label>
                            <select name="id_kategori" id="id_kategori" class="form-select rounded-3" required>
                                <option value="">-- Pilih Kategori --</option>
                                @foreach ($kategori as $k)
                                    <option value="{{ $k->id_kategori }}" {{ old('id_kategori') == $k->id_kategori ? 'selected' : '' }}>
                                        {{ $k->nama_kategori }} ({{ $k->kode_kategori }})
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Action Buttons -->
                        <div class="d-flex justify-content-between align-items-center pt-3 border-top gap-2">
                            <a href="{{ route('alat.index') }}" class="btn btn-outline-secondary px-3 rounded-3 fw-medium small">
                                <i class="bi bi-arrow-left me-1"></i> Kembali
                            </a>
                            <button type="submit" class="btn btn-brand px-4 rounded-3 fw-semibold shadow-sm small">
                                <i class="bi bi-check-lg me-1"></i> Simpan Alat
                            </button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>

</div>
@endsection