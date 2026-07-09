<?php
session_start();
if (!isset($_SESSION['login'])) { header("Location: login.php"); exit; }
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Data Mahasiswa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-4">
    <h3>Tambah Data Mahasiswa</h3>
    <form action="proses.php" method="POST" enctype="multipart/form-data">
        <div class="mb-3">
            <label class="form-label">Nama</label>
            <input type="text" name="nama" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">NIM</label>
            <input type="text" name="nim" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Jenis Kelamin</label>
            <select name="jk" class="form-select" required>
                <option value="Laki-laki">Laki-laki</option>
                <option value="Perempuan">Perempuan</option>
            </select>
        </div>
        <div class="mb-3">
            <label class="form-label">Tempat Lahir</label>
            <input type="text" name="tempatlahir" class="form-control" required>
        </div>
        <div class="row mb-3">
            <div class="col">
                <label class="form-label">Tanggal</label>
                <input type="number" name="tgl" min="1" max="31" class="form-control" required>
            </div>
            <div class="col">
                <label class="form-label">Bulan</label>
                <input type="number" name="bulan" min="1" max="12" class="form-control" required>
            </div>
            <div class="col">
                <label class="form-label">Tahun</label>
                <input type="number" name="tahun" min="1900" max="2100" class="form-control" required>
            </div>
        </div>
        <div class="mb-3">
            <label class="form-label">Alamat</label>
            <textarea name="alamat" class="form-control" required></textarea>
        </div>
        <div class="mb-3">
            <label class="form-label">Foto</label>
            <input type="file" name="photo" class="form-control" accept="image/*">
        </div>
        <button type="submit" class="btn btn-warning">Simpan</button>
        <a href="index.php" class="btn btn-secondary">Batal</a>
    </form>
</div>
</body>
</html>
