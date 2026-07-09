<?php
session_start();
include 'koneksi.php';

if (!isset($_SESSION['login'])) { header("Location: login.php"); exit; }

$id = (int) $_GET['id'];

// Ambil nama file foto sebelum baris data dihapus
$result = $koneksi->query("SELECT photo FROM mahasiswa WHERE id=$id");
$data   = $result->fetch_assoc();

if ($data && !empty($data['photo'])) {
    $filePath = 'uploads/' . $data['photo'];
    if (file_exists($filePath)) {
        unlink($filePath); // Membersihkan file fisik dari server
    }
}

// Menghapus baris data dari database
$koneksi->query("DELETE FROM mahasiswa WHERE id=$id");

header("Location: index.php");
exit;
?>
