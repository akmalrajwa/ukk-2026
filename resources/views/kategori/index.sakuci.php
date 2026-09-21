@extends('layouts.app')

@section('title', config('app.name') . '== Kerangka PHP Ringan')

@section('content')
<h1>Daftar kategori</h1>
<a href="{{ route('kategori.create') }}" class="btn btn-primary">Tambah alat</a>

<table class="table table-bordered mt-3">
    <tr>
        <th>No</th>
        <th>nama kategori</th>
        <th>kode kategori</th>
        <th>keterangan</th>
        <th>aksi</th>
    </tr>
    @php $no = 1; @endphp
    @foreach ($data as $kategoris)
    <tr>
        <td>{{ $no++ }}</td>
        <td>{{ $kategoris->nama_kategori }}</td>
        <td>{{ $kategoris->kode_kategori }}</td>
        <td>{{ $kategoris->keterangan }}</td>
        <td>
           <a href="{{ route('kategori.edit', ['kategori' => $kategoris->id_kategori]) }}" class="btn btn-info btn-sm">Edit</a>
           <form action="{{ route('kategori.delete', ['id' => $kategoris->id_kategori]) }}" method="POST" style="display: inline-block;">
                @csrf
                @method('DELETE')
             <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin hapus kategori ini?')">Hapus</button>
            </form>
        </td>
    </tr>
    @endforeach
</table>

{!! $data->Links() !!}

@endsection 