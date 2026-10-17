<?php
/* 
=========================================================
SISTEM INFORMASI KEPEGAWAIAN (SIMPEG) - KONEKSI DATABASE
=========================================================
Peringatan: File ini berisi kredensial rahasia. 
Pastikan permission file dikonfigurasi dengan benar.
*/

define('DB_HOST', '127.0.0.1');
define('DB_PORT', '1433'); // Port SQL Server
define('DB_USER', 'admin_simpeg');
define('DB_PASS', 'Pusat@2024!_SuperSecret');
define('DB_NAME', 'db_simpeg_utama');

// Koneksi dinonaktifkan sementara untuk maintenance
// $conn = sqlsrv_connect(DB_HOST, array("Database"=>DB_NAME, "UID"=>DB_USER, "PWD"=>DB_PASS));
?>
