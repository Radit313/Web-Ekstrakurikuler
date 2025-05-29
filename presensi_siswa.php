<?php
include 'koneksi.php';
session_start();

if (!isset($_SESSION['id_siswa'])) {
    header("Location: login_siswa.php");
    exit;
}

$id_siswa = $_SESSION['id_siswa'];
$nama_siswa = $_SESSION['nama_siswa'];
$status = 'tunda'; // Status default
$tanggal = date('Y-m-d');
$success='';
$error='';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_eskul = $_POST['id_eskul'] ?? '';
    $status_hadir = $_POST['status_hadir'] ?? '';
    $catatan = $_POST['catatan'] ?? '';


    // Validasi data
    if (!empty($id_eskul) && !empty($status_hadir)) {
        // Menyiapkan query dengan prepared statement
        $stmt = $conn->prepare("INSERT INTO presensi (id_siswa, id_eskul, tanggal, status_hadir, status, catatan) VALUES (?, ?, ?, ?, ?, ?)");

        // Periksa apakah query berhasil disiapkan
        if ($stmt === false) {
            die('Error dalam prepare statement: ' . $conn->error);
        }

        // Bind parameter ke query
        $stmt->bind_param("iissss", $id_siswa, $id_eskul, $tanggal, $status_hadir, $status, $catatan);

        if ($stmt->execute()) {
            $success = "Sip! Presensi Kamu Sudah Dicatat.";
        } else {
           $error = "Yah, Data Presensi gagal Dicatat.";
        }

        $stmt->close();
    } else {
        echo "<div style='padding:10px;background:#fff3cd;color:#856404;border:1px solid #ffeeba;'>Mohon lengkapi semua data presensi.</div>";
    }
}
?>



<html>
<head>
    <title>Presensi Siswa</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <style>
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
} 
body{
            font-family: 'Poppins', sans-serif;
            color: #2c3e50; /* Warna teks yang lebih gelap untuk kontras */
            line-height: 1.7;
            padding: 30px;
            position: relative;
            min-height: 100vh;
            z-index: 1;
        }

        body::before {
            content: "";
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-image: url('smkn13.jpg');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            filter: blur(15px) brightness(0.6);
            z-index: -2;
            pointer-events: none;
        }

        body::after {
            content: "";
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 50, 0, 0.5); /* Hijau tua transparan */
            z-index: -1;
            pointer-events: none;
        }

        /* Header */
        h1 {
            text-align: center;
            font-size: 2.5em;
            background: rgba(0, 50, 0, 0.7); /* Hijau tua transparan */
            color: white;
            padding: 20px;
            border-radius: 10px;
            margin-bottom: 30px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            animation: fadeIn 1s ease-in-out;
        }
/* Animasi masuk saat halaman dimuat */
@keyframes fadeIn {
    from { opacity: 0; transform: translateY(20px); }
    to { opacity: 1; transform: translateY(0); }
}

