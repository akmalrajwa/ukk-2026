@extends('layouts.app')

@section('title', config('app.name') . ' -- Edit Alat Musik')

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
                            <h5 class="fw-bold mb-0 text-body-emphasis">Edit Data Alat Musik</h5>
                            <span class="text-secondary small">Perbarui detail instrumen inventaris sekolah</span>
                        </div>
                    </div>
                </div>

                <div class="card-body p-4">
                    <form action="{{ route('alat.update', ['id_alat' => $datal->id_alat]) }}" method="POST">
                        @csrf
                        <!-- @method('PUT') telah dihapus karena route di web.php menggunakan Route::post -->

                        <div class="mb-3">
                            <label for="nama_alat" class="form-label fw-semibold small text-body-emphasis">Nama Alat Musik</label>
                            <input type="text" 
                                   name="nama_alat" 
                                   id="nama_alat" 
                                   class="form-control rounded-3" 
                                   value="{{ $datal->nama_alat }}" 
                                   placeholder="Contoh: Gitar Akustik"
                                   required>
                        </div>
                        
                        <div class="mb-3">
                            <label for="kode_alat" class="form-label fw-semibold small text-body-emphasis">Kode Alat</label>
                            <input type="text" 
                                   name="kode_alat" 
                                   id="kode_alat" 
                                   class="form-control rounded-3 font-monospace" 
                                   value="{{ $datal->kode_alat }}" 
                                   placeholder="Contoh: ALT-001"
                                   required>
                        </div>

                        <div class="mb-4">
                            <label for="id_kategori" class="form-label fw-semibold small text-body-emphasis">Kategori Alat</label>
                            <select name="id_kategori" id="id_kategori" class="form-select rounded-3" required>
                                <option value="">-- Pilih Kategori --</option>
                                @foreach ($kategori as $k)
                                    <option value="{{ $k->id_kategori }}" {{ $datal->id_kategori == $k->id_kategori ? 'selected' : '' }}>
                                        {{ $k->nama_kategori }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="d-flex justify-content-between align-items-center pt-2 border-top">
                            <a href="{{ route('alat.index') }}" class="btn btn-outline-secondary px-4 rounded-3 fw-medium small">
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