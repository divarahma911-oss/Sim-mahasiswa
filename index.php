<?php
session_start();
include 'koneksi.php';

if (!isset($_SESSION['login'])) {
    header("Location: login.php");
    exit;
}

// READ - mengambil seluruh data mahasiswa terbaru di atas
$query  = "SELECT * FROM mahasiswa ORDER BY created_at DESC";
$result = $koneksi->query($query);
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Data Mahasiswa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .table-gold thead { background: linear-gradient(90deg,#d4af37,#f5d67a); color:#3b2f00; }
        .table-gold tbody tr:hover { background:#fff7e0; }
        .foto-thumb { width:60px; height:60px; object-fit:cover; border-radius:6px; }
    </style>
</head>
<body>
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3>Data Biodata Mahasiswa</h3>
        <div>
            <a href="tambah.php" class="btn btn-success">+ Tambah Data</a>
            <a href="logout.php" class="btn btn-outline-secondary">Logout</a>
        </div>
    </div>

    <table class="table table-bordered table-gold align-middle">
        <thead>
        <tr>
            <th>No</th>
            <th>Foto</th>
            <th>Nama</th>
            <th>NIM</th>
            <th>Jenis Kelamin</th>
            <th>Tempat, Tanggal Lahir</th>
            <th>Alamat</th>
            <th>Aksi</th>
        </tr>
        </thead>
        <tbody>
        <?php $no = 1; while ($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?= $no++ ?></td>
                <td>
                    <?php if (!empty($row['photo'])): ?>
                        <img src="uploads/<?= htmlspecialchars($row['photo']) ?>" class="foto-thumb">
                    <?php else: ?>
                        <span class="text-muted">-</span>
                    <?php endif; ?>
                </td>
                <td><?= htmlspecialchars($row['nama']) ?></td>
                <td><?= htmlspecialchars($row['nim']) ?></td>
                <td><?= htmlspecialchars($row['jk']) ?></td>
                <td><?= htmlspecialchars($row['tempatlahir']) ?>, <?= htmlspecialchars($row['tgllahir']) ?></td>
                <td><?= htmlspecialchars($row['alamat']) ?></td>
                <td>
                    <a href="edit.php?id=<?= $row['id'] ?>" class="btn btn-sm btn-primary">Edit</a>
                    <a href="hapus.php?id=<?= $row['id'] ?>" class="btn btn-sm btn-danger"
                       onclick="return confirm('Yakin ingin menghapus data ini?')">Hapus</a>
                </td>
            </tr>
        <?php endwhile; ?>
        </tbody>
    </table>
</div>
</body>
</html>
