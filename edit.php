<?php
session_start();
include 'koneksi.php';

if (!isset($_SESSION['login'])) { header("Location: login.php"); exit; }

$id = (int) $_GET['id'];

// Proses UPDATE ketika form disubmit
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama        = $koneksi->real_escape_string(trim($_POST['nama']));
    $nim         = $koneksi->real_escape_string(trim($_POST['nim']));
    $jk          = $koneksi->real_escape_string(trim($_POST['jk']));
    $tempatlahir = $koneksi->real_escape_string(trim($_POST['tempatlahir']));
    $alamat      = $koneksi->real_escape_string(trim($_POST['alamat']));

    $tgl   = (int) $_POST['tgl'];
    $bulan = (int) $_POST['bulan'];
    $tahun = (int) $_POST['tahun'];
    $tgllahir = sprintf('%04d-%02d-%02d', $tahun, $bulan, $tgl);

    $photoUpdate = "";
    if (isset($_FILES['photo']) && $_FILES['photo']['error'] === UPLOAD_ERR_OK) {
        $ext = pathinfo($_FILES['photo']['name'], PATHINFO_EXTENSION);
        $photoName = time() . '_' . uniqid() . '.' . $ext;
        move_uploaded_file($_FILES['photo']['tmp_name'], 'uploads/' . $photoName);
        $photoUpdate = ", photo='$photoName'";
    }

    $query = "UPDATE mahasiswa SET nama='$nama', nim='$nim', jk='$jk',
              tempatlahir='$tempatlahir', tgllahir='$tgllahir', alamat='$alamat'
              $photoUpdate WHERE id=$id";

    $koneksi->query($query);
    header("Location: index.php");
    exit;
}

// Mengambil data lama berdasarkan ID
$result = $koneksi->query("SELECT * FROM mahasiswa WHERE id=$id");
$data   = $result->fetch_assoc();
$tgllahirParts = explode('-', $data['tgllahir']);
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Data Mahasiswa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-4">
    <h3>Edit Data Mahasiswa</h3>
    <form action="edit.php?id=<?= $id ?>" method="POST" enctype="multipart/form-data">
        <div class="mb-3">
            <label class="form-label">Nama</label>
            <input type="text" name="nama" class="form-control" value="<?= htmlspecialchars($data['nama']) ?>" required>
        </div>
        <div class="mb-3">
            <label class="form-label">NIM</label>
            <input type="text" name="nim" class="form-control" value="<?= htmlspecialchars($data['nim']) ?>" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Jenis Kelamin</label>
            <select name="jk" class="form-select" required>
                <option value="Laki-laki" <?= $data['jk']=='Laki-laki'?'selected':'' ?>>Laki-laki</option>
                <option value="Perempuan" <?= $data['jk']=='Perempuan'?'selected':'' ?>>Perempuan</option>
            </select>
        </div>
        <div class="mb-3">
            <label class="form-label">Tempat Lahir</label>
            <input type="text" name="tempatlahir" class="form-control" value="<?= htmlspecialchars($data['tempatlahir']) ?>" required>
        </div>
        <div class="row mb-3">
            <div class="col">
                <label class="form-label">Tanggal</label>
                <input type="number" name="tgl" class="form-control" value="<?= (int)$tgllahirParts[2] ?>" required>
            </div>
            <div class="col">
                <label class="form-label">Bulan</label>
                <input type="number" name="bulan" class="form-control" value="<?= (int)$tgllahirParts[1] ?>" required>
            </div>
            <div class="col">
                <label class="form-label">Tahun</label>
                <input type="number" name="tahun" class="form-control" value="<?= (int)$tgllahirParts[0] ?>" required>
            </div>
        </div>
        <div class="mb-3">
            <label class="form-label">Alamat</label>
            <textarea name="alamat" class="form-control" required><?= htmlspecialchars($data['alamat']) ?></textarea>
        </div>
        <div class="mb-3">
            <label class="form-label">Ganti Foto (opsional)</label>
            <input type="file" name="photo" class="form-control" accept="image/*">
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
        <a href="index.php" class="btn btn-secondary">Batal</a>
    </form>
</div>
</body>
</html>
