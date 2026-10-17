<?php
session_start();
if (!isset($_SESSION['login'])) { header("Location: login.php"); exit; }

// =========================================================================
// MODE 1: Jika tidak ada parameter 'file', tampilkan HALAMAN DAFTAR DOKUMEN
// =========================================================================
if (!isset($_GET['file'])) {
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Pusat Dokumen - SIMPEG</title>
    <style>
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; background-color: #f4f6f9; margin: 0; padding: 40px 20px; display: flex; justify-content: center; }
        .doc-list-container { background: white; width: 100%; max-width: 750px; padding: 30px 40px; border-radius: 8px; box-shadow: 0 4px 15px rgba(0,0,0,0.05); border-top: 5px solid #005A9E; }
        .doc-list-container h2 { margin-top: 0; color: #2c3e50; border-bottom: 2px solid #ecf0f1; padding-bottom: 15px; }
        .doc-item { padding: 20px 15px; border-bottom: 1px solid #f1f3f5; display: flex; justify-content: space-between; align-items: center; transition: background 0.2s;}
        .doc-item:hover { background: #f8f9fa; }
        .doc-title { font-weight: 500; color: #34495e; font-size: 1.1em;}
        .btn-read { background: #0078D7; color: white; text-decoration: none; padding: 10px 18px; border-radius: 4px; font-size: 0.9em; font-weight: bold; transition: background 0.2s;}
        .btn-read:hover { background: #005A9E; }
        .btn-back { display: inline-block; margin-top: 25px; color: #7f8c8d; text-decoration: none; font-weight: bold; }
        .btn-back:hover { color: #2c3e50; }
    </style>
</head>
<body>
    <div class="doc-list-container">
        <h2>Pusat Dokumen & Surat Edaran</h2>
        <p style="color: #7f8c8d; margin-bottom: 30px;">Pilih dokumen internal yang ingin Anda baca dari daftar di bawah ini.</p>
        
        <div class="doc-item">
            <div class="doc-title">📄 SE Pemeliharaan Sistem & Migrasi Server</div>
            <!-- INI ENTRY POINT LFI YANG AKAN DITEMUKAN TARUNA -->
            <a href="baca.php?file=pengumuman.pdf" class="btn-read">Baca Dokumen</a>
        </div>
        
        <div class="doc-item">
            <div class="doc-title">📄 SOP Penggunaan SIMPEG v2.0</div>
            <!-- Dokumen dummy, cuma buat pajangan -->
            <a href="#" class="btn-read" style="background:#bdc3c7;" onclick="alert('Dokumen sedang dalam proses pembaruan oleh HRD.')">Baca Dokumen</a>
        </div>

        <a href="dashboard.php" class="btn-back">← Kembali ke Dashboard</a>
    </div>
</body>
</html>
<?php
    exit; // Hentikan script di sini agar tidak error saat memuat viewer
}

// =========================================================================
// MODE 2: Jika ada parameter 'file', jalankan FUNGSI LFI & VIEWER
// =========================================================================
$file = $_GET['file'];
$ext = strtolower(pathinfo($file, PATHINFO_EXTENSION));

// LOGIKA PDF
if ($ext === 'pdf') {
    if (file_exists($file)) {
        header('Content-Type: application/pdf');
        header('Content-Disposition: inline; filename="' . basename($file) . '"');
        header('Accept-Ranges: bytes');
        @readfile($file);
        exit;
    } else {
        $error_pdf = true;
    }
}
// LOGIKA NON-PDF / VIEWER / LFI
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Document Viewer - SIMPEG</title>
    <style>
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; background-color: #d1d8e0; margin: 0; padding: 40px 20px; display: flex; justify-content: center; }
        .doc-container { background: white; width: 100%; max-width: 850px; box-shadow: 0 10px 30px rgba(0,0,0,0.15); border-radius: 6px; overflow: hidden; border: 1px solid #a5b1c2; }
        .doc-header { background: #2d3436; color: white; padding: 15px 25px; display: flex; justify-content: space-between; align-items: center; border-bottom: 3px solid #005A9E;}
        .doc-title { font-weight: bold; display: flex; align-items: center; font-family: monospace; font-size: 1.1em;}
        .doc-actions a { color: #dfe6e9; text-decoration: none; font-size: 0.9em; background: #636e72; padding: 6px 15px; border-radius: 4px; transition: background 0.2s; font-weight: bold;}
        .doc-actions a:hover { background: #b2bec3; color: #2d3436;}
        .doc-content { padding: 40px; min-height: 500px; font-family: 'Consolas', 'Courier New', monospace; font-size: 14px; line-height: 1.7; color: #2d3436; background: #fdfdfd; white-space: pre-wrap; overflow-x: auto; }
        .error-alert { color: #e74c3c; background: #fadbd8; padding: 15px 20px; border-left: 5px solid #c0392b; margin-bottom: 20px; border-radius: 0 4px 4px 0;}
    </style>
</head>
<body>
    <div class="doc-container">
        <div class="doc-header">
            <div class="doc-title">
                📄 [Viewer] <?php echo htmlspecialchars(basename($file)); ?>
            </div>
            <div class="doc-actions">
                <a href="baca.php">X Kembali ke Daftar</a>
            </div>
        </div>
        <div class="doc-content">
<?php 
            if (isset($error_pdf)) {
                echo "<div class='error-alert'><strong>System Error:</strong> Dokumen PDF tidak ditemukan pada direktori penyimpanan.</div>";
            } else {
                $konten = @file_get_contents($file);
                if($konten !== FALSE) {
                    echo htmlspecialchars($konten, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
                } else {
                    echo "<div class='error-alert'>";
                    echo "<strong>System Error:</strong> File/Direktori tidak dapat dibaca.<br>";
                    echo "<span style='font-size:0.8em; color:#7f8c8d;'>Target Path: ".htmlspecialchars($file)."</span>";
                    echo "</div>";
                }
            }
?>
        </div>
    </div>
</body>
</html>
