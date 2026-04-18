<?php
// --- TAMBAHKAN KODE INI UNTUK MELIHAT ERROR ---
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
// ----------------------------------------------
$host = "sql101.infinityfree.com";
$user = "if0_41078864";
$pass = "EqAQe6ABK0dO"; // XAMPP default password-nya kosong
$db   = "if0_41078864_sekolah"; // Nama database yang tadi Anda buat

// Melakukan koneksi
$conn = mysqli_connect($host, $user, $pass, $db);

// Cek jika koneksi gagal
if (!$conn) {
    die("Koneksi Gagal: " . mysqli_connect_error());
}
?>