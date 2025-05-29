<?php
include 'koneksi.php';
session_start();

if ($_SESSION['role'] !== 'admin') {
    echo "Akses ditolak.";
    exit();
}
// Validasi ID
if (isset($_GET['id'])) {
    $id = $conn->real_escape_string($_GET['id']);
    $query = "SELECT * FROM siswa WHERE id_siswa = '$id'";
    $result = $conn->query($query);

    if ($result->num_rows == 1) {
        $siswa = $result->fetch_assoc();
    } else {
        die("Siswa tidak ditemukan.");
    }
} else {
    die("ID tidak valid.");
}

// Proses update
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nis           = $conn->real_escape_string($_POST['nis']);
    $nama_siswa    = $conn->real_escape_string($_POST['nama_siswa']);
    $kelas         = $conn->real_escape_string($_POST['kelas']);
    $jenis_kelamin = $conn->real_escape_string($_POST['jenis_kelamin']);

    $update_query = "UPDATE siswa SET 
        nis = '$nis',
        nama_siswa = '$nama_siswa',
        kelas = '$kelas',
        jenis_kelamin = '$jenis_kelamin'
        WHERE id_siswa = '$id'";

    if ($conn->query($update_query)) {
        $success = "Data siswa berhasil diperbarui.";
        // Refresh data setelah update
        $result = $conn->query("SELECT * FROM siswa WHERE id_siswa = '$id'");
        $siswa = $result->fetch_assoc();
    } else {
        $error = "Gagal memperbarui data siswa: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Data Siswa</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(to right, #f8f9fa, #e0f7fa);
            padding: 40px;
        }

        h1 {
            text-align: center;
            color: #2c3e50;
        }

        .isi {
            max-width: 600px;
            margin: 30px auto;
            background: #fff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.1);
        }

        label {
            display: block;
            margin-top: 15px;
            font-weight: 600;
        }

        input[type="text"], select {
            width: 100%;
            padding: 10px;
            margin-top: 8px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
        }

        input[type="submit"] {
            margin-top: 20px;
            background-color: green;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-weight: bold;
        }

        input[type="submit"]:hover {
            background-color: #2e7d32;
        }

        .success {
            color: green;
            font-weight: bold;
        }

        .error {
            color: red;
            font-weight: bold;
        }

        footer {
            text-align: center;
            margin-top: 50px;
            color: #777;
        }

        a {
            display: inline-block;
            margin-top: 20px;
            color: green;
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <h1>Edit Data Siswa</h1>

    <div class="isi">
        <?php if (isset($success)) echo "<p class='success'>$success</p>"; ?>
        <?php if (isset($error)) echo "<p class='error'>$error</p>"; ?>

        <form method="POST">
            <label for="nis">NIS:</label>
            <input type="text" id="nis" name="nis" value="<?= htmlspecialchars($siswa['nis']); ?>" required>

            <label for="nama_siswa">Nama Siswa:</label>
            <input type="text" id="nama_siswa" name="nama_siswa" value="<?= htmlspecialchars($siswa['nama_siswa']); ?>" required>

            <label for="kelas">Kelas:</label>
            <input type="text" id="kelas" name="kelas" value="<?= htmlspecialchars($siswa['kelas']); ?>" required>

            <label for="jenis_kelamin">Jenis Kelamin:</label>
            <select name="jenis_kelamin" id="jenis_kelamin" required>
                <option value="L" <?= ($siswa['jenis_kelamin'] == 'L') ? 'selected' : ''; ?>>Laki-laki</option>
                <option value="P" <?= ($siswa['jenis_kelamin'] == 'P') ? 'selected' : ''; ?>>Perempuan</option>
            </select>

            <input type="submit" value="Update">
        </form>

        <a href="admin_siswa.php">← Kembali ke Daftar Siswa</a>
    </div>

    <footer>
        <hr>
        <p>&copy;  <?php echo date('Y');?>  RAFADITYA SYAHPUTRA. Hak Cipta Dilindungi.</p>
    </footer>
</body>
</html>
