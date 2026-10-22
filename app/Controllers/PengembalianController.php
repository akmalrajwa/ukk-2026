<?php

namespace App\Controllers;

use Sakuci\Controller;
use Sakuci\Http\Request;
use App\Models\Pengembalian;
use App\Models\Peminjaman;
use App\Models\User;
use App\Models\Alat;
use App\Models\LogAktifitas;

class PengembalianController extends Controller
{
    // Tarif denda per hari keterlambatan (rupiah). Ubah angka ini bila tarif berbeda.
    const DENDA_PER_HARI = 5000;

    /**
     * Ringkasan untuk log: "namaPeminjam - NamaAlat (n unit)".
     */
    private function ringkas($peminjaman)
    {
        if (!$peminjaman) {
            return '-';
        }

        $user = User::where('id', $peminjaman->id_user)->first();
        $alat = Alat::where('id_alat', $peminjaman->id_alat)->first();

        $namaUser = $user->username ?? $user->nama ?? ('User #' . $peminjaman->id_user);
        $namaAlat = $alat->nama_alat ?? ('Alat #' . $peminjaman->id_alat);

        return $namaUser . ' - ' . $namaAlat . ' (' . ($peminjaman->jumlah ?? 1) . ' unit)';
    }

    /**
     * Denda yang diketik admin. Kosong / tidak valid => null (artinya: hitung otomatis).
     */
    private function dendaManual(Request $request)
    {
        $all = $request->all();
        $nilai = $all['denda'] ?? null;

        if ($nilai === null || $nilai === '' || !is_numeric($nilai) || $nilai < 0) {
            return null;
        }

        return (int) $nilai;
    }

    /**
     * Hitung keterlambatan: tanggal alat dikembalikan dibanding rencana pengembalian
     * (kolom peminjaman.tanggal_kembali). Yang dibandingkan hanya tanggalnya, bukan jam.
     * Hasil: [jumlah hari terlambat, denda]
     */
    private function hitungKeterlambatan($peminjaman, $tanggalPengembalian)
    {
        $rencana = $peminjaman->tanggal_kembali ?? null;
        if (empty($rencana) || empty($tanggalPengembalian)) {
            return [0, 0];
        }

        $batas   = strtotime(date('Y-m-d', strtotime($rencana)));
        $kembali = strtotime(date('Y-m-d', strtotime($tanggalPengembalian)));

        $hari = max(0, (int) round(($kembali - $batas) / 86400));

        return [$hari, $hari * self::DENDA_PER_HARI];
    }

    // =========================================================================
    // BAGIAN 1: KHUSUS ADMIN (FULL AKSES KELOLA)
    // =========================================================================

    public function index(Request $request)
    {
        $datap = Pengembalian::orderBy('id_pengembalian', 'desc')->paginate(10);
        $peminjaman = Peminjaman::all();
        $users = User::all();
        $alats = Alat::all();

        $peminjamanList = [];
        foreach ($peminjaman as $p) {
            $pid = $p->id_peminjaman ?? $p->id;
            $peminjamanList[$pid] = $p;
        }

        $userList = [];
        foreach ($users as $u) {
            $id = $u->id ?? $u->id_user;
            $userList[$id] = $u->username ?? $u->nama ?? "User #{$id}";
        }

        $alatList = [];
        foreach ($alats as $a) {
            $id = $a->id_alat ?? $a->id;
            $alatList[$id] = $a->nama_alat ?? "Alat #{$id}";
        }

        return view('pengembalian.index', compact('datap', 'peminjamanList', 'userList', 'alatList'));
    }

    public function create(Request $request)
    {
        $peminjaman = Peminjaman::where('status', '!=', 'Dikembalikan')->get();
        $users = User::all();
        $alats = Alat::all();

        $userList = [];
        foreach ($users as $u) {
            $id = $u->id ?? $u->id_user;
            $userList[$id] = $u->username ?? $u->nama ?? "User #{$id}";
        }

        $alatList = [];
        foreach ($alats as $a) {
            $id = $a->id_alat ?? $a->id;
            $alatList[$id] = $a->nama_alat ?? "Alat #{$id}";
        }

        return view('pengembalian.create', compact('peminjaman', 'userList', 'alatList'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'id_peminjaman'        => 'required|integer',
            'tanggal_pengembalian' => 'required|date',
            'kondisi_barang'       => 'nullable|string|max:100',
            'catatan'              => 'nullable|string',
        ]);

        $peminjaman = Peminjaman::findOrFail($validatedData['id_peminjaman']);

        // Hari terlambat selalu otomatis. Denda otomatis, kecuali admin mengisinya sendiri.
        [$hari, $dendaOtomatis] = $this->hitungKeterlambatan($peminjaman, $validatedData['tanggal_pengembalian']);
        $denda = $this->dendaManual($request) ?? $dendaOtomatis;
        $validatedData['terlambat_hari'] = $hari;
        $validatedData['denda']          = $denda;
        $validatedData['kondisi_barang'] = $validatedData['kondisi_barang'] ?? 'Baik';

        Pengembalian::create($validatedData);

        $peminjaman->update(['status' => 'Dikembalikan', 'denda' => $denda]);

        $currentUser = User::current();
        LogAktifitas::create([
            'id_user'   => $currentUser->id ?? null,
            'aktifitas' => 'Admin mencatat pengembalian (Peminjaman ID: ' . $validatedData['id_peminjaman'] . '): ' . $this->ringkas($peminjaman)
                          . ', terlambat ' . $hari . ' hari, denda Rp ' . number_format($denda, 0, ',', '.') . ', kondisi ' . $validatedData['kondisi_barang'] . '.'
        ]);

        return redirect(route('pengembalian.index'))->with('success', 'Data pengembalian berhasil ditambahkan.');
    }

