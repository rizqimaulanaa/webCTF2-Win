<?php
session_start();
if (!isset($_SESSION['login'])) {
    header("Location: login.php");
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Dashboard - SIMPEG</title>
    <style>
        body { font-family: 'Segoe UI', sans-serif; padding: 40px; background: #f0f0f0; }
        .container { background: white; padding: 30px; border-radius: 5px; border-top: 5px solid #0078D7; }
        a { text-decoration: none; color: #0078D7; font-weight: bold; }
    </style>
</head>
<body>
    <div class="container">
        <h2>Selamat Datang, <?php echo $_SESSION['role']; ?></h2>
        <p>Akses log sistem tercatat pada server Windows IIS.</p>
        <hr>
        <ul>
            <li><a href="profil.php?id=5">Lihat Profil Saya (IDOR Target)</a></li>
            <li><a href="baca.php?file=pengumuman.txt">Baca Pengumuman Instansi (LFI Target)</a></li>
            <li><a href="logout.php">Keluar</a></li>
        </ul>
    </div>
</body>
</html>
