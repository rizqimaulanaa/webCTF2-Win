<?php
session_start();
require_once 'config.php'; // Memanggil file konfigurasi rahasia

$auth_berhasil = false;
$pesan_error = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_id = $_POST['user_id'];
    $password = $_POST['password'];

    // Kredensial diambil dari config.php
    $real_user = "admin";
    $real_pass = DB_PASS; 

    // Skenario 1: Login Normal (Valid)
    if ($user_id === $real_user && $password === $real_pass) {
        $auth_berhasil = true;
    } 
    // Skenario 2: Simulasi Kerentanan SQL Injection yang Realistis
    elseif (strpos($user_id, "'") !== false) {
        if (strpos($user_id, "--") !== false || strpos($user_id, "#") !== false) {
            $auth_berhasil = true;
        } else {
            $pesan_error = "Warning (ODBC SQL Server Driver): Syntax error or logic failure. Pengecekan parameter 'password' masih tereksekusi dan tidak cocok.";
        }
    } 
    // Skenario 3: Gagal login biasa
    else {
        $pesan_error = "Autentikasi Gagal! ID Pegawai atau PIN salah.";
    }

    if ($auth_berhasil) {
        $_SESSION['login'] = true;
        $_SESSION['role'] = 'Admin_Pusat';
        header("Location: dashboard.php");
        exit;
    }
}
?>
<!-- (Sisa kode HTML ke bawah biarkan sama seperti sebelumnya) -->