    public function edit(Request $request, $id_pengembalian)
    {
        $datap = Pengembalian::findOrFail($id_pengembalian);
        $peminjaman = Peminjaman::find($datap->id_peminjaman);

        $peminjamName = '-';
        $alatName = '-';

        if ($peminjaman) {
            $user = User::find($peminjaman->id_user);
            $alat = Alat::find($peminjaman->id_alat);
            if (!$alat) {
                $alat = Alat::where('id_alat', $peminjaman->id_alat)->first();
            }

            $peminjamName = $user->username ?? $user->nama ?? ("User #" . $peminjaman->id_user);
            $alatName = $alat->nama_alat ?? ("Alat #" . $peminjaman->id_alat);
        }

        return view('pengembalian.edit', compact('datap', 'peminjaman', 'peminjamName', 'alatName'));
    }

    public function update(Request $request, $id_pengembalian)
    {
        $validatedData = $request->validate([
            'id_peminjaman'        => 'required|integer',
            'tanggal_pengembalian' => 'required|date',
            'kondisi_barang'       => 'nullable|string|max:100',
            'catatan'              => 'nullable|string',
        ]);

        $peminjaman   = Peminjaman::findOrFail($validatedData['id_peminjaman']);
        $pengembalian = Pengembalian::findOrFail($id_pengembalian);

        [$hari, $dendaOtomatis] = $this->hitungKeterlambatan($peminjaman, $validatedData['tanggal_pengembalian']);
        $validatedData['terlambat_hari'] = $hari;

        // Form edit menampilkan denda tersimpan. Aturannya:
        // - kosong                         => hitung ulang otomatis
        // - angka diubah admin             => pakai angka itu
        // - angka sama, tapi tanggal diubah => hitung ulang otomatis
        // - angka sama, tanggal sama       => biarkan seperti tersimpan
        $dendaInput     = $this->dendaManual($request);
        $tanggalBerubah = date('Y-m-d', strtotime($validatedData['tanggal_pengembalian']))
                       !== date('Y-m-d', strtotime($pengembalian->tanggal_pengembalian));

        if ($dendaInput === null) {
            $denda = $dendaOtomatis;
        } elseif ($dendaInput === (int) $pengembalian->denda && $tanggalBerubah) {
            $denda = $dendaOtomatis;
        } else {
            $denda = $dendaInput;
        }
        $validatedData['denda'] = $denda;

        $pengembalian->update($validatedData);

        $peminjaman->update(['denda' => $denda]);

        $currentUser = User::current();
        LogAktifitas::create([
            'id_user'   => $currentUser->id ?? null,
            'aktifitas' => 'Admin memperbarui pengembalian (ID: ' . $id_pengembalian . '): ' . $this->ringkas($peminjaman)
                          . ', terlambat ' . $hari . ' hari, denda Rp ' . number_format($denda, 0, ',', '.') . '.'
        ]);

        return redirect(route('pengembalian.index'))->with('success', 'Data pengembalian berhasil diubah.');
    }

    public function delete(Request $request, $id_pengembalian)
    {
        $pengembalian = Pengembalian::findOrFail($id_pengembalian);
        $ringkasan = $this->ringkas(Peminjaman::where('id_peminjaman', $pengembalian->id_peminjaman)->first());
        $pengembalian->delete();

        $currentUser = User::current();
        LogAktifitas::create([
            'id_user'   => $currentUser->id ?? null,
            'aktifitas' => 'Admin menghapus pengembalian (ID: ' . $id_pengembalian . '): ' . $ringkasan . '.'
        ]);

        return redirect(route('pengembalian.index'))->with('success', 'Data pengembalian berhasil dihapus.');
    }


