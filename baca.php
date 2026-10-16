<?php
session_start();
if (!isset($_SESSION['login'])) { header("Location: login.php"); exit; }

$file = isset($_GET['file']) ? $_GET['file'] : 'pengumuman.txt';
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
        
        /* Area pembacaan file dibuat menyerupai kertas dokumen / terminal */
        .doc-content { 
            padding: 40px; 
            min-height: 500px; 
            font-family: 'Consolas', 'Courier New', monospace; 
            font-size: 14px; 
            line-height: 1.7; 
            color: #2d3436; 
            background: #fdfdfd; 
            white-space: pre-wrap; /* Menjaga spasi dan enter bawaan file */
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
            // Celah LFI/Directory Traversal
            $konten = @file_get_contents($file);
            if($konten !== FALSE) {
                // Menampilkan isi file mentah apa adanya
                echo htmlspecialchars($konten);
            } else {
                echo "<div class='error-alert'>";
                echo "<strong>System Error:</strong> Dokumen tidak dapat ditemukan pada direktori penyimpanan.<br>";
                echo "<span style='font-size:0.8em; color:#7f8c8d;'>Target Path: ".htmlspecialchars($file)."</span>";
                echo "</div>";
            }
?>
        </div>
    </div>
</body>
</html>
