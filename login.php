<?php
session_start();

// Simulasi perilaku Database
$auth_berhasil = false;
$pesan_error = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_id = $_POST['user_id'];
    $password = $_POST['password'];

    // VULNERABILITY: SQL Injection (Auth Bypass)
    // Server menerima input ' OR '1'='1 dan memprosesnya sebagai True
    if (strpos($user_id, "' OR '1'='1") !== false || $user_id === "admin") {
        $auth_berhasil = true;
    }

    if ($auth_berhasil) {
        $_SESSION['login'] = true;
        $_SESSION['role'] = 'Admin_Pusat';
        header("Location: dashboard.php");
        exit;
    } else {
        $pesan_error = "Autentikasi Gagal! User ID atau Password salah.";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Login - SIMPEG Internal</title>
    <style>
        body { font-family: 'Segoe UI', sans-serif; background: #0078D7; color: white; text-align: center; padding-top: 100px; }
        .login-box { background: white; color: black; width: 350px; margin: auto; padding: 30px; border-radius: 5px; box-shadow: 0 4px 10px rgba(0,0,0,0.3); }
        input { width: 90%; padding: 10px; margin: 10px 0; }
        button { background: #005A9E; color: white; padding: 10px 20px; border: none; cursor: pointer; width: 100%; }
    </style>
</head>
<body>
    <div class="login-box">
        <h2 style="margin-top:0;">SIMPEG v2.0</h2>
        <p style="color: gray; font-size: 12px;">Windows IIS / PHP 4.7 Legacy Environment</p>
        
        <?php if($pesan_error): ?>
            <div style="color: red; margin-bottom: 15px;"><?php echo $pesan_error; ?></div>
        <?php endif; ?>

        <form method="POST">
            <input type="text" name="user_id" placeholder="User ID" required>
            <input type="password" name="password" placeholder="Password (PIN)" required>
            <button type="submit">LOGIN SYSTEM</button>
        </form>
    </div>
</body>
</html>
