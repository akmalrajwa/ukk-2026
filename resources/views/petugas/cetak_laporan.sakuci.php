<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cetak Laporan Pengembalian - MELODIS</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #ffffff;
            color: #000000;
            font-family: Arial, sans-serif;
        }
        .table th, .table td {
            font-size: 0.85rem;
            vertical-align: middle;
        }
        @media print {
            .no-print {
                display: none !important;
            }
            body {
                padding: 0;
            }
            .container {
                max-width: 100% !important;
                width: 100% !important;
            }
        }
    </style>
</head>
<body> 

    <div class="container py-4">
        <!-- Tombol Aksi (Hilang Saat Diprint) -->
        <div class="d-flex justify-content-between align-items-center mb-4 no-print">
            <a href="{{ route('petugas.pengembalian.index') }}" class="btn btn-secondary btn-sm">
                &larr; Kembali
            </a>
        </div>

        <!-- Kop Laporan -->
        <div class="text-center border-bottom pb-3 mb-4">
            <h3 class="fw-bold text-uppercase m-0">Laporan Pengembalian Alat</h3>
            <p class="text-muted m-0 small">Sistem Inventaris Peminjaman Alat Musik</p>
        </div>

        @php $totalDenda = 0; @endphp

        <!-- Tabel Data -->
        <div class="table-responsive">
            <table class="table table-bordered align-middle">
                <thead class="table-dark text-center">
                    <tr>
                        <th width="4%">No</th>
                        <th width="11%">Tgl Pinjam</th>
                        <th width="11%">Tgl Kembali</th>
                        <th width="17%">Nama Peminjam</th>
                        <th width="20%">Nama Alat</th>
                        <th width="10%">Kondisi</th>
                        <th width="9%">Terlambat</th>
                        <th width="11%">Denda</th>
                        <th width="7%">Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($datap as $index => $item)
                        @php
                            $peminjaman = $peminjamanList[$item->id_peminjaman] ?? null;
                            $namaUser = $peminjaman ? ($userList[$peminjaman->id_user] ?? 'Tidak diketahui') : 'Tidak diketahui';
                            $namaAlat = $peminjaman ? ($alatList[$peminjaman->id_alat] ?? 'Alat dihapus') : 'Alat dihapus';
                            $tglPinjam = ($peminjaman && $peminjaman->tanggal_pinjam) ? date('d/m/Y', strtotime($peminjaman->tanggal_pinjam)) : '-';
                            $dendaItem = (int) ($item->denda ?? 0);
                            $totalDenda += $dendaItem;
                        @endphp
                        <tr>
                            <td class="text-center">{{ $index + 1 }}</td>
                            <td>{{ $tglPinjam }}</td>
                            <td>{{ date('d/m/Y', strtotime($item->tanggal_pengembalian)) }}</td>
                            <td>{{ $namaUser }}</td>
                            <td>{{ $namaAlat }}</td>
                            <td class="text-center">{{ ucfirst($item->kondisi_barang ?? 'Baik') }}</td>
                            <td class="text-center">{{ ($item->terlambat_hari ?? 0) > 0 ? $item->terlambat_hari . ' hari' : 'Tepat waktu' }}</td>
                            <td class="text-end">Rp {{ number_format($dendaItem, 0, ',', '.') }}</td>
                            <td class="text-center">Selesai</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="9" class="text-center py-4 text-muted">Belum ada data pengembalian alat.</td>
                        </tr>
                    @endforelse
                </tbody>
                @if(count($datap) > 0)
                    <tfoot>
                        <tr class="fw-bold">
                            <td colspan="7" class="text-end">Total Denda</td>
                            <td class="text-end">Rp {{ number_format($totalDenda, 0, ',', '.') }}</td>
                            <td></td>
                        </tr>
                    </tfoot>
                @endif
            </table>
        </div>

    </div>

</body>
</html>