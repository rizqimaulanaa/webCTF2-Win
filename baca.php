<?php
session_start();
if (!isset($_SESSION['login'])) { header("Location: login.php"); exit; }

$file = isset($_GET['file']) ? $_GET['file'] : 'pengumuman.txt';

// VULNERABILITY: Directory Traversal (Bisa mundur ke C:\Windows\)
?>
<!DOCTYPE html>
<html>
<head><title>Dokumen Internal</title><style>body { font-family: Arial; padding: 40px; }</style></head>
<body>
    <h2>Document Viewer</h2>
    <div style="background: #222; color: #0f0; padding: 20px; font-family: monospace; white-space: pre-wrap; border-radius: 5px; height: 300px; overflow: auto;">
<?php 
        // Mengambil isi file (bisa membaca win.ini jika payloadnya benar)
        $konten = @file_get_contents($file);
        if($konten !== FALSE) {
            echo htmlspecialchars($konten);
        } else {
            echo "Error: File tidak dapat dibaca atau path salah.";
        }
?>
    </div>
    <br><a href="dashboard.php">Kembali</a>
</body>
</html>
