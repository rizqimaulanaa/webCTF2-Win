<?php
session_start();
if (!isset($_SESSION['login'])) { header("Location: login.php"); exit; }

$file = isset($_GET['file']) ? $_GET['file'] : 'pengumuman.pdf';

// Mengecek ekstensi file dari URL
$ext = strtolower(pathinfo($file, PATHINFO_EXTENSION));

// LOGIKA 1: Jika file adalah PDF, paksa browser untuk me-loadnya sebagai PDF asli
if ($ext === 'pdf') {
    if (file_exists($file)) {
        header('Content-Type: application/pdf');
        header('Content-Disposition: inline; filename="' . basename($file) . '"');
        header('Accept-Ranges: bytes');
        @readfile($file);
        exit;
    } else {
        $error_pdf = true; // Jika PDF tidak ketemu, lanjut ke bawah
    }
}

// LOGIKA 2: Jika BUKAN PDF (Contoh: LFI ke win.ini), buka di Text Viewer!
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
        
        .doc-content { 
            padding: 40px; 
            min-height: 500px; 
            font-family: 'Consolas', 'Courier New', monospace; 
            font-size: 14px; 
            line-height: 1.7; 
            color: #2d3436; 
            background: #fdfdfd; 
            white-space: pre-wrap; 
            overflow-x: auto; 
        }
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
                <a href="dashboard.php">X Tutup Dokumen</a>
            </div>
        </div>
        <div class="doc-content">
<?php 
            if (isset($error_pdf)) {
                echo "<div class='error-alert'><strong>System Error:</strong> Dokumen PDF tidak ditemukan pada direktori penyimpanan.</div>";
            } else {
                // CELAH LFI: Akan tereksekusi jika parameter bukan .pdf
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
