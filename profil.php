<?php
session_start();
if (!isset($_SESSION['login'])) { header("Location: login.php"); exit; }

$id = isset($_GET['id']) ? intval($_GET['id']) : 5;

// Data Pegawai Dummy
$data_pegawai = [
    1 => ["nama" => "Jenderal Besar (Admin)", "nip" => "198012312005011001", "jabatan" => "Panglima", "rahasia" => "Akses Penuh Level 1"],
    5 => ["nama" => "Staf Administrasi", "nip" => "199507122019032015", "jabatan" => "Operator", "rahasia" => "Akses Terbatas"]
];

$profil = isset($data_pegawai[$id]) ? $data_pegawai[$id] : null;
?>
<!DOCTYPE html>
<html>
<head><title>Profil Pegawai</title><style>body { font-family: Arial; padding: 40px; }</style></head>
<body>
    <h2>Data Profil Pegawai</h2>
    <?php if($profil): ?>
        <table border="1" cellpadding="10" cellspacing="0">
            <tr><td>Nama</td><td><?php echo $profil['nama']; ?></td></tr>
            <tr><td>NIP</td><td><b style="color:red;"><?php echo $profil['nip']; ?></b></td></tr>
            <tr><td>Jabatan</td><td><?php echo $profil['jabatan']; ?></td></tr>
            <tr><td>Hak Akses</td><td><?php echo $profil['rahasia']; ?></td></tr>
        </table>
    <?php else: ?>
        <p>Data tidak ditemukan.</p>
    <?php endif; ?>
    <br><a href="dashboard.php">Kembali</a>
</body>
</html>
