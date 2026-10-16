<?php
session_start();

// Menghapus semua variabel sesi
session_unset();

// Menghancurkan sesi sepenuhnya
session_destroy();

// Mengarahkan pengguna kembali ke halaman login
header("Location: login.php");
exit;
?>
