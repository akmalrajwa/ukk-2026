<?php

namespace App\Controllers\Core;

use App\Models\Role;
use App\Models\User;
use App\Models\Peminjaman;
use Sakuci\Controller;
use Sakuci\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        return view('core.admin.users.index', [
            'users' => User::orderBy('id', 'asc')->get(),
            'roles' => Role::orderBy('name')->get(),
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'username' => 'required|min:3|max:50|alpha_dash|unique:users,username',
            'password' => 'required|min:6',
            'role'     => 'required|exists:roles,name',
        ]);

        // min:6 di validator dianggap nilai angka kalau isinya angka (999 lolos). Cek panjang karakter manual.
        if (strlen((string) $data['password']) < 6) {
            return redirect(route('admin.users.index'))->with('error', 'Password minimal 6 karakter.');
        }

        User::create([
            'username' => $data['username'],
            'password' => password_hash($data['password'], PASSWORD_DEFAULT),
            'role'     => $data['role'],
        ]);

        return redirect(route('admin.users.index'))->with('success', 'User "' . $data['username'] . '" berhasil ditambahkan.');
    }

    // --- FUNGSI EDIT USER ---
    public function edit($id)
    {
        $userToEdit = User::find($id);
        if (!$userToEdit) {
            return redirect(route('admin.users.index'))->with('error', 'User tidak ditemukan.');
        }

        return view('core.admin.users.index', [
            'users'      => User::orderBy('id', 'asc')->get(),
            'roles'      => Role::orderBy('name')->get(),
            'userToEdit' => $userToEdit, // Dikirim ke view untuk mengisi form edit
        ]);
    }

    // --- FUNGSI UPDATE USER ---
    public function update(Request $request, $id)
    {
        $user = User::find($id);
        if (!$user) {
            return redirect(route('admin.users.index'))->with('error', 'User tidak ditemukan.');
        }

        $data = $request->validate([
            'username' => 'required|min:3|max:50|alpha_dash|unique:users,username,' . $id,
            'role'     => 'required|exists:roles,name',
        ]);

        $updateData = [
            'username' => $data['username'],
            'role'     => $data['role'],
        ];

        // Jika password diisi, baru di-update
        if ($request->input('password')) {
            if (strlen((string) $request->input('password')) < 6) {
                return redirect(route('admin.users.index'))->with('error', 'Password minimal 6 karakter.');
            }
            $updateData['password'] = password_hash($request->input('password'), PASSWORD_DEFAULT);
        }

        $user->update($updateData);

        return redirect(route('admin.users.index'))->with('success', 'User "' . $user->username . '" berhasil diperbarui.');
    }

    // --- FUNGSI HAPUS USER ---
    public function destroy($id)
    {
        $user = User::find($id);
        if (!$user) {
            return redirect(route('admin.users.index'))->with('error', 'User tidak ditemukan.');
        }

        // User yang masih punya data peminjaman tidak boleh dihapus,
        // supaya riwayat peminjaman, pengembalian, dan denda tidak ikut hilang.
        $jumlahPeminjaman = Peminjaman::where('id_user', $user->id)->count();
        if ($jumlahPeminjaman > 0) {
            return redirect(route('admin.users.index'))->with('error', 'User "' . $user->username . '" tidak bisa dihapus karena masih punya ' . $jumlahPeminjaman . ' data peminjaman. Hapus data peminjamannya terlebih dahulu.');
        }

        $username = $user->username;
        $user->delete();

        return redirect(route('admin.users.index'))->with('success', 'User "' . $username . '" berhasil dihapus.');
    }
}