@keyframes slideIn {
    from { opacity: 0; transform: translateX(-50px); }
    to { opacity: 1; transform: translateX(0); }
}
/* Terapkan animasi */
h1 {
    animation: fadeIn 1s ease forwards;
}
.nav{
    animation: slideIn 1.4s ease forwards;
}
.isi {
    animation: slideIn 1.2s ease forwards;
}
.form-presensi{
    animation: slideIn 1.2s ease forwards;
}
.back_beranda{
    animation: slideIn 1.2s ease forwards;
}

        .isi {
            max-width: 1000px;
            margin: auto;
            background-color: #ffffff;
            padding: 25px 30px;
            border-radius: 12px;
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.1);
            margin-bottom: 40px;
        }

        .isi p {
            font-size: 1.1em;
            margin-bottom: 15px;
        }

        .isi a {
            color: green;
            text-decoration: none;
            font-weight: bold;
        }

        .isi a:hover {
            text-decoration: underline;
        }

        .nav {
            margin: 15px 0;
            text-align: center;
        }

        .nav a {
            display: inline-block;
            margin: 0 10px;
            padding: 10px 20px;
            background-color: green;
            color: white;
            border-radius: 30px;
            text-decoration: none;
            transition: 0.3s;
        }

        .nav a:hover {
            background-color: #388e3c;
            transform: scale(1.05);
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px auto;
            background-color: #fff;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.05);
        }

        table th, table td {
            padding: 15px;
            text-align: center;
            border-bottom: 1px solid #e0e0e0;
            font-size: 15px;
        }

        table th {
            background-color: green;
            color: white;
            font-weight: 600;
        }

        table tr:hover {
            background-color: #f1f8e9;
        }

        footer {
            text-align: center;
            margin-top: 50px;
            font-size: 0.9em;
            color: #555;
            padding: 0;
        }

        .form-presensi {
            margin-top: 30px;
            background-color: #ffffff;
            padding: 20px;
            border-radius: 12px;
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.1);
        }

        .form-presensi input, .form-presensi textarea, .form-presensi select {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ddd;
            border-radius: 8px;
        }

        .form-presensi button {
            padding: 10px 20px;
            background-color: green;
            color: white;
            border: none;
            border-radius: 30px;
            cursor: pointer;
            transition: 0.3s;
        }

        .form-presensi button:hover {
            background-color: #388e3c;
        }

        .back_beranda {
            text-align: center;
            margin-top: 20px;
        }

        .back_beranda a {
            color: #27ae60;
            font-weight: bold;
            text-decoration: none;
        }

        .back_beranda a:hover {
            text-decoration: underline;
        }
         .error, .success {
            text-align: center;
            font-weight: bold;
            margin-bottom: 10px;
        }

        .error {
            color: red;
        }

        .success {
            color: rgb(44, 202, 107);
        }
    </style>
</head>
<body>
   <h1>Presensi Ekskul</h1>

       <?php if ($error): ?>
        <p class="error"><?php echo $error; ?></p>
    <?php endif; ?>

    <?php if ($success): ?>
        <p class="success"><?php echo $success; ?></p>
    <?php endif; ?>

<div class="isi">
    <p>Mau Presensi Nih, <?php echo htmlspecialchars($nama_siswa); ?>?
    </p>
    <div class="nav">
        <a href="index_siswa.php">Beranda</a> |
        <a href="panel_siswa.php">Halaman Siswa</a> |
        <a href="daftar.php">Form Pendaftaran Ekskul</a>
    </div>
</div>

<div class="form-presensi">
    <h3>Catat Kehadiran Anda</h3><br>
    <form action="" method="POST">
        <label for="id_eskul">Pilih Ekskul</label>
        <select name="id_eskul" id="id_eskul" required>
            <option value="">-- Pilih Ekskul --</option>
            <?php
            $result = $conn->query("SELECT id_eskul, nama_eskul FROM eskul");
            while ($row = $result->fetch_assoc()) {
                echo "<option value='" . $row['id_eskul'] . "'>" . htmlspecialchars($row['nama_eskul']) . "</option>";
            }
            ?>
        </select>

        <label for="status_hadir">Status Kehadiran</label>
        <select name="status_hadir" id="status_hadir" required>
            <option value="">-- Pilih Status --</option>
            <option value="Hadir">Hadir</option>
            <option value="Sakit">Sakit</option>
            <option value="Izin">Izin</option>
            <option value="Alpha">Alpha</option>
        </select>

        <label for="catatan">Catatan (Opsional)</label>
        <textarea name="catatan" id="catatan" rows="4"></textarea>

        <button type="submit">Catat Kehadiran</button>
    </form>
</div>

    <p class="back_beranda">
        <a href="panel_siswa.php">Kembali</a>
    </p><br>

    <footer>
        <hr>
        <p>&copy;  <?php echo date('Y');?>  RAFADITYA SYAHPUTRA. Hak Cipta Dilindungi.</p>
    </footer>
</body>
</html>
