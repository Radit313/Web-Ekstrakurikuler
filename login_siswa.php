<?php
session_start();
include 'koneksi.php';

$error = '';

// Redirect jika sudah login
if (isset($_SESSION['id_siswa'])) {
    header("Location: panel_siswa.php");
    exit;
}

// Auto login hanya jika akses dengan ?auto=1
if (!isset($_SESSION['id_siswa']) && isset($_COOKIE['nis']) && isset($_COOKIE['nama_siswa']) && isset($_GET['auto'])) {
    $nis = $conn->real_escape_string($_COOKIE['nis']);
    $nama_siswa = $conn->real_escape_string($_COOKIE['nama_siswa']);

    $query = "SELECT * FROM siswa WHERE nis = '$nis'";
    $result = $conn->query($query);

    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if (strtolower($row['nama_siswa']) === strtolower($nama_siswa)) {
            $_SESSION['id_siswa'] = $row['id_siswa'];
            $_SESSION['nama_siswa'] = $row['nama_siswa'];
            $_SESSION['nis'] = $row['nis'];
            header("Location: panel_siswa.php");
            exit;
        }
    }
}

// Manual login
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nis = $conn->real_escape_string($_POST['nis']);
    $nama_siswa = $conn->real_escape_string($_POST['nama_siswa']);

    if (!preg_match('/^\d{1,11}$/', $nis)) {
        $error = "NIS hanya boleh angka dan maksimal 11 digit!";
    } elseif (!preg_match('/^[a-zA-Z\s]+$/', $nama_siswa)) {
        $error = "Nama hanya boleh huruf dan spasi!";
    } else {
        $check_query = "SELECT * FROM siswa WHERE nis = '$nis'";
        $check_result = $conn->query($check_query);

        if ($check_result->num_rows > 0) {
            $row = $check_result->fetch_assoc();
            if (strtolower($row['nama_siswa']) === strtolower($nama_siswa)) {
                $_SESSION['id_siswa'] = $row['id_siswa'];
                $_SESSION['nama_siswa'] = $row['nama_siswa'];
                $_SESSION['nis'] = $row['nis'];

                // Simpan cookie 7 hari
                setcookie('nis', $nis, time() + (2 * 60 * 60), "/");
                setcookie('nama_siswa', $nama_siswa, time() + (2 * 60 * 60), "/");

                header("Location: panel_siswa.php");
                exit;
            } else {
                $error = "Nama tidak cocok dengan NIS!";
            }
        } else {
            $error = "NIS tidak ditemukan!";
        }
    }
}

$saved_nis = isset($_COOKIE['nis']) ? $_COOKIE['nis'] : '';
$saved_nama = isset($_COOKIE['nama_siswa']) ? $_COOKIE['nama_siswa'] : '';
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Siswa</title>
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
        
        form{
         animation: fadeIn 1s ease forwards;
        }

        .nav{
         animation: fadeIn 1s ease forwards;
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

        /* Error and success messages */
        p {
            text-align: center;
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
    </style>
</head>
<body>

    <h1>Login Siswa</h1>

    <p class="nav">
        <a href="regis_siswa.php">Buat Akun</a>
    </p>

    <?php if ($error): ?>
        <p class="error"><?php echo $error; ?></p>
    <?php endif; ?>

    <form method="post" action="">
        <table>
            <tr>
                <td><label for="nis">NIS:</label></td>
                <td><input type="text" id="nis" name="nis" value="<?php echo htmlspecialchars($saved_nis); ?>" autocomplete="off" required></td>
            </tr>
            <tr>
                <td><label for="nama_siswa">Nama:</label></td>
                <td><input type="text" id="nama_siswa" name="nama_siswa" value="<?php echo htmlspecialchars($saved_nama); ?>" autocomplete="off" required></td>
            </tr>
            <tr>
                <td></td>
                <td><input type="submit" value="Login"></td>
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
            e.preventDefault(); // cegah submit
            alert(error); // atau tampilkan ke HTML
        }
    });
  </script>


    <p class="back">
        <a href="index_siswa.php">Kembali</a>
    </p>

    <footer>
        <hr>
        <p>&copy;  <?php echo date('Y');?>  RAFADITYA SYAHPUTRA. Hak Cipta Dilindungi.</p>
    </footer>

</body>
</html>
