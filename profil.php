<?php
session_start();
if (!isset($_SESSION['login'])) { header("Location: login.php"); exit; }

$id = isset($_GET['id']) ? intval($_GET['id']) : 5;

// Data Pegawai Dummy
$data_pegawai = [
    1 => ["nama" => "Jenderal Besar", "nip" => "198012312005011001", "jabatan" => "Pimpinan Tertinggi", "rahasia" => "LEVEL 1 (Akses Penuh Server)", "foto" => "👮‍♂️"],
    5 => ["nama" => "Staf Administrasi", "nip" => "199507122019032015", "jabatan" => "Operator Data", "rahasia" => "LEVEL 5 (Akses Terbatas)", "foto" => "👨‍💼"]
];

$profil = isset($data_pegawai[$id]) ? $data_pegawai[$id] : null;
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Profil Pegawai - SIMPEG</title>
    <style>
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; background-color: #e9ecef; margin: 0; padding: 50px 20px; display: flex; justify-content: center; }
        .profile-card { background: white; width: 100%; max-width: 450px; border-radius: 8px; box-shadow: 0 10px 20px rgba(0,0,0,0.08); overflow: hidden; }
        .profile-header { background: linear-gradient(135deg, #005A9E, #003366); color: white; padding: 40px 20px 30px; text-align: center; }
        .avatar { font-size: 75px; background: rgba(255,255,255,0.1); width: 130px; height: 130px; line-height: 130px; border-radius: 50%; margin: 0 auto 15px; border: 4px solid white; box-shadow: 0 4px 10px rgba(0,0,0,0.2);}
        .profile-header h2 { margin: 0; font-size: 1.6em; letter-spacing: 0.5px;}
        .profile-header p { margin: 5px 0 0; color: #b3d4f0; }
        .profile-body { padding: 30px 40px; }
        .info-group { margin-bottom: 25px; border-bottom: 1px solid #f1f3f5; padding-bottom: 15px; }
        .info-group:last-child { border-bottom: none; margin-bottom: 0; padding-bottom: 0;}
        .info-label { color: #868e96; font-size: 0.8em; font-weight: bold; text-transform: uppercase; margin-bottom: 5px; letter-spacing: 1px;}
        .info-value { color: #343a40; font-size: 1.1em; font-weight: 500;}
        .info-value.secure { color: #c0392b; font-weight: bold; background: #fadbd8; display: inline-block; padding: 2px 8px; border-radius: 4px;}
        .error-msg { text-align: center; padding: 50px 30px; color: #c0392b; }
        .btn-back { display: block; text-align: center; background: #f8f9fa; color: #005A9E; text-decoration: none; padding: 15px; font-weight: bold; border-top: 1px solid #e9ecef; transition: background 0.2s; }
        .btn-back:hover { background: #e2e6ea; }
    </style>
</head>
<body>
    <div class="profile-card">
        <?php if($profil): ?>
            <div class="profile-header">
                <div class="avatar"><?php echo $profil['foto']; ?></div>
                <h2><?php echo htmlspecialchars($profil['nama']); ?></h2>
                <p><?php echo htmlspecialchars($profil['jabatan']); ?></p>
            </div>
            <div class="profile-body">
                <div class="info-group">
                    <div class="info-label">Nomor Induk Pegawai (NIP)</div>
                    <div class="info-value"><?php echo htmlspecialchars($profil['nip']); ?></div>
                </div>
                <div class="info-group">
                    <div class="info-label">Izin Akses Sistem</div>
                    <div class="info-value secure"><?php echo htmlspecialchars($profil['rahasia']); ?></div>
                </div>
            </div>
        <?php else: ?>
            <div class="error-msg">
                <h2 style="margin-top:0;">⚠️ Akses Ditolak</h2>
                <p style="color: #7f8c8d;">Data ID Pegawai tidak valid atau Anda tidak memiliki izin untuk melihat profil ini.</p>
            </div>
        <?php endif; ?>
        <a href="dashboard.php" class="btn-back">Kembali ke Dashboard</a>
    </div>
</body>
</html>
