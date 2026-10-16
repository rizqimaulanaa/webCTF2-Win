<?php
session_start();
if (!isset($_SESSION['login'])) {
    header("Location: login.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard - SIMPEG Internal</title>
    <style>
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; background-color: #f4f6f9; margin: 0; }
        .navbar { background-color: #005A9E; color: white; padding: 15px 25px; display: flex; justify-content: space-between; align-items: center; box-shadow: 0 2px 4px rgba(0,0,0,0.1); }
        .navbar-brand { font-size: 1.4em; font-weight: bold; letter-spacing: 1px; }
        .navbar-user { font-size: 0.9em; }
        .navbar a { color: white; text-decoration: none; padding: 6px 12px; border-radius: 4px; background: #0078D7; transition: background 0.3s; margin-left: 15px; font-weight: bold;}
        .navbar a:hover { background: #004578; }
        .container { max-width: 900px; margin: 40px auto; padding: 0 20px; }
        .welcome-card { background: white; padding: 25px 30px; border-radius: 8px; box-shadow: 0 2px 5px rgba(0,0,0,0.05); margin-bottom: 30px; border-left: 5px solid #005A9E; }
        .welcome-card h2 { margin-top: 0; color: #2c3e50; }
        .welcome-card p { color: #7f8c8d; margin-bottom: 0; }
        .menu-grid { display: flex; gap: 25px; }
        .menu-card { flex: 1; background: white; padding: 30px 20px; border-radius: 8px; box-shadow: 0 2px 5px rgba(0,0,0,0.05); text-align: center; border: 1px solid #ecf0f1; transition: all 0.2s; }
        .menu-card:hover { transform: translateY(-5px); box-shadow: 0 8px 15px rgba(0,0,0,0.1); border-color: #bdc3c7; }
        .menu-icon { font-size: 45px; margin-bottom: 15px; }
        .menu-card h3 { margin: 0 0 10px 0; color: #2c3e50; }
        .menu-card p { color: #7f8c8d; font-size: 0.9em; margin-bottom: 25px; min-height: 40px;}
        .btn { display: inline-block; background: #0078D7; color: white; text-decoration: none; padding: 10px 25px; border-radius: 4px; transition: background 0.3s; font-weight: 500;}
        .btn:hover { background: #005A9E; }
    </style>
</head>
<body>
    <div class="navbar">
        <div class="navbar-brand">🏛️ SIMPEG Internal</div>
        <div class="navbar-user">
            Masuk sebagai: <strong><?php echo htmlspecialchars($_SESSION['role']); ?></strong>
            <a href="logout.php">Keluar Sistem</a>
        </div>
    </div>
    <div class="container">
        <div class="welcome-card">
            <h2>Portal Layanan Pegawai</h2>
            <p>Selamat datang di Sistem Informasi Kepegawaian terpadu. Silakan gunakan menu di bawah untuk mengakses layanan internal dan dokumen instansi.</p>
        </div>
        
        <div class="menu-grid">
            <div class="menu-card">
                <div class="menu-icon">👤</div>
                <h3>Data Profil</h3>
                <p>Kelola dan lihat informasi data diri, struktur jabatan, dan tingkatan hak akses kepegawaian Anda.</p>
                <!-- URL Ini yang akan dianalisa Taruna -->
                <a href="profil.php?id=5" class="btn">Lihat Profil Saya</a>
            </div>
            
            <div class="menu-card">
                <div class="menu-icon">📄</div>
                <h3>Dokumen & Edaran</h3>
                <p>Baca surat edaran terbaru, kebijakan internal, dan pengumuman resmi dari pimpinan.</p>
                <!-- URL Ini yang akan dianalisa Taruna -->
                <a href="baca.php?file=pengumuman.txt" class="btn">Buka Dokumen</a>
            </div>
        </div>
    </div>
</body>
</html>
