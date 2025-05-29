<?php
session_start();
include 'koneksi.php';

if (!isset($_SESSION['id_siswa'])) {
    header("Location: login_siswa.php");
    exit;
}

$id_siswa = $_SESSION['id_siswa'];
$nama_siswa = $_SESSION['nama_siswa'];
$error = '';
$success = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_pendaftaran = uniqid('id_');
    $id_eskul = $conn->real_escape_string($_POST['id_eskul']);
    $tanggal_daftar = $conn->real_escape_string($_POST['tanggal_daftar']);
    $status = 'tunda';
    $keterangan = $conn->real_escape_string($_POST['keterangan']);

    $cek_eskul = $conn->query("SELECT * FROM eskul WHERE id_eskul = '$id_eskul'");
    if ($cek_eskul->num_rows == 0) {
        $error = "Ekstrakurikuler tidak ditemukan!";
    } else {
        $insert_query = "INSERT INTO pendaftaran_eskul (id_pendaftaran, id_siswa, id_eskul, tanggal_daftar, status, keterangan)
                         VALUES ('$id_pendaftaran', '$id_siswa', '$id_eskul', '$tanggal_daftar', '$status', '$keterangan')";

        if ($conn->query($insert_query)) {
            $success = "Pendaftaran berhasil!";
        } else {
            $error = "Gagal mendaftar: " . $conn->error;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Form Pendaftaran Ekstrakurikuler</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <style>
* {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        @keyframes fadeIn {
           from { opacity: 0; transform: translateY(20px); }
           to { opacity: 1; transform: translateY(0); }
        }

        @keyframes slideIn {
        from { opacity: 0; transform: translateX(-50px); }
        to { opacity: 1; transform: translateX(0); }
        }

        h1 {
         animation: fadeIn 1s ease forwards;
        }
        .isi{
         animation: fadeIn 1s ease forwards;
        }
        form{
         animation: fadeIn 1s ease forwards;
        }

        .nav{
         animation: fadeIn 1s ease forwards;
        }

        .back_beranda{
         animation: fadeIn 2s ease forwards;
        }

        .back{
         animation: fadeIn 2s ease forwards;
        }
        
        body {
            font-family: 'Poppins', sans-serif;
            color: #2c3e50;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            flex-direction: column;
            padding: 20px;
            position: relative;
            background-image: url('smkn13.jpg'); /* Ganti dengan gambar yang sesuai */
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
        }

        body::before {
            content: "";
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-image: url('smkn13.jpg'); /* Ganti dengan gambar yang sesuai */
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

        h1 {
            text-align: center;
            font-size: 2.5em;
            color:rgb(44, 202, 107);
            margin-bottom: 30px;
            z-index: 1;
        }

        .nav {
            text-align: center;
            margin-bottom: 20px;
        }

        .nav a {
            text-decoration: none;
            color:rgb(44, 202, 107);
            font-weight: bold;
            margin: 0 10px;
        }

        .nav a:hover {
            text-decoration: underline;
        }

        /* Form styling */
        form {
            background-color: #ffffff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
            max-width: 400px;
            width: 100%;
            z-index: 1;
        }

        table {
            width: 100%;
        }

        table td {
            padding: 12px;
            vertical-align: top;
        }

        label {
            font-weight: 600;
            color: #2c3e50;
        }

        input[type="text"] {
            width: 100%;
            padding: 10px;
            margin-top: 8px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
        }

        input[type="submit"] {
            width: 100%;
            padding: 12px;
            background-color: green;
            border: none;
            color: white;
            font-size: 18px;
            font-weight: bold;
            cursor: pointer;
            border-radius: 5px;
            margin-top: 20px;
        }

        input[type="submit"]:hover {
            background-color: #2e7d32;
        }

        .isi{
            color: #27ae60;
            padding:10px;
        }
        .isi a{
            color: green;
            font-weight: bold;
        }

        /* Error and success messages */
        p {
            text-align: center;
            color:rgb(44, 202, 107);
        }

        .error {
            color: red;
            font-weight: bold;
        }

        footer {
            margin-top: 40px;
            text-align: center;
            font-size: 0.9em;
            color:rgb(44, 202, 107);
            z-index: 1;
        }

        .back {
            text-align: center;
            margin-top: 20px;
        }

        .back a {
            text-decoration: none;
            color: #27ae60;
            font-weight: bold;
        }

        .back a:hover {
            text-decoration: underline;
        }

        form {
            background-color: #ffffff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 600px;
        }

        table {
            width: 100%;
        }

        table td {
            padding: 10px;
            vertical-align: top;
        }

        label {
            font-weight: 600;
            display: block;
        }

        select, input[type="date"], textarea {
            width: 100%;
            padding: 10px;
            margin-top: 6px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 15px;
        }

        input[type="submit"] {
            width: 100%;
            padding: 12px;
            background-color: green;
            color: white;
            border: none;
            font-size: 18px;
            font-weight: bold;
            cursor: pointer;
            border-radius: 5px;
            margin-top: 15px;
        }

        input[type="submit"]:hover {
            background-color: #2e7d32;
        }

        .error {
            color: red;
            font-weight: bold;
            text-align: center;
            margin-bottom: 10px;
        }

        .success {
            color: green;
            font-weight: bold;
            text-align: center;
            margin-bottom: 10px;
        }

        .back {
            margin-top: 20px;
        }

        .back a {
            color: blue;
            font-weight: bold;
            text-decoration: none;
            color: green;
        }

        .back a:hover {
            text-decoration: underline;
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
    </style>
</head>
<body>

    <h1>Form Pendaftaran Ekstrakurikuler</h1>
    <p class="isi">Mau Ikut Ekskul Apa Nih, <?php echo htmlspecialchars($nama_siswa); ?>? </a></p>

    <?php if ($error): ?>
        <p class="error"><?php echo $error; ?></p>
    <?php endif; ?>

    <?php if ($success): ?>
        <p class="success"><?php echo $success; ?></p>
    <?php endif; ?>

    <form method="post" action="">
        <table>
            <tr>
                <td><label for="id_eskul">Pilih Ekstrakurikuler:</label></td>
                <td>
                    <select id="id_eskul" name="id_eskul" required>
                        <option value="">Pilih Ekskul</option>
                        <?php
                        $eskul_result = $conn->query("SELECT id_eskul, nama_eskul FROM eskul");
                        while ($eskul = $eskul_result->fetch_assoc()) {
                            echo '<option value="' . $eskul['id_eskul'] . '">' . $eskul['nama_eskul'] . '</option>';
                        }
                        ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td><label for="tanggal_daftar">Tanggal Daftar:</label></td>
                <td><input type="date" name="tanggal_daftar" required></td>
            </tr>
            <tr>
                <td><label for="keterangan">Alasan Mengikuti:</label></td>
                <td><textarea id="keterangan" name="keterangan" rows="3" required></textarea></td>
            </tr>
            <tr>
                <td></td>
                <td><input type="submit" value="Daftar"></td>
            </tr>
        </table>
    </form>

    <p class="back">Lihat status pendaftaran Anda <a href="hasil_daftar.php">di sini</a>.</p>
    
    <p class="back_beranda">
        <a href="panel_siswa.php">Kembali</a>
    </p><br>
    <footer>
        <hr>
        <p>&copy; <?php echo date('Y'); ?> SMK NEGERI 13. Hak Cipta Dilindungi.</p>
    </footer>
</body>
</html>
