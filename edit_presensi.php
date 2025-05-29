<?php
include 'koneksi.php';
session_start();

if ($_SESSION['role'] !== 'admin') {
    echo "Akses ditolak.";
    exit();
}
// Ambil ID presensi dari parameter URL
$id_presensi = isset($_GET['id']) ? (int)$_GET['id'] : 0;

// Ambil data presensi
$query = "SELECT p.*, s.nama_siswa, e.nama_eskul 
          FROM presensi p
          JOIN siswa s ON p.id_siswa = s.id_siswa
          JOIN eskul e ON p.id_eskul = e.id_eskul
          WHERE p.id_presensi = $id_presensi";

$result = $conn->query($query);

if (!$result || $result->num_rows === 0) {
    echo "Data tidak ditemukan.";
    exit;
}

$data = $result->fetch_assoc();
$error = '';
$success = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $tanggal = $_POST['tanggal'];
    $status_hadir = $_POST['status_hadir'];
    $status = $_POST['status'];
    $catatan = $_POST['catatan'];

    $update = "UPDATE presensi 
               SET tanggal='$tanggal', status_hadir='$status_hadir', status='$status', catatan='$catatan'
               WHERE id_presensi=$id_presensi";

    if ($conn->query($update)) {
        $success = "Data presensi berhasil diperbarui.";
        $data['tanggal'] = $tanggal;
        $data['status_hadir'] = $status_hadir;
        $data['status'] = $status;
        $data['catatan'] = $catatan;
    } else {
        $error = "Gagal memperbarui data presensi.";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Data Presensi</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            padding: 40px;
            background: linear-gradient(to right, #f8f9fa, #e0f7fa);
            color: #2c3e50;
        }

        h2 {
            color: #2c3e50;
            text-align: center;
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

        input[type="text"], input[type="date"], select, textarea {
            width: 100%;
            margin-top: 8px;
            padding: 10px;
            border-radius: 8px;
            border: 1px solid grey;
            font-size: 1em;
        }

        textarea {
            resize: vertical;
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
            color: white;
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

<h2>Edit Data Presensi Ekskul</h2>

<?php if ($error): ?>
    <div class="message error"><?= htmlspecialchars($error); ?></div>
<?php endif; ?>

<?php if ($success): ?>
    <div class="message success"><?= htmlspecialchars($success); ?></div>
<?php endif; ?>

<form method="post">
    <label>Nama Siswa:</label>
    <input type="text" value="<?= htmlspecialchars($data['nama_siswa']); ?>" readonly>

    <label>Ekstrakurikuler:</label>
    <input type="text" value="<?= htmlspecialchars($data['nama_eskul']); ?>" readonly>

    <label for="tanggal">Tanggal Presensi:</label>
    <input type="date" name="tanggal" id="tanggal" value="<?= htmlspecialchars($data['tanggal']); ?>" required>

    <label for="status_hadir">Status Kehadiran:</label>
    <select name="status_hadir" id="status_hadir" required>
        <option value="Hadir" <?= $data['status_hadir'] === 'Hadir' ? 'selected' : ''; ?>>Hadir</option>
        <option value="Izin" <?= $data['status_hadir'] === 'Izin' ? 'selected' : ''; ?>>Izin</option>
        <option value="Sakit" <?= $data['status_hadir'] === 'Sakit' ? 'selected' : ''; ?>>Sakit</option>
        <option value="Alpha" <?= $data['status_hadir'] === 'Alpha' ? 'selected' : ''; ?>>Alpha</option>
    </select>

    <label for="status">Status Pendaftaran:</label>
    <select name="status" id="status" required>
        <option value="tunda" <?= $data['status'] === 'tunda' ? 'selected' : ''; ?>>Tunda</option>
        <option value="Diterima" <?= $data['status'] === 'Diterima' ? 'selected' : ''; ?>>Diterima</option>
        <option value="Ditolak" <?= $data['status'] === 'Ditolak' ? 'selected' : ''; ?>>Ditolak</option>
    </select>

    <label for="catatan">Catatan:</label>
    <textarea name="catatan" id="catatan" rows="4"><?= htmlspecialchars($data['catatan']); ?></textarea>

    <input type="submit" value="Simpan Perubahan">
</form>

<div style="text-align: center;">
    <a href="admin_presensi.php">← Kembali ke Data Presensi</a>
</div>

<footer style="text-align: center; margin-top: 30px;">
    <hr>
    <p>&copy; <?= date('Y'); ?> RAFADITYA SYAHPUTRA. Hak Cipta Dilindungi.</p>
</footer>

</body>
</html>
