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
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login - SIMPEG Internal</title>
    <style>
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; background: #005A9E; display: flex; justify-content: center; align-items: center; height: 100vh; margin: 0; }
        .login-card { background: white; width: 100%; max-width: 380px; padding: 40px 30px; border-radius: 8px; box-shadow: 0 15px 25px rgba(0,0,0,0.2); }
        .login-header { text-align: center; margin-bottom: 30px; }
        .login-header h2 { margin: 0; color: #2c3e50; font-size: 1.8em; }
        .login-header p { color: #7f8c8d; font-size: 0.9em; margin-top: 5px; }
        .form-group { margin-bottom: 20px; }
        .form-group label { display: block; color: #34495e; font-size: 0.9em; font-weight: bold; margin-bottom: 8px; }
        .form-control { width: 100%; padding: 12px; border: 1px solid #bdc3c7; border-radius: 4px; box-sizing: border-box; font-size: 1em; transition: border 0.3s; }
        .form-control:focus { border-color: #0078D7; outline: none; }
        .btn-login { width: 100%; background: #0078D7; color: white; padding: 12px; border: none; border-radius: 4px; font-size: 1em; font-weight: bold; cursor: pointer; transition: background 0.3s; margin-top: 10px; }
        .btn-login:hover { background: #005A9E; }
        .alert { background: #fadbd8; color: #c0392b; padding: 12px; border-radius: 4px; margin-bottom: 20px; font-size: 0.9em; border-left: 4px solid #c0392b; }
    </style>
</head>
<body>
    <div class="login-card">
        <div class="login-header">
            <h2>🏛️ SIMPEG</h2>
            <p>Portal Sistem Kepegawaian Internal</p>
        </div>

        <?php if($pesan_error): ?>
            <div class="alert"><?php echo htmlspecialchars($pesan_error); ?></div>
        <?php endif; ?>

        <form method="POST">
            <div class="form-group">
                <label>ID Pegawai / Username</label>
                <input type="text" name="user_id" class="form-control" required autocomplete="off">
            </div>
            <div class="form-group">
                <label>Password / PIN</label>
                <input type="password" name="password" class="form-control" required>
            </div>
            <button type="submit" class="btn-login">Masuk ke Sistem</button>
        </form>
    </div>
</body>
</html>