    // =========================================================================
    // BAGIAN 2: KHUSUS ROLE PEMINJAM (SISWA)
    // =========================================================================

    public function createPeminjam(Request $request)
    {
        $user = User::current();
        if (!$user) return redirect(route('login'))->with('error', 'Silakan login terlebih dahulu.');

        $id_user = $user->id ?? $user->id_user;
        $peminjamanAktif = Peminjaman::where('id_user', $id_user)
                                     ->whereIn('status', ['Dipinjam', 'Disetujui', 'dipinjam', 'disetujui'])
                                     ->get();

        foreach ($peminjamanAktif as $p) {
            $p->alat = Alat::where('id_alat', $p->id_alat)->first();
        }

        return view('peminjam.pengembalian', compact('user', 'peminjamanAktif'));
    }

    public function storePeminjam(Request $request)
    {
        $currentUser = User::current();
        if (!$currentUser) return redirect(route('login'))->with('error', 'Silakan login terlebih dahulu.');

        $validatedData = $request->validate([
            'id_peminjaman'        => 'required|integer',
            'tanggal_pengembalian' => 'required|date',
            'kondisi_barang'       => 'nullable|string|max:100',
            'catatan'              => 'nullable|string',
        ]);

        $peminjaman = Peminjaman::findOrFail($validatedData['id_peminjaman']);

        // Keterlambatan dan denda dihitung otomatis
        [$hari, $denda] = $this->hitungKeterlambatan($peminjaman, $validatedData['tanggal_pengembalian']);
        $validatedData['terlambat_hari'] = $hari;
        $validatedData['denda']          = $denda;
        $validatedData['kondisi_barang'] = $validatedData['kondisi_barang'] ?? 'Baik';

        Pengembalian::create($validatedData);

        $peminjaman->update(['status' => 'Dikembalikan', 'denda' => $denda]);

        LogAktifitas::create([
            'id_user'   => $currentUser->id,
            'aktifitas' => 'Peminjam ' . ($currentUser->username ?? 'Siswa') . ' mengembalikan ' . $this->ringkas($peminjaman)
                          . ', terlambat ' . $hari . ' hari, denda Rp ' . number_format($denda, 0, ',', '.') . '.'
        ]);

        return redirect(route('peminjam.riwayat'))->with('success', 'Pengajuan pengembalian berhasil dikirim.');
    }


    // =========================================================================
    // BAGIAN 3: KHUSUS ROLE PETUGAS (PANTAU & CETAK LAPORAN)
    // =========================================================================

    public function indexPetugas(Request $request)
    {
        $user = User::current();
        if (!$user) {
            return redirect(route('login'))->with('error', 'Silakan login terlebih dahulu.');
        }

        $datap = Pengembalian::orderBy('id_pengembalian', 'desc')->paginate(10);
        
        $peminjaman = Peminjaman::all();
        $users = User::all();
        $alats = Alat::all();

        $peminjamanList = [];
        foreach ($peminjaman as $p) {
            $pid = $p->id_peminjaman ?? $p->id;
            $peminjamanList[$pid] = $p;
        }

        $userList = [];
        foreach ($users as $u) {
            $id = $u->id ?? $u->id_user;
            $userList[$id] = $u->username ?? $u->nama ?? "User #{$id}";
        }

        $alatList = [];
        foreach ($alats as $a) {
            $id = $a->id_alat ?? $a->id;
            $alatList[$id] = $a->nama_alat ?? "Alat #{$id}";
        }

        return view('petugas.pantau_pengembalian', compact('datap', 'peminjamanList', 'userList', 'alatList'));
    }

    public function cetakPetugas(Request $request)
    {
        $user = User::current();
        if (!$user) {
            return redirect(route('login'))->with('error', 'Silakan login terlebih dahulu.');
        }

        $datap = Pengembalian::orderBy('id_pengembalian', 'desc')->get();
        
        $peminjaman = Peminjaman::all();
        $users = User::all();
        $alats = Alat::all();

        $peminjamanList = [];
        foreach ($peminjaman as $p) {
            $pid = $p->id_peminjaman ?? $p->id;
            $peminjamanList[$pid] = $p;
        }

        $userList = [];
        foreach ($users as $u) {
            $id = $u->id ?? $u->id_user;
            $userList[$id] = $u->username ?? $u->nama ?? "User #{$id}";
        }

        $alatList = [];
        foreach ($alats as $a) {
            $id = $a->id_alat ?? $a->id;
            $alatList[$id] = $a->nama_alat ?? "Alat #{$id}";
        }

       return view('petugas.cetak_laporan', compact('datap', 'peminjamanList', 'userList', 'alatList', 'user'));
    }
}