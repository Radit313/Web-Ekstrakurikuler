<?php
session_start();

$error = '';
$koneksi = mysqli_connect("localhost", "root", "", "ekstrakurikuler");

// Ambil dari cookie untuk prefill form
$saved_user = isset($_COOKIE['admin_username']) ? $_COOKIE['admin_username'] : '';
$saved_pass = isset($_COOKIE['admin_password']) ? $_COOKIE['admin_password'] : '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    $sql = "SELECT * FROM pengguna WHERE username = '$username'";
    $result = mysqli_query($koneksi, $sql);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);

        if (password_verify($password, $row['password'])) {
            // Set session login
            $_SESSION['id_pengguna'] = $row['id_pengguna'];
            $_SESSION['username'] = $row['username'];
            $_SESSION['role'] = $row['role'];

            // Simpan cookie username dan password asli (untuk prefill, bukan login)
           setcookie("admin_username", $username, time() + (2 * 60 * 60), "/");
           setcookie("admin_password", $password, time() + (2 * 60 * 60), "/");


            header("Location: panel_admin.php");
            exit();
        } else {
            $error = "Password salah!";
        }
    } else {
        $error = "Akun tidak ditemukan!";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login Admin</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <style>
       <!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <style>
        /* Reset dasar */
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
            background-image: url('smkn13.jpg'); /* Ganti dengan gambar yang sama */
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
            background-image: url('smkn13.jpg'); /* Ganti dengan gambar yang sama */
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

        input[type="text"], input[type="password"], select {
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

    <h1>Login Admin</h1>

    <?php if ($error != ''): ?>
        <p class="error"><?php echo $error; ?></p>
    <?php endif; ?>

    <form method="post" action="">
        <table>
            <tr>
                <td><label for="username">Username:</label></td>
                <td><input type="text" id="username" name="username" placeholder="Masukkan username" value="<?= htmlspecialchars($saved_user); ?>" required></td>
            </tr>
            <tr>
                <td><label for="password">Password:</label></td>
                <td><input type="password" id="password" name="password" placeholder="Masukkan password" value="<?= htmlspecialchars($saved_pass); ?>" required></td>
            </tr>
            <tr>
                <td></td>
                <td><input type="submit" value="Login"></td>
            </tr>
        </table>
    </form>

    <p class="back">
        <a href="index_admin.php">Kembali</a>
    </p>

    <footer>
        <hr>
        <p>&copy;  <?php echo date('Y');?>  RAFADITYA SYAHPUTRA. Hak Cipta Dilindungi.</p>
    </footer>