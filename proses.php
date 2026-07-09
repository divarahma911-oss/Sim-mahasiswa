<?php
session_start();
include 'koneksi.php';

if (!isset($_SESSION['login'])) { header("Location: login.php"); exit; }

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // 1. Pembersihan input teks (mencegah SQL Injection)
    $nama        = $koneksi->real_escape_string(trim($_POST['nama']));
    $nim         = $koneksi->real_escape_string(trim($_POST['nim']));
    $jk          = $koneksi->real_escape_string(trim($_POST['jk']));
    $tempatlahir = $koneksi->real_escape_string(trim($_POST['tempatlahir']));
    $alamat      = $koneksi->real_escape_string(trim($_POST['alamat']));

    // 2. Standarisasi tanggal lahir menjadi format ISO 8601 (YYYY-MM-DD)
    $tgl    = (int) $_POST['tgl'];
    $bulan  = (int) $_POST['bulan'];
    $tahun  = (int) $_POST['tahun'];
    $tgllahir = sprintf('%04d-%02d-%02d', $tahun, $bulan, $tgl);

    // 3. Penanganan upload foto
    $photoName = "";
    if (isset($_FILES['photo']) && $_FILES['photo']['error'] === UPLOAD_ERR_OK) {
        $tmpName  = $_FILES['photo']['tmp_name'];
        $ext      = pathinfo($_FILES['photo']['name'], PATHINFO_EXTENSION);
        // Penamaan file acak unik agar tidak ada file yang tertimpa
        $photoName = time() . '_' . uniqid() . '.' . $ext;
        move_uploaded_file($tmpName, 'uploads/' . $photoName);
    }

    // 4. Simpan ke database
    $query = "INSERT INTO mahasiswa (nama, nim, jk, tempatlahir, tgllahir, alamat, photo, created_at)
              VALUES ('$nama', '$nim', '$jk', '$tempatlahir', '$tgllahir', '$alamat', '$photoName', NOW())";

    if ($koneksi->query($query)) {
        header("Location: index.php");
        exit;
    } else {
        echo "Gagal menyimpan data: " . $koneksi->error;
    }
}
?>
