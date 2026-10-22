@extends('layouts.app')

@section('title', 'Daftar')

@section('content')

    <div class="au">
        <div class="au-card">


            {{-- Panel kanan: formulir --}}
            <section class="au-main">
                <a class="au-back" href="/">&larr; Kembali ke Beranda</a>

                <span class="au-logo" aria-hidden="true">
                    <svg width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.9" stroke-linecap="round" stroke-linejoin="round"><path d="M9 18V5l12-2v13"/><circle cx="6" cy="18" r="3"/><circle cx="18" cy="16" r="3"/></svg>
                </span>
                <h1 class="au-title">Daftar Akun</h1>
                <p class="au-sub">Sudah punya akun? <a href="{{ route('login') }}">Masuk di sini</a>.</p>

                <form method="POST" action="{{ route('register.attempt') }}">
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
                        <label class="form-label" for="password_confirmation">Konfirmasi Password</label>
                        <input type="password" id="password_confirmation" name="password_confirmation" class="form-control">
                    </div>

                    @if (count($roles) > 1)
                        <div class="mb-3">
                            <label class="form-label" for="role">Daftar sebagai</label>
                            <select id="role" name="role" class="form-select {{ errors()->has('role') ? 'is-invalid' : '' }}">
                                @foreach ($roles as $role)
                                    <option value="{{ $role->name }}" {{ old('role') === $role->name ? 'selected' : '' }}>{{ $role->name }}</option>
                                @endforeach
                            </select>
                            @error('role') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                    @else
                        <input type="hidden" name="role" value="{{ $roles[0]->name }}">
                    @endif

                    <button class="btn btn-brand w-100 au-submit" type="submit">Daftar</button>
                </form>
            </section>


        </div>
    </div>

@endsection