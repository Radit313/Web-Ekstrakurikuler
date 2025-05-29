<?php 
include 'koneksi.php';

$error = '';
$success = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nis            = $conn->real_escape_string($_POST['nis']);
    $nama_siswa     = $conn->real_escape_string($_POST['nama_siswa']);
    $kelas          = $conn->real_escape_string($_POST['kelas']);
    $jenis_kelamin  = $conn->real_escape_string($_POST['jenis_kelamin']);
    $tanggal_lahir  = $conn->real_escape_string($_POST['tanggal_lahir']);
    $alamat         = $conn->real_escape_string($_POST['alamat']);
    $no_telp        = $conn->real_escape_string($_POST['no_telp']);
    $email          = $conn->real_escape_string($_POST['email']);

    // ✅ Validasi server-side
    if (!preg_match('/^\d{1,11}$/', $nis)) {
        $error = "NIS hanya boleh angka dan maksimal 11 digit!";
    } elseif (!preg_match('/^[a-zA-Z\s]+$/', $nama_siswa)) {
        $error = "Nama hanya boleh huruf dan spasi!";
    } else {
        $check_query = "SELECT * FROM siswa WHERE nis = '$nis'";
        $check_result = $conn->query($check_query);

        if ($check_result->num_rows > 0) {
            $error = "NIS sudah terdaftar!";
        } else {
            $insert_query = "INSERT INTO siswa(nis, nama_siswa, kelas, jenis_kelamin, tanggal_lahir, alamat, no_telp, email) 
                             VALUES('$nis', '$nama_siswa', '$kelas', '$jenis_kelamin', '$tanggal_lahir', '$alamat', '$no_telp', '$email')";

            if ($conn->query($insert_query)) {
                $success = "Pendaftaran berhasil! Silakan login.";
            } else {
                $error = "Pendaftaran gagal: " . $conn->error;
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Registrasi Siswa</title>
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

        body {
          font-family: 'Poppins', sans-serif;
          color: #2c3e50;
          display: flex;
          flex-direction: column;
          justify-content: flex-start;
          align-items: center;
          min-height: 100vh; /* Ganti dari height: 100vh */
          padding: 30px 20px;
          background-image: url('smkn13.jpg');
          background-size: cover;
          background-position: center;
          background-repeat: no-repeat;
          position: relative;
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
            background: rgba(0, 50, 0, 0.5);
            z-index: -1;
            pointer-events: none;
        }

        h1, .nav, form, footer, .success, .error{
            animation: fadeIn 1s ease forwards;
        }

        h1 {
            text-align: center;
            font-size: 2.5em;
            color: rgb(44, 202, 107);
            margin-bottom: 30px;
            z-index: 1;
        }

        .nav {
            text-align: center;
            margin-bottom: 20px;
        }

        .nav a {
            text-decoration: none;
            color: rgb(44, 202, 107);
            font-weight: bold;
            margin: 0 10px;
        }

        .nav a:hover {
            text-decoration: underline;
        }

        form {
            background-color: #ffffff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
            max-width: 450px;
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

        input[type="text"],
        input[type="password"],
        input[type="email"],
        input[type="date"],
        textarea,
        select {
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

        footer {
            margin-top: 40px;
            text-align: center;
            font-size: 0.9em;
            color: rgb(44, 202, 107);
            z-index: 1;
        }
    </style>
</head>
<body>

    <h1>Form Registrasi Akun Siswa</h1>

    <p class="nav">
        <a href="index_siswa.php">Beranda</a>
        <a href="login_siswa.php">Login</a>
    </p>

    <?php if ($error): ?>
        <p class="error"><?php echo $error; ?></p>
    <?php endif; ?>

    <?php if ($success): ?>
        <p class="success"><?php echo $success; ?></p>
    <?php endif; ?>

    <form method="post" action="">
        <table>
            <tr>
                <td><label for="nis">NIS:</label></td>
                <td><input type="text" id="nis" name="nis" autocomplete="off" required></td>
            </tr>
            <tr>
                <td><label for="nama_siswa">Nama Lengkap:</label></td>
                <td><input type="text" id="nama_siswa" name="nama_siswa" autocomplete="off"required></td>
            </tr>
            <tr>
                <td><label for="kelas">Kelas:</label></td>
                <td>
                    <select id="kelas" name="kelas" required>
                        <option value="">Pilih kelas kamu</option>
                        <option value="X RPL 1">X RPL 1</option>
                        <option value="X RPL 2">X RPL 2</option>
                        <option value="X TKJ 1">X TKJ 1</option>
                        <option value="X TKJ 2">X TKJ 2</option>
                        <option value="X KA 1">X KA 1</option>
                        <option value="X KA 2">X KA 2</option>
                        <option value="X KA 3">X KA 3</option>
                        <option value="X KA 4">X KA 4</option>
                        <option value="X KA 5">X KA 5</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td><label for="jenis_kelamin">Jenis Kelamin:</label></td>
                <td>
                    <select id="jenis_kelamin" name="jenis_kelamin" required>
                        <option value="">Pilih jenis kelamin</option>
                        <option value="L">Laki-laki</option>
                        <option value="P">Perempuan</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td><label for="tanggal_lahir">Tanggal Lahir:</label></td>
                <td><input type="date" id="tanggal_lahir" name="tanggal_lahir" required></td>
            </tr>
            <tr>
                <td><label for="alamat">Alamat:</label></td>
                <td><textarea id="alamat" name="alamat" rows="3" required></textarea></td>
            </tr>
            <tr>
                <td><label for="no_telp">No. HP:</label></td>
                <td><input type="text" id="no_telp" name="no_telp" required></td>
            </tr>
            <tr>
                <td><label for="email">Email:</label></td>
                <td><input type="email" id="email" name="email" required></td>
            </tr>
            <tr>
                <td></td>
                <td><input type="submit" value="Daftar"></td>
            </tr>
        </table>
    </form>
    <script>
    document.querySelector("form").addEventListener("submit", function(e) {
    const nis = document.getElementById("nis").value.trim();
    const nama = document.getElementById("nama_siswa").value.trim();
    let error = "";

    if (!/^\d{1,11}$/.test(nis)) {
        error = "NIS hanya boleh angka dan maksimal 11 digit!";
    } else if (!/^[A-Za-z\s]+$/.test(nama)) {
        error = "Nama hanya boleh huruf dan spasi!";
    }

    if (error) {
        e.preventDefault(); // Cegah submit ke server
        alert(error); // Tampilkan pesan
    }
});
</script>


    <footer>
        <hr>
        <p>&copy; <?php echo date('Y'); ?> RAFADITYA SYAHPUTRA. All rights reserved.</p>
    </footer>
</body>
</html>
