@extends('layouts.app')

@section('title', 'Login')

@section('content')

    <div class="au">
        <div class="au-card">


            {{-- Panel kanan: formulir --}}
            <section class="au-main">
                <a class="au-back" href="/">&larr; Kembali ke Beranda</a>

                <span class="au-logo" aria-hidden="true">
                    <svg width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.9" stroke-linecap="round" stroke-linejoin="round"><path d="M9 18V5l12-2v13"/><circle cx="6" cy="18" r="3"/><circle cx="18" cy="16" r="3"/></svg>
                </span>
                <h1 class="au-title">Masuk</h1>
                <p class="au-sub">Gunakan akun yang sudah terdaftar di sistem.</p>

                <div class="au-demo">
                    <div class="au-demo-title">Akun Demo</div>
                    <div class="au-demo-row"><span>admin</span><code class="inline">rahasia123</code></div>
                    <div class="au-demo-row"><span>petugas</span><code class="inline">12345</code></div>
                    <div class="au-demo-row"><span>peminjam</span><code class="inline">12345</code></div>
                </div>

                <form method="POST" action="{{ route('login.attempt') }}">
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

                    <button class="btn btn-brand w-100 au-submit" type="submit">Login</button>
                </form>

                @php
                    $canRegister = false;
                    try {
                        $canRegister = \App\Models\Role::where('can_register', 1)->exists();
                    } catch (\Throwable $e) {
                        $canRegister = false;
                    }
                @endphp
                @if ($canRegister)
                    <p class="au-foot">Belum punya akun? <a href="{{ route('register') }}">Daftar di sini</a>.</p>
                @endif
            </section>


        </div>
    </div>

@endsection