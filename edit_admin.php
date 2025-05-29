<?php
include 'koneksi.php';
session_start();

// Cek login dan role
if (!isset($_SESSION['id_pengguna']) || $_SESSION['role'] !== 'admin') {
    header("Location: login_admin.php");
    exit();
}

// Cek ID pengguna dari URL
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    echo "ID tidak ditemukan atau tidak valid!";
    exit();
}

$id = (int) $_GET['id'];

// Ambil data pengguna
$stmt = $conn->prepare("SELECT * FROM pengguna WHERE id_pengguna = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows !== 1) {
    echo "Data tidak ditemukan!";
    exit();
}

$row = $result->fetch_assoc();

// Tangani jika form disubmit
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);
    $role = $_POST['role'];

    // Validasi role
    $allowed_roles = ['admin', 'pembina', 'pelatih'];
    if (!in_array($role, $allowed_roles)) {
        echo "Role tidak valid!";
        exit();
    }

    if (!empty($password)) {
        $hashed = password_hash($password, PASSWORD_DEFAULT);
        $stmt = $conn->prepare("UPDATE pengguna SET username = ?, password = ?, role = ? WHERE id_pengguna = ?");
        $stmt->bind_param("sssi", $username, $hashed, $role, $id);
    } else {
        $stmt = $conn->prepare("UPDATE pengguna SET username = ?, role = ? WHERE id_pengguna = ?");
        $stmt->bind_param("ssi", $username, $role, $id);
    }

    if ($stmt->execute()) {
        echo "<script>alert('Data berhasil diupdate'); window.location='kelola_admin.php';</script>";
        exit();
    } else {
        echo "Gagal mengupdate data: " . $stmt->error;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Admin</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f1f1f1;
            padding: 50px;
        }
        .form-container {
            background: #ffffff;
            padding: 40px 50px;
            max-width: 800px;
            margin: auto;
            border-radius: 15px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.15);
        }
        h2 {
            text-align: center;
            color: green;
            font-size: 2em;
            margin-bottom: 30px;
        }
        form label {
            display: block;
            margin-top: 20px;
            font-size: 1.2em;
        }
        form input, select {
            width: 100%;
            padding: 14px 16px;
            font-size: 1.1em;
            margin-top: 8px;
            border-radius: 8px;
            border: 1px solid #ccc;
            transition: 0.3s;
        }
        form input:focus, select:focus {
            border-color: #4CAF50;
            outline: none;
        }
        .btn {
            margin-top: 30px;
            padding: 16px;
            font-size: 1.2em;
            background-color: green;
            color: white;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            width: 100%;
            transition: background 0.3s;
        }
        .btn:hover {
            background-color: #2e7d32;
        }
    </style>
</head>
<body>
    <div class="form-container">
        <h2>Edit Akun Admin</h2>
        <form method="POST">
            <label for="username">Username:</label>
            <input type="text" name="username" id="username" value="<?= htmlspecialchars($row['username']) ?>" required>

            <label for="password">Password (biarkan kosong jika tidak ingin diubah):</label>
            <input type="password" name="password" id="password" placeholder="******">

            <label for="role">Role:</label>
            <select name="role" id="role" required>
                <option value="admin" <?= $row['role'] === 'admin' ? 'selected' : '' ?>>Admin</option>
                <option value="pembina" <?= $row['role'] === 'pembina' ? 'selected' : '' ?>>Pembina</option>
                <option value="pelatih" <?= $row['role'] === 'pelatih' ? 'selected' : '' ?>>Pelatih</option>
            </select>

            <button type="submit" class="btn">Simpan Perubahan</button>
        </form>
    </div>
</body>
</html>
