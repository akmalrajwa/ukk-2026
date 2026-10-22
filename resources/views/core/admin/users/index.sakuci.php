@extends('layouts.app')

@section('title', 'Manage User')

@section('content')

    <div class="d-flex align-items-center justify-content-between mb-4">
        <div>
            <span class="badge rounded-pill badge-brand px-3 py-2 mb-2">Area Admin</span>
            <h1 class="h4 mb-0">Manage User</h1>
        </div>
        <a href="{{ route('admin.dashboard') }}" class="btn btn-sm btn-outline-secondary">&larr; Kembali</a>
    </div>

    <div class="row g-4">
        <!-- Form Tambah User Baru -->
        <div class="col-md-5">
            <div class="card border-0 shadow-sm">
                <div class="card-body p-4">
                    <h2 class="h6 mb-3">Tambah User Baru</h2>

                    <form method="POST" action="{{ route('admin.users.store') }}">
                        @csrf

                        <div class="mb-3">
                            <label class="form-label" for="username">Username</label>
                            <input type="text" id="username" name="username" value="{{ old('username') }}" class="form-control {{ errors()->has('username') ? 'is-invalid' : '' }}" autofocus>
                            @error('username') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label" for="password">Password</label>
                            <input type="password" id="password" name="password" class="form-control {{ errors()->has('password') ? 'is-invalid' : '' }}">
                            @error('password') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label" for="role">Role</label>
                            <select id="role" name="role" class="form-select {{ errors()->has('role') ? 'is-invalid' : '' }}">
                                @foreach ($roles as $roleOption)
                                    <option value="{{ $roleOption->name }}" @if (old('role') === $roleOption->name) selected @endif>{{ $roleOption->name }}</option>
                                @endforeach
                            </select>
                            @error('role') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            <div class="form-text">Butuh role lain? Tambahkan dulu di <a href="{{ route('admin.roles.index') }}">Manage Role</a>.</div>
                        </div>

                        <button class="btn btn-brand w-100" type="submit">Tambah User</button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Tabel Daftar User -->
        <div class="col-md-7">
            <div class="card border-0 shadow-sm">
                <div class="card-body p-4">
                    <h2 class="h6 mb-3">Daftar User</h2>

                    <table class="table table-sm align-middle mb-0">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Username</th>
                                <th>Role</th>
                                <th class="text-center">AKSI</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $no = 1; @endphp
                            @forelse ($users as $item)
                                @php $userId = $item->id ?? $item->id_user; @endphp
                                <tr>
                                    <td>{{ $no }}</td>
                                    <td>{{ $item->username }}</td>
                                    <td><code class="inline">{{ $item->role }}</code></td>
                                    <td class="text-center">
                                        @if ($no === 1)
                                            <!-- Pengecekan Khusus Akun Utama / Master Admin -->
                                            <span class="badge bg-secondary-subtle text-secondary rounded-pill border px-3 py-1.5 small">
                                                <i class="bi bi-lock-fill me-1"></i> Akun Utama
                                            </span>
                                        @else
                                            <div class="d-flex justify-content-center gap-2">
                                                <!-- Tombol Edit (Membuka Modal Pop-up) -->
                                                <button type="button" class="btn btn-sm btn-outline-primary px-3 py-1 rounded-3" 
                                                        data-bs-toggle="modal" data-bs-target="#editUserModal{{ $userId }}">
                                                    <i class="bi bi-pencil-square me-1"></i> Edit
                                                </button>

                                                <!-- Tombol Hapus -->
                                                <form action="{{ route('admin.users.destroy', ['id' => $userId]) }}" 
                                                      method="POST" class="d-inline" 
                                                      onsubmit="return confirm('Yakin ingin menghapus user ini?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-outline-danger px-3 py-1 rounded-3">
                                                        <i class="bi bi-trash me-1"></i> Hapus
                                                    </button>
                                                </form>
                                            </div>

                                            <!-- MODAL POPUP EDIT USER -->
                                            <div class="modal fade text-start" id="editUserModal{{ $userId }}" tabindex="-1" aria-labelledby="editUserModalLabel{{ $userId }}" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered">
                                                    <div class="modal-content bg-dark text-white border-secondary">
                                                        <div class="modal-header border-secondary">
                                                            <h5 class="modal-title h6" id="editUserModalLabel{{ $userId }}">
                                                                Edit User: <span class="fw-bold">{{ $item->username }}</span>
                                                            </h5>
                                                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <form method="POST" action="{{ route('admin.users.update', ['id' => $userId]) }}">
                                                            @csrf
                                                            @method('PUT')
                                                            <div class="modal-body">
                                                                <div class="mb-3">
                                                                    <label class="form-label text-white-50 small" for="username_{{ $userId }}">Username</label>
                                                                    <input type="text" id="username_{{ $userId }}" name="username" value="{{ old('username', $item->username) }}" class="form-control bg-dark text-white border-secondary" required>
                                                                </div>

                                                                <div class="mb-3">
                                                                    <label class="form-label text-white-50 small" for="password_{{ $userId }}">
                                                                        Password Baru <span class="text-white-50">(Kosongkan jika tidak ingin diubah)</span>
                                                                    </label>
                                                                    <input type="password" id="password_{{ $userId }}" name="password" class="form-control bg-dark text-white border-secondary" placeholder="••••••">
                                                                </div>

                                                                <div class="mb-3">
                                                                    <label class="form-label text-white-50 small" for="role_{{ $userId }}">Role</label>
                                                                    <select id="role_{{ $userId }}" name="role" class="form-select bg-dark text-white border-secondary">
                                                                        @foreach ($roles as $roleOption)
                                                                            <option value="{{ $roleOption->name }}" @if (old('role', $item->role) === $roleOption->name) selected @endif>
                                                                                {{ $roleOption->name }}
                                                                            </option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer border-secondary">
                                                                <button type="button" class="btn btn-secondary btn-sm px-3" data-bs-dismiss="modal">Batal</button>
                                                                <button type="submit" class="btn btn-primary btn-sm px-3">Simpan Perubahan</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- END MODAL -->
                                        @endif
                                    </td>
                                </tr>
                                @php $no++; @endphp
                            @empty
                                <tr>
                                    <td colspan="4" class="text-secondary text-center py-3">Belum ada user.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

@endsection