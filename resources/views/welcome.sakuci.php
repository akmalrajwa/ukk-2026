@extends('layouts.app')

@section('title', config('app.name') . ' — Sistem Peminjaman Alat Musik Sekolah')

@section('content')

<div class="mh">

    {{-- ===== HERO ===== --}}
    <section class="mh-hero shadow-sm">
        <div class="mh-hero-inner">
            <div class="row align-items-center g-5">
                <div class="col-lg-8">
                    <span class="mh-eyebrow">Ruang Musik Sekolah</span>
                    <h1>Pinjam alat musik,<br><em>mainkan</em> tanpa ribet.</h1>
                    <p class="lead">
                        Sistem peminjaman alat musik sekolah yang mencatat siapa meminjam apa, kapan harus kembali,
                        dan bagaimana kondisi alatnya, semuanya tersimpan rapi dalam satu tempat.
                    </p>
                    <div class="d-flex flex-wrap gap-3 mt-4">
                        <a class="mh-btn mh-btn-light" href="{{ route('login') }}">Masuk Sistem</a>
                        <a class="mh-btn mh-btn-line" href="#alur">Lihat Cara Pinjam</a>
                    </div>
                </div>

            </div>
        </div>
    </section>

    {{-- ===== KEUNGGULAN ===== --}}
    <section class="mh-sec">
        <span class="mh-kicker">Keunggulan</span>
        <h2 class="mh-title">Kenapa Pakai Sistem Ini?</h2>
        <div class="row row-cols-1 row-cols-md-2 row-cols-xl-4 g-3 mt-1">
            <div class="col">
                <div class="mh-fact">
                    <span class="ico"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><rect x="5" y="4" width="14" height="17" rx="2"/><path d="M9 4V3h6v1"/><path d="m9 13 2 2 4-4"/></svg></span>
                    <div><b>Pencatatan Otomatis</b><span>Setiap pinjam dan kembali tercatat sendiri, tanpa buku manual.</span></div>
                </div>
            </div>
            <div class="col">
                <div class="mh-fact">
                    <span class="ico"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="7"/><path d="m20 20-3.5-3.5"/></svg></span>
                    <div><b>Status Pengajuan Jelas</b><span>Pantau status pengajuan Anda: Pending, Disetujui, Ditolak, atau Dikembalikan.</span></div>
                </div>
            </div>
            <div class="col">
                <div class="mh-fact">
                    <span class="ico"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M3 12a9 9 0 1 0 3-6.7"/><path d="M3 4v5h5"/><path d="M12 8v4l3 2"/></svg></span>
                    <div><b>Riwayat Tersimpan</b><span>Riwayat peminjaman bisa dilihat kembali oleh peminjam dan petugas.</span></div>
                </div>
            </div>
            <div class="col">
                <div class="mh-fact">
                    <span class="ico"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="5" width="18" height="16" rx="2"/><path d="M3 10h18M8 3v4M16 3v4"/></svg></span>
                    <div><b>Jadwal Latihan Teratur</b><span>Batas kembali yang jelas menjaga giliran pakai tetap adil.</span></div>
                </div>
            </div>
        </div>
    </section>

    {{-- ===== KATEGORI ===== --}}
    <section class="mh-sec">
        <span class="mh-kicker">Koleksi</span>
        <h2 class="mh-title">Empat Kategori Alat Musik</h2>
        <p class="mh-sub">Semua inventaris ruang musik dikelompokkan agar mudah dicari dan dicek ketersediaannya.</p>

        <div class="row row-cols-1 row-cols-md-2 row-cols-xl-4 g-3 mt-2">
            <div class="col">
                <div class="mh-cat">
                    <div class="no">01</div>
                    <h3>Alat Musik Melodis</h3>
                    <p>Pembawa melodi utama sebuah lagu dengan nada tinggi maupun rendah.</p>
                    <span class="mh-chip">Biola</span><span class="mh-chip">Pianika</span><span class="mh-chip">Flute</span><span class="mh-chip">Saxophone</span><span class="mh-chip">Gitar Akustik</span>
                </div>
            </div>
            <div class="col">
                <div class="mh-cat">
                    <div class="no">02</div>
                    <h3>Alat Musik Harmonis</h3>
                    <p>Dapat membunyikan tiga nada atau lebih sekaligus (akord) untuk mengiringi lagu.</p>
                    <span class="mh-chip">Keyboard</span><span class="mh-chip">Piano</span><span class="mh-chip">Gitar Elektrik</span><span class="mh-chip">Ukulele</span>
                </div>
            </div>
            <div class="col">
                <div class="mh-cat">
                    <div class="no">03</div>
                    <h3>Alat Musik Ritmis</h3>
                    <p>Penentu ketukan, tempo, dan keteraturan irama dalam permainan kelompok.</p>
                    <span class="mh-chip">Drum Set</span><span class="mh-chip">Cajon</span><span class="mh-chip">Tamborin</span><span class="mh-chip">Simbal</span><span class="mh-chip">Bongo</span>
                </div>
            </div>
            <div class="col">
                <div class="mh-cat">
                    <div class="no">04</div>
                    <h3>Perlengkapan Pendukung</h3>
                    <p>Aksesori dan perangkat suara yang menunjang latihan maupun pentas.</p>
                    <span class="mh-chip">Mikrofon</span><span class="mh-chip">Speaker</span><span class="mh-chip">Stand</span><span class="mh-chip">Kabel</span><span class="mh-chip">Amplifier</span>
                </div>
            </div>
        </div>
    </section>

    {{-- ===== ALUR ===== --}}
    <section class="mh-sec" id="alur">
        <div class="mh-flow">
            <div class="text-center mb-4">
                <span class="mh-kicker">Alur Peminjaman</span>
                <h2 class="mh-title">Empat Langkah dari Pinjam sampai Kembali</h2>
            </div>
            <div class="row g-4">
                <div class="col-md-6 col-lg-3 mh-step">
                    <div class="dot">1</div>
                    <h3>Masuk &amp; Cari Alat</h3>
                    <p>Login dengan akun terdaftar, lalu lihat daftar alat beserta status ketersediaannya.</p>
                </div>
                <div class="col-md-6 col-lg-3 mh-step">
                    <div class="dot">2</div>
                    <h3>Ajukan Peminjaman</h3>
                    <p>Isi formulir: alat yang dipilih, keperluan, tanggal pinjam, dan rencana pengembalian.</p>
                </div>
                <div class="col-md-6 col-lg-3 mh-step">
                    <div class="dot">3</div>
                    <h3>Verifikasi Petugas</h3>
                    <p>Petugas menyetujui pengajuan, lalu mengecek kondisi alat bersama peminjam saat serah terima.</p>
                </div>
                <div class="col-md-6 col-lg-3 mh-step">
                    <div class="dot">4</div>
                    <h3>Kembalikan Alat</h3>
                    <p>Alat dikembalikan tepat waktu, kondisinya dicek ulang, dan riwayat otomatis tercatat.</p>
                </div>
            </div>
        </div>
    </section>

    {{-- ===== PERAN & STATUS ===== --}}
    <section class="mh-sec">
        <div class="row g-3">
            <div class="col-lg-6">
                <div class="mh-box">
                    <span class="mh-kicker">Pengguna</span>
                    <h3>Siapa Saja yang Terlibat?</h3>
                    <div class="mh-role">
                        <div class="badge-r">A</div>
                        <div><b>Admin</b><span>Mengelola data alat, kategori, dan akun pengguna.</span></div>
                    </div>
                    <div class="mh-role">
                        <div class="badge-r">P</div>
                        <div><b>Petugas</b><span>Memverifikasi pengajuan, melayani serah terima, dan mencatat pengembalian.</span></div>
                    </div>
                    <div class="mh-role">
                        <div class="badge-r">S</div>
                        <div><b>Peminjam</b><span>Siswa yang mengajukan peminjaman dan memantau riwayatnya.</span></div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="mh-box">
                    <span class="mh-kicker">Status</span>
                    <h3>Memantau Posisi Peminjaman</h3>
                    <div class="mh-status"><i style="background:#e0a100"></i><div><b>Pending</b><span>Pengajuan masuk dan belum diperiksa petugas.</span></div></div>
                    <div class="mh-status"><i style="background:#1b7a3a"></i><div><b>Disetujui</b><span>Pengajuan diterima, alat siap diambil dan dipakai.</span></div></div>
                    <div class="mh-status"><i style="background:#6b5a5c"></i><div><b>Dikembalikan</b><span>Alat sudah kembali dan kondisinya tercatat.</span></div></div>
                    <div class="mh-status"><i style="background:#c1121f"></i><div><b>Terlambat / Ditolak</b><span>Melewati batas kembali, atau pengajuan tidak disetujui.</span></div></div>
                </div>
            </div>
        </div>
    </section>

    {{-- ===== TATA TERTIB ===== --}}
    <section class="mh-sec">
        <div class="mh-rules">
            <span class="mh-kicker" style="color:#ff8d8d">Ketentuan</span>
            <h2 class="mh-title">Tata Tertib Peminjaman</h2>
            <p class="mh-sub mb-4">Aturan singkat agar alat tetap awet dan semua orang kebagian jadwal latihan.</p>
            <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-3">
                <div class="col"><div class="mh-rule"><div class="n">01</div><h3>Akun Terdaftar</h3><p>Siswa dan staf wajib punya akun aktif di sistem sebelum mengajukan pinjaman.</p></div></div>
                <div class="col"><div class="mh-rule"><div class="n">02</div><h3>Cek Fisik &amp; Fungsi</h3><p>Periksa senar, kabel, dan kelengkapan bersama petugas sebelum alat dibawa keluar ruangan.</p></div></div>
                <div class="col"><div class="mh-rule"><div class="n">03</div><h3>Kembali Tepat Waktu</h3><p>Patuhi batas tanggal dan jam yang disepakati supaya pengguna lain tidak terganggu.</p></div></div>
                <div class="col"><div class="mh-rule"><div class="n">04</div><h3>Tanggung Jawab Alat</h3><p>Kerusakan atau kehilangan selama masa pinjam menjadi tanggung jawab peminjam.</p></div></div>
                <div class="col"><div class="mh-rule"><div class="n">05</div><h3>Gunakan Sewajarnya</h3><p>Alat dipakai untuk latihan, tugas seni, atau kegiatan sekolah, bukan untuk dipindahtangankan.</p></div></div>
                <div class="col"><div class="mh-rule"><div class="n">06</div><h3>Denda Keterlambatan</h3><p>Keterlambatan mengembalikan alat dikenai denda sesuai jumlah hari keterlambatan.</p></div></div>
            </div>
        </div>
    </section>

    {{-- ===== INFO LAYANAN ===== --}}
    <section class="mh-sec">
        <div class="row g-3">
            <div class="col-md-6">
                <div class="mh-info">
                    <h3>Jam Operasional</h3>
                    <p class="mb-2">Layanan peminjaman dan pengembalian dilakukan pada jam sekolah.</p>
                    <ul>
                        <li>Setiap hari sekolah, 07.30 – 16:00</li>
                        <li>Pengembalian dilayani sampai jam operasional berakhir</li>
                    </ul>
                </div>
            </div>
            <div class="col-md-6">
                <div class="mh-info" style="background: var(--mh-red-dark)">
                    <h3>Yang Perlu Disiapkan</h3>
                    <p class="mb-2">Agar proses cepat, pastikan hal berikut sebelum datang ke ruang musik.</p>
                    <ul>
                        <li>Akun sudah aktif dan pengajuan berstatus Disetujui</li>
                        <li>Mengetahui alat dan lama pinjam yang dibutuhkan</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    {{-- ===== FAQ ===== --}}
    <section class="mh-sec mh-faq mb-5">
        <span class="mh-kicker">Tanya Jawab</span>
        <h2 class="mh-title mb-3">Pertanyaan yang Sering Muncul</h2>
        <details>
            <summary>Apakah saya perlu mendaftar dulu?</summary>
            <p>Ya. Peminjam harus memiliki akun aktif di sistem sebelum bisa mengajukan peminjaman alat.</p>
        </details>
        <details>
            <summary>Bagaimana kalau alat yang saya mau sedang dipinjam?</summary>
            <p>Pilih alat lain atau ajukan lagi setelah alat dikembalikan.</p>
        </details>
        <details>
            <summary>Bagaimana jika alat rusak saat saya pinjam?</summary>
            <p>Segera laporkan ke petugas. Kerusakan selama masa pinjam menjadi tanggung jawab peminjam sesuai tata tertib.</p>
        </details>
        <details>
            <summary>Bisakah alat dipinjam sampai di luar jam sekolah?</summary>
            <p>Lama dan batas pinjam mengikuti kesepakatan saat pengajuan disetujui petugas.</p>
        </details>
    </section>


</div>

@endsection