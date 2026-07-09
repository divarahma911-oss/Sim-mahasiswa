<?php
// koneksi.php
// Berkas koneksi ke database MySQL/MariaDB menggunakan ekstensi MySQLi

$host     = "localhost";
$user     = "root";
$password = "";
$database = "db_mahasiswa";

$koneksi = new mysqli($host, $user, $password, $database);

// Cek koneksi
if ($koneksi->connect_error) {
    die("Koneksi database gagal: " . $koneksi->connect_error);
}

// Set charset agar aman dari masalah encoding
$koneksi->set_charset("utf8mb4");
?>
