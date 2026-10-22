<?php

namespace App\Controllers\Core;

use App\Models\Peminjaman;
use App\Models\Pengembalian;
use App\Models\User;
use App\Models\Alat;
use App\Models\Kategori;
use Sakuci\Http\Request;

class DashboardController
{
    /**
     * 1. FUNGSI UTAMA / REDIRECT DINAMIS (TANPA HARDCODE IF-ELSE)
     * Mengarahkan user dari beranda langsung ke URL dashboard role mereka masing-masing
     */
    public function index(Request $request)
    {
        $user = User::current();

        if (!$user) {
            return redirect(route('login'))->with('error', 'Silakan login terlebih dahulu.');
        }

        // Ambil nama role user (contoh: 'admin', 'petugas', 'peminjam')
        $rolePath = strtolower($user->role ?? '');
        
        // Redirect dinamis ke URL sesuai rolenya tanpa perlu hardcode if-else
        return redirect('/' . $rolePath);
    }

    /**
     * 2. DASHBOARD KHUSUS ADMIN
     */
    public function admin(Request $request)
    {
        $user = User::current();
        if (!$user) return redirect(route('login'));

        $totalUser         = class_exists(User::class) ? User::count() : 0;
        $totalKategori     = class_exists(Kategori::class) ? Kategori::count() : 0; // Total Kategori Otomatis
        $totalAlat         = class_exists(Alat::class) ? Alat::count() : 0;
        $totalPeminjaman   = class_exists(Peminjaman::class) ? Peminjaman::count() : 0;
        $totalPengembalian = class_exists(Pengembalian::class) ? Pengembalian::count() : 0;

        return view('core.admin.dashboard', compact(
            'user', 'totalUser', 'totalKategori', 'totalAlat', 'totalPeminjaman', 'totalPengembalian'
        ));
    }

    /**
     * 3. DASHBOARD KHUSUS PETUGAS
     */
    public function petugas(Request $request)
    {
        $user = User::current();
        if (!$user) return redirect(route('login'));

        $semuaPeminjaman = class_exists(Peminjaman::class) ? Peminjaman::all() : [];
        
        $totalPending  = 0;
        $totalDipinjam = 0;
        $totalSelesai  = 0;

        foreach ($semuaPeminjaman as $p) {
            // Ambil status baik dari $p->status atau $p->status_peminjaman
            $rawStatus = $p->status ?? $p->status_peminjaman ?? $p->stts ?? '';
            $st = strtolower(trim((string)$rawStatus));

            // Pengecekan variasi kata status
            if (in_array($st, ['pending', 'menunggu', 'menunggu verifikasi', '0', 'wait', 'waiting'])) {
                $totalPending++;
            } elseif (in_array($st, ['dipinjam', 'disetujui', 'proses', '1', 'approved', 'active'])) {
                $totalDipinjam++;
            } elseif (in_array($st, ['dikembalikan', 'selesai', '2', 'done', 'completed'])) {
                $totalSelesai++;
            }
        }

        return view('petugas.dashboard', compact('user', 'totalPending', 'totalDipinjam', 'totalSelesai'));
    }
    
    /**
     * 4. DASHBOARD KHUSUS PEMINJAM / SISWA
     */
    public function peminjam(Request $request)
    {
        $user = User::current();
        if (!$user) return redirect(route('login'));

        $userId = $user->id ?? $user->id_user ?? null;
        $peminjamanUser = Peminjaman::where('id_user', $userId)->get();

        $pendingCount   = 0;
        $activeCount    = 0;
        $completedCount = 0;
        $totalDenda     = 0;

        foreach ($peminjamanUser as $p) {
            $st = strtolower($p->status);
            if ($st === 'pending' || $st === 'menunggu') $pendingCount++;
            elseif ($st === 'dipinjam' || $st === 'disetujui') $activeCount++;
            elseif ($st === 'dikembalikan' || $st === 'selesai') $completedCount++;

            // Denda satu peminjaman dihitung SEKALI. Kalau sudah ada data pengembalian, pakai dendanya
            // (data utama); kalau belum, pakai denda yang tercatat di peminjaman.
            $dendaItem = (int) ($p->denda ?? 0);

            if (class_exists(Pengembalian::class)) {
                $pengembalian = Pengembalian::where('id_peminjaman', $p->id_peminjaman)->first();
                if ($pengembalian) {
                    $dendaItem = (int) ($pengembalian->denda ?? 0);
                }
            }

            $totalDenda += $dendaItem;
        }

        $viewName = file_exists(base_path('resources/views/peminjam/dashboard.sakuci.php')) 
                    ? 'peminjam.dashboard' 
                    : 'dashboard';

        return view($viewName, compact('user', 'pendingCount', 'activeCount', 'completedCount', 'totalDenda'));
    }
}