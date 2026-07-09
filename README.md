# Sistem Manajemen Biodata Mahasiswa (CRUD)

Laporan Praktikum Web Development (3 SKS) — Universitas PGRI Sumatera Barat
Nama: Diva Rahma Nabila | NIM: 2202070048 | Prodi: Pendidikan Sosiologi

## Deskripsi
Aplikasi CRUD (Create, Read, Update, Delete) biodata mahasiswa menggunakan PHP Native
dan MySQL/MariaDB, dengan validasi server-side dan tampilan tabel bertema Bootstrap 5
(.table-gold).

## Struktur Berkas
- `koneksi.php` — koneksi ke database
- `login.php` — halaman login admin
- `index.php` — menampilkan daftar data mahasiswa (Read)
- `tambah.php` — form tambah data
- `proses.php` — proses simpan data (Create) + validasi
- `edit.php` — form & proses ubah data (Update)
- `hapus.php` — proses hapus data (Delete)
- `logout.php` — logout sesi
- `db_mahasiswa.sql` — skema basis data
- `uploads/` — folder penyimpanan foto mahasiswa

## Cara Menjalankan
1. Jalankan XAMPP/Laragon, aktifkan Apache & MySQL.
2. Import `db_mahasiswa.sql` melalui phpMyAdmin.
3. Salin seluruh berkas ke folder `htdocs/sim-mahasiswa/`.
4. Akses `http://localhost/sim-mahasiswa/login.php` (username: `admin`, password: `admin123`).
