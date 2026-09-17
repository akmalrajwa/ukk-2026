@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit kategori</h1>
    <form action="{{ route('kategori.update', ['id_kategori' => $data->id_kategori]) }}" method="POST">
        @csrf
        @method('PUT')

            <label>Nama Kategori</label>
        <input type="text" name="nama_kategori" id="nama_kategori" class="form-control" value="{{ old('nama_kategori') }}" required>

        <label>Kode Kategori</label>
        <input type="text" name="kode_kategori" id="kode_kategori" class="form-control" value="{{ old('kode_kategori') }}" required>

        <label>keterangan</label>
        <input type="text" name="keterangan" id="keterangan" class="form-control" value="{{ old('keterangan') }}" required>

    <button type="submit" class="btn btn-primary mt-2">Simpan</button>
    <button type="button" class="btn btn-secondary mt-2" onclick="window.history.back();">Batal</button>
</form>
</div>
@endsection