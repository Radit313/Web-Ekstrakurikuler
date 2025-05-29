<?php
include 'koneksi.php';
session_start();

if ($_SESSION['role'] !== 'admin') {
    echo "Akses ditolak.";
    exit();
}
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $idPendaftaran = (int)$_GET['id'];

    $sql = "SELECT p.*, s.nama_siswa, e.nama_eskul 
            FROM pendaftaran_eskul p
            JOIN siswa s ON p.id_siswa = s.id_siswa
            JOIN eskul e ON p.id_eskul = e.id_eskul
            WHERE p.id_pendaftaran = $idPendaftaran";
    
    $result = $conn->query($sql);
    $pendaftaran = $result->fetch_assoc();

    if (!$pendaftaran) {
        die("Data tidak ditemukan.");
    }
} else {
    die("ID tidak valid.");
}

// Update status
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $statusBaru = $conn->real_escape_string($_POST['status']);

    $update = "UPDATE pendaftaran_eskul SET status = '$statusBaru' WHERE id_pendaftaran = $idPendaftaran";
    if ($conn->query($update)) {
        $successMessage = "Status berhasil diperbarui.";
        // Refresh data
        $pendaftaran['status'] = $statusBaru;
    } else {
        $errorMessage = "Gagal memperbarui status: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Status Pendaftaran</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            padding: 40px;
            background: linear-gradient(to right, #f8f9fa, #e0f7fa);
            padding: 30px;
            color: #2c3e50;
        }

        h2 {
            color: #2c3e50;
            text-align:center;
        }

        form {
            background: white;
            padding: 25px;
            border-radius: 12px;
            max-width: 700px;
            margin: auto;
            box-shadow: 0 4px 12px grey;
        }

        label {
            font-weight: bold;
            display: block;
            margin-top: 15px;
        }

        select, textarea {
            width: 100%;
            margin-top: 8px;
            padding: 10px;
            border-radius: 8px;
            border: 1px solid grey;
            font-size: 1em;
        }

        textarea[readonly] {
            background: #f0f0f0;
        }

        .message {
            text-align: center;
            margin: 15px 0;
            font-weight: bold;
        }

        .message.success {
            color: green;
        }

        .message.error {
            color: red;
        }
        
        input[type="submit"] {
            margin-top: 15px;
            background-color: green;
            color:  white;
            border: none;
            padding: 12px 25px;
            font-size: 16px;
            border-radius: 8px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        input[type="submit"]:hover {
            background-color: #388e3c;
        }

        a {
            display: inline-block;
            margin-top: 20px;
            text-decoration: none;
            color: green;
        }

        a:hover {
            text-decoration: underline;
        }

    </style>
</head>
<body>

    <h2>Edit Status Pendaftaran Ekskul</h2>

    <?php if (isset($errorMessage)): ?>
        <div class="message error"><?= htmlspecialchars($errorMessage); ?></div>
    <?php endif; ?>

    <?php if (isset($successMessage)): ?>
        <div class="message success"><?= htmlspecialchars($successMessage); ?></div>
    <?php endif; ?>

    <form method="POST">
        <label>Nama Siswa:</label>
        <p><?= htmlspecialchars($pendaftaran['nama_siswa']); ?></p>

        <label>Ekskul:</label>
        <p><?= htmlspecialchars($pendaftaran['nama_eskul']); ?></p>

        <label>Tanggal Daftar:</label>
        <p><?= htmlspecialchars($pendaftaran['tanggal_daftar']); ?></p>

        <label>Keterangan:</label>
        <textarea readonly style="width: 50%; max-width: 400px;"><?= htmlspecialchars($pendaftaran['keterangan']); ?></textarea>

        <label>Status:</label>
        <select name="status" required>
            <option value="tunda" <?= $pendaftaran['status'] === 'tunda' ? 'selected' : ''; ?>>Tunda</option>
            <option value="Diterima" <?= $pendaftaran['status'] === 'Diterima' ? 'selected' : ''; ?>>Diterima</option>
            <option value="Ditolak" <?= $pendaftaran['status'] === 'Ditolak' ? 'selected' : ''; ?>>Ditolak</option>
        </select>

        <input type="submit" value="Update Status">
    </form>

    <div style="text-align: center;">
    <a href="admin_daftar.php">← Kembali ke Daftar Pendaftaran</a>
    </div>
    
    <footer>
        <hr>
        <p>&copy;  <?php echo date('Y');?>  RAFADITYA SYAHPUTRA. Hak Cipta Dilindungi.</p>
    </footer>
</body>
</html>